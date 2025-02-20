<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Suggestion;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
  public function index()
  {
    if (!Session::has("shipping_address") || !Session::has("shipping_method")) {
      return redirect()->route("user.checkout");
    }

    return view("frontend.pages.payment");
  }

  public function paymentSuccess()
  {
    return view('frontend.pages.payment-success');
  }

  public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName, $orderId = null)
  {
    $order = new Order();

    $order->invoice_id = $orderId ?? Str::random(15);
    $order->user_id = Auth::user()->id;
    $order->sub_total = getCartTotal();
    $order->amount = getPayableAmount();
    $order->currency_name = "VND";
    $order->currency_icon = "VND";
    $order->product_quantity = Cart::content()->count();
    $order->payment_method = $paymentMethod;
    $order->payment_status = $paymentStatus;
    $order->order_address = json_encode(Session::get("shipping_address"));
    $order->shipping_method = json_encode(Session::get("shipping_method"));
    $order->coupon = json_encode(Session::get("coupon")) ?? "";
    $order->order_status = "pending";
    $order->save();


    foreach (Cart::content() as $item) {
      $product = Product::find($item->id);

      $orderProduct = new OrderProduct();

      $orderProduct->order_id = $order->id;
      $orderProduct->product_id = $item->id;
      $orderProduct->vendor_id = $product->vendor_id;
      $orderProduct->product_name = $product->name;
      $orderProduct->variants = json_encode($item->options->variants);
      $orderProduct->variant_total = $item->options->variants_total;
      $orderProduct->unit_price = $item->price;
      $orderProduct->quantity = $item->qty;
      $orderProduct->status = $product->vendor_id == 1 ? "processed_and_ready_to_ship" : "pending";
      $orderProduct->save();

      $updateQuantity = $product->quantity - $item->qty;
      $product->quantity = $updateQuantity;
      $product->save();

      $suggestion = Suggestion::where(["user_id" => auth()->user()->id, "category_id" => $product->category_id])->first();

      if ($suggestion) {
        $suggestion->delete();
      }
    }


    $transaction = new Transaction();

    $transaction->order_id = $order->id;
    $transaction->transaction_id = $transactionId;
    $transaction->payment_method = $paymentMethod;
    $transaction->amount = getPayableAmount();
    $transaction->amount_real_currency = $paidAmount;
    $transaction->amount_real_currency_name = $paidCurrencyName;
    $transaction->save();
  }

  public function clearSession()
  {
    $userId = Auth::user()->id;
    Cart::restore($userId); // Khôi phục giỏ hàng hiện tại từ database

    Cart::destroy();

    Cart::erase($userId);

    Session::forget("shipping_method");
    Session::forget("shipping_address");
    Session::forget("coupon");
  }

  public function paypalConfig()
  {
    $paypalSetting = PaypalSetting::first();

    $config = [
      'mode'    => $paypalSetting->mode == 1 ? "sandbox" : "live", // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
      'sandbox' => [
        'client_id'         => $paypalSetting->client_id,
        'client_secret'     => $paypalSetting->secret_key,
        'app_id'            => "",
      ],
      'live' => [
        'client_id'         => $paypalSetting->client_id,
        'client_secret'     => $paypalSetting->secret_key,
        'app_id'            => "",
      ],

      'payment_action' =>  'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
      'currency'       =>  'USD',
      'notify_url'     =>   "", // Change this accordingly for your application.
      'locale'         =>  'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
      'validate_ssl'   =>  true, // Validate SSL when creating api client.
    ];

    return $config;
  }

  public function payWithPaypal()
  {
    $paypalSetting = PaypalSetting::first();

    $config = $this->paypalConfig();

    $provider = new PayPalClient($config);
    $provider->getAccessToken();
    // $provider->setApiCredentials($config);

    $total = getPayableAmount();
    $payableAmount = round($total / $paypalSetting->currency_rate, 2);

    $response = $provider->createOrder([
      "intent" => "CAPTURE",
      "application_context" => [
        "return_url" => route('user.paypal.success'),
        "cancel_url" => route('user.paypal.cancel'),
      ],
      "purchase_units" => [
        [
          "amount" => [
            "currency_code" => $config["currency"],
            "value" => $payableAmount
          ]
        ]
      ]
    ]);

    if (isset($response["id"]) && $response["id"] !== null) {
      foreach ($response["links"] as $link) {
        if ($link["rel"] == "approve") {
          return redirect()->away($link["href"]);
        }
      }
    } else {
      return redirect()->route("user.paypal.cancel");
    }
  }

  public function paypalSuccess(Request $request)
  {
    $config = $this->paypalConfig();

    $provider = new PayPalClient($config);
    $provider->getAccessToken();

    $response = $provider->capturePaymentOrder($request->token);

    if (isset($response["status"]) && $response["status"] == "COMPLETED") {

      $paypalSetting = PaypalSetting::first();
      $total = getPayableAmount();
      $payableAmount = round($total / $paypalSetting->currency_rate, 2);

      $this->storeOrder("Paypal", 1, $response["purchase_units"][0]["payments"]["captures"][0]["id"], $payableAmount, "USD");

      $this->clearSession();

      return redirect()->route("user.payment.success");
    }

    return redirect()->route("user.paypal.cancel");
  }

  public function paypalCancel()
  {
    Toastr::error("Thanh toán không thành công! Vui lòng kiểm tra lại thông tin và thử lại sau.", "Không thành công");

    return redirect()->route("user.payment");
  }

  public function payWithStripe(Request $request)
  {
    $stripeSetting = StripeSetting::first();

    $total = getPayableAmount();
    $payableAmount = round($total / $stripeSetting->currency_rate, 2);

    Stripe::setApiKey($stripeSetting->secret_key);
    $response = Charge::create([
      "amount" => $payableAmount * 100,
      "currency" => "usd",
      "source" => $request->stripe_token,
      "description" => "Payment from Megamart"
    ]);

    if ($response->status == "succeeded") {

      $this->storeOrder("Stripe", 1, $response->id, $payableAmount, "USD");

      $this->clearSession();

      return redirect()->route("user.payment.success");
    } else {
      Toastr::error("Thanh toán không thành công! Vui lòng kiểm tra lại thông tin và thử lại sau.", "Không thành công");

      return redirect()->route("user.payment");
    }
  }

  public function payWithCOD(Request $request)
  {
    $codSetting = StripeSetting::first();

    if ($codSetting->status == 0) {
      return redirect()->back();
    }

    $total = getPayableAmount();

    $this->storeOrder("COD", 0, Str::random(15), $total, "VND");

    $this->clearSession();

    return redirect()->route("user.payment.success");
  }

  public function payWithVNPay(Request $request)
  {
    $total = getPayableAmount();
    $invoiceId = Str::random(15);

    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = route("user.vnpay.success");
    $vnp_TmnCode = "ZU0Y1PWU"; //Mã website tại VNPAY 
    $vnp_HashSecret = "E0FBM0S3TMML1RWF8N7SKDB6UCU1WNC0"; //Chuỗi bí mật

    $vnp_TxnRef = $invoiceId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán đơn hàng " . $invoiceId . " với số tiền " . number_format($total) . "đ";
    $vnp_OrderType = "Đơn hàng MegaMart";
    $vnp_Amount = $total * 100;
    $vnp_Locale = "vn";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
      $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
      'code' => '00',
      'message' => 'success',
      'data' => $vnp_Url
    );
    if (isset($_POST['redirect'])) {
      header('Location: ' . $vnp_Url);
      die();
    } else {
      echo json_encode($returnData);
    }
    // vui lòng tham khảo thêm tại code demo

  }

  public function vnpaySuccess(Request $request)
  {
    if ($request->vnp_ResponseCode == "00") {
      $total = getPayableAmount();

      $this->storeOrder("VNPay", 1, $request->vnp_TransactionNo, $total, "VND", $request->vnp_TxnRef);

      $this->clearSession();

      return redirect()->route("user.payment.success");
    }

    Toastr::error("Thanh toán không thành công! Vui lòng kiểm tra lại thông tin và thử lại sau.", "Không thành công");

    return redirect()->route("user.payment");
  }
}
