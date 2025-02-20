<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\WithdrawInfo;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorWithdrawController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $withdraws = WithdrawRequest::where("vendor_id", Auth::user()->id)->latest()->get();

    $currentBalances = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
      ->where('order_products.vendor_id', Auth::user()->vendor->id)
      ->where('orders.order_status', 'delivered')
      ->where("orders.payment_status", 1)
      ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity'));

    $pendingAmount = WithdrawRequest::where(["vendor_id" => Auth::user()->vendor->id, "status" => "pending"])->sum("total_amount");

    $paidAmount = WithdrawRequest::where(["vendor_id" => Auth::user()->vendor->id, "status" => "paid"])->sum("total_amount");

    if ($pendingAmount > 0) {
      $currentBalances = $currentBalances - $pendingAmount;
    }

    $withdrawBalance = $currentBalances - $paidAmount;

    $withdrawInfo = WithdrawInfo::where("vendor_id", Auth::user()->vendor->id)->first();

    return view("vendor.withdraw.index", compact("withdraws", "withdrawBalance", "pendingAmount", "paidAmount", "withdrawInfo"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $method = WithdrawMethod::first();

    $withdrawInfo = WithdrawInfo::where("vendor_id", Auth::user()->vendor->id)->first();

    $withdrawMethod = WithdrawMethod::first();

    $currentBalances = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
      ->where('order_products.vendor_id', Auth::user()->vendor->id)
      ->where('orders.order_status', 'delivered')
      ->where("orders.payment_status", 1)
      ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity'));

    $pendingAmount = WithdrawRequest::where(["vendor_id" => Auth::user()->vendor->id, "status" => "pending"])->sum("total_amount");

    if ($pendingAmount > 0) {
      $currentBalances = $currentBalances - $pendingAmount;
    }

    $paidAmount = WithdrawRequest::where(["vendor_id" => Auth::user()->vendor->id, "status" => "paid"])->sum("total_amount");

    $withdrawBalance = $currentBalances - $paidAmount;

    return view("vendor.withdraw.create", compact("method", "withdrawInfo", "withdrawMethod", "withdrawBalance"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $method = WithdrawMethod::findOrFail($request->method);
    $request->validate([
      "amount" => ["required", "numeric", "min:" . $method->minimum_amount, "max:" . $method->maximum_amount],
    ]);

    if ($request->amount < $method->minimum_amount || $request->amount > $method->maximum_amount) {
      Toastr::error("Số tiền muốn rút không hợp lệ");
      return redirect()->back();
    }

    $currentBalances = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
      ->where('order_products.vendor_id', Auth::user()->vendor->id)
      ->where('orders.order_status', 'delivered')
      ->where("orders.payment_status", 1)
      ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity'));

    $paidAmount = WithdrawRequest::where(["vendor_id" => Auth::user()->vendor->id, "status" => "paid"])->sum("total_amount");

    $withdrawBalance = $currentBalances - $paidAmount;

    if ($request->amount > $withdrawBalance) {
      Toastr::error("Số tiền muốn rút vượt quá số tiền còn lại", "Lỗi");
      return redirect()->back();
    }

    if (WithdrawRequest::where(["vendor_id" => Auth::user()->vendor->id, "status" => "pending"])->count() > 0) {
      Toastr::error("Vui lòng đợi những yêu cầu trước được xử lý", "Lỗi");
      return redirect()->back();
    }

    $withdraw = new WithdrawRequest();
    $withdraw->request_id = Str::random(10);
    $withdraw->vendor_id = Auth::user()->vendor->id;
    $withdraw->method = $method->name;
    $withdraw->total_amount = $request->amount;
    $withdraw->withdraw_amount = $request->amount - ($request->amount * $method->withdraw_charge / 100);
    $withdraw->withdraw_charge = $request->amount * $method->withdraw_charge / 100;
    $withdraw->account_info = $request->account_info;
    $withdraw->bank_name = $request->bank_name;
    $withdraw->account_number = $request->account_number;
    $withdraw->account_name = $request->account_name;
    $withdraw->save();

    Toastr::success("Tạo yêu cầu rút tiền thành công", "Thành công");

    return redirect()->route("vendor.withdraw.index");
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $methodInfo = WithdrawMethod::findOrFail($id);

    return response($methodInfo);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function showRequest($id)
  {
    $request = WithdrawRequest::where(["vendor_id" => Auth::user()->id])->findOrFail($id);

    return view("vendor.withdraw.show", compact("request"));
  }

  public function addWithdrawInfo(Request $request)
  {
    $request->validate([
      "bank_name" => ["required"],
      "account_name" => ["required"],
      "account_number" => ["required"],
    ]);

    WithdrawInfo::updateOrCreate([
      "vendor_id" => Auth::user()->vendor->id
    ], [
      "vendor_id" => Auth::user()->vendor->id,
      "bank_name" => $request->bank_name,
      "account_name" => $request->account_name,
      "account_number" => $request->account_number,
    ]);

    Toastr::success("Thêm thông tin thanh toán thành công", "Thành công");

    return redirect()->back();
  }
}
