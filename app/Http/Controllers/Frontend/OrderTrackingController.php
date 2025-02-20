<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
  public function index(Request $request)
  {

    $order = Order::where("invoice_id", $request->order_id)->first();

    if ($request->order_id && !$order) {
      Toastr::error("Mã đơn hàng không chính xác", "Lỗi");
    }

    return view("frontend.pages.order-tracking", compact("order"));
  }
}
