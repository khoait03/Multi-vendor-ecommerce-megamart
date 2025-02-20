<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
  public function index()
  {
    $orders = Order::whereHas("orderProducts", function ($query) {
      $query->where("vendor_id", Auth::user()->vendor->id);
    })->orderBy("id", "desc")->get();

    return view('vendor.order.index', compact("orders"));
  }

  public function show($id)
  {
    $order = Order::findOrFail($id);

    return view('vendor.order.show', compact("order"));
  }

  public function changeStatus(Request $request, $id)
  {
    $orderProduct = OrderProduct::where("order_id", $id)->where("vendor_id", $request->vendor_id)->get();

    foreach ($orderProduct as $item) {
      $item->status = $request->status;
      $item->save();
    }

    Toastr::success("Cập nhật trạng thái đơn hàng thành công", "Thành công");

    return redirect()->back();
  }
}
