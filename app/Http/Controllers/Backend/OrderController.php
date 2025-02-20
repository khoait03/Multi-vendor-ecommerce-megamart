<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $orders = null;

    switch ($request->order_filter) {
      case 'pending':
        $orders = Order::where("order_status", "pending")->latest()->get();
        break;
      case 'processed_and_ready_to_ship':
        $orders = Order::where("order_status", "processed_and_ready_to_ship")->latest()->get();
        break;
      case 'dropped_off':
        $orders = Order::where("order_status", "dropped_off")->latest()->get();
        break;
      case 'shipped':
        $orders = Order::where("order_status", "shipped")->latest()->get();
        break;
      case 'out_for_delivery':
        $orders = Order::where("order_status", "out_for_delivery")->latest()->get();
        break;
      case 'delivered':
        $orders = Order::where("order_status", "delivered")->latest()->get();
        break;
      case 'cancelled':
        $orders = Order::where("order_status", "cancelled")->latest()->get();
        break;
      case 'refunded':
        $orders = Order::where("order_status", "refunded")->latest()->get();
        break;

      default:
        $orders = Order::latest()->get();
        break;
    }

    return view("admin.order.index", compact("orders"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Order $order)
  {
    return view("admin.order.show", compact("order"));
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

  public function changeOrderStatus(Request $request)
  {
    $order = Order::findOrFail($request->order_id);

    $order->order_status = $request->order_status;
    $order->save();

    if ($order->order_status == "cancelled") {
      $orderProducts = OrderProduct::where("order_id", $order->id)->get();

      foreach ($orderProducts as $item) {
        $item->status = "cancelled";
        $item->save();
      }
    }

    return response([
      "message" => "Cập nhật trạng thái đơn hàng thành công",
      "status" => "success"
    ]);
  }

  public function changePaymentStatus(Request $request)
  {
    $order = Order::findOrFail($request->order_id);

    $order->payment_status = $request->payment_status;
    $order->save();

    return response([
      "message" => "Cập nhật trạng thái thanh toán thành công",
      "status" => "success"
    ]);
  }

  public function cancelOrders(Request $request)
  {
    $orders = null;

    switch ($request->order_filter) {
      case 'not-refund':
        $orders = Order::where("refund_status", "Chưa hoàn tiền")->latest()->get();
        break;

      case 'refunded':
        $orders = Order::where("refund_status", "Đã hoàn tiền")->latest()->get();
        break;

      default:
        $orders = Order::where("order_status", "cancelled")->latest()->get();
        break;
    }

    return view("admin.order.cancel-order", compact("orders"));
  }

  public function cancelOrdersShow($id)
  {
    $order = Order::findOrFail($id);
    return view("admin.order.cancel-order-show", compact("order"));
  }

  public function changeRefundStatus(Request $request)
  {

    $order = Order::findOrFail($request->order_id);
    $order->refund_status = $request->refund_status;
    $order->save();

    Toastr::success("Cập nhật trạng thái hoàn tiền thành công", "Thành công");

    return redirect()->back();
  }
}
