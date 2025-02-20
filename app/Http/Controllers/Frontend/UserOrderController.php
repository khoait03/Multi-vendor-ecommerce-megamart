<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class UserOrderController extends Controller
{
  public function index(Request $request)
  {
    $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "pending")->latest()->get();

    switch ($request->status) {
      case "pending":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "pending")->latest()->get();
        break;
      case "processed_and_ready_to_ship":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "processed_and_ready_to_ship")->latest()->get();
        break;
      case "dropped_off":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "dropped_off")->latest()->get();
        break;
      case "shipped":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "shipped")->latest()->get();
        break;
      case "out_for_delivery":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "out_for_delivery")->latest()->get();
        break;
      case "delivered":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "delivered")->latest()->get();
        break;
      case "cancelled":
        $orders = Order::where("user_id", Auth::user()->id)->where("order_status", "cancelled")->latest()->get();
        break;
      case "all":
        $orders = Order::where("user_id", Auth::user()->id)->latest()->get();
    }

    return view("frontend.dashboard.order.index", compact("orders"));
  }

  public function show($id)
  {
    $order = Order::findOrFail($id);

    return view("frontend.dashboard.order.show", compact("order"));
  }

  public function cancelOrder(Request $request)
  {
    $request->validate([
      "cancel_reason" => ["required"],
    ]);

    $order = Order::findOrFail($request->order_id);

    $order->refund_status = "Chưa hoàn tiền";

    if ($order->payment_method == 'Paypal') {
      // Thực hiện hoàn tiền
      $this->refundPaypal($order->id);
      $order->refund_status = "Đã hoàn tiền";
    }
    if ($order->payment_method == 'COD') {
      $order->refund_status = "Không hoàn tiền";
    }

    if ($order->order_status == "pending") {
      $order->order_status = "cancelled";
      $order->cancel_reason = $request->cancel_reason;
      $order->save();

      $orderProducts = OrderProduct::where("order_id", $order->id)->get();

      foreach ($orderProducts as $item) {
        $item->status = "cancelled";
        $item->save();
      }

      Toastr::success("Huỷ đơn hàng thành công", "Thành công");
    } else {
      Toastr::error("Đơn hàng đã được xử lý, không thể huỷ đơn hàng này", "Thất bại");
    }

    return redirect()->back();
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

  public function refundPaypal($orderId)
  {
    $config = $this->paypalConfig();
    $provider = new PayPalClient($config);
    $provider->getAccessToken();

    // Lấy thông tin đơn hàng
    $order = Order::find($orderId);
    $captureId = $order->transaction->transaction_id; // ID của giao dịch thanh toán đã được lưu khi thanh toán thành công
    $invoiceId = $order->invoice_id; // ID hóa đơn đã được lưu trong quá trình thanh toán

    // Số tiền cần hoàn (float)
    $refundAmount = $order->transaction->amount_real_currency; // Ví dụ: 5.17 USD
    $invoiceId = uniqid('invoice_');

    // Thực hiện yêu cầu hoàn tiền
    $response = $provider->refundCapturedPayment($captureId, $invoiceId, $refundAmount, 'Hoan tien thanh toan don hang ' . $order->invoice_id);

    // Kiểm tra phản hồi từ PayPal
    if (isset($response["status"]) && $response["status"] == "COMPLETED") {
      // Cập nhật trạng thái đơn hàng
      // $order->update(['status' => 'refunded']);

      Toastr::success('Đã hoàn tiền thành công.', 'Thành công');
      return redirect()->back();
    } else {
      Toastr::error('Không thể hoàn tiền. Vui lòng thử lại.', 'Lỗi');
      return redirect()->back();
    }
  }
}
