<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
  public function index(Request $request)
  {
    $startDate = date('Y-m-d 00:00:00', strtotime($request->report_start_date));
    $endDate = date('Y-m-d 23:59:59', strtotime($request->report_end_date));

    $totalEarningsAdminVendor = 0;
    $totalEarningsVendor = 0;
    $totalEarningsOtherVendors = 0;
    $finalTotalEarnings = 0;

    $subTotals = Order::where("payment_status", 1)
      ->where("order_status", "delivered")
      ->whereBetween('created_at', [$startDate, $endDate])
      ->sum("sub_total");
    $amount = Order::where("payment_status", 1)->where("order_status", "delivered")->whereBetween('created_at', [$startDate, $endDate])->sum("amount");
    $amountSale = $subTotals - $amount;

    if ($request->report_type == "revenue") {
      $totalEarningsAdminVendor = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
        ->where('order_products.vendor_id', Auth::user()->vendor->id)
        ->where('orders.order_status', 'delivered')
        ->where("orders.payment_status", 1)
        ->whereBetween('order_products.created_at', [$startDate, $endDate])
        ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity'));
      $totalEarningsVendor = $subTotals - $totalEarningsAdminVendor;
      $totalEarningsOtherVendors = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
        ->where('order_products.vendor_id', '<>', Auth::user()->vendor->id)
        ->where('orders.order_status', 'delivered')
        ->where("orders.payment_status", 1)
        ->whereBetween('order_products.created_at', [$startDate, $endDate])
        ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity')) * 0.1;
      $finalTotalEarnings = $totalEarningsAdminVendor + $totalEarningsOtherVendors;
    }

    $orderList = [];
    $orders = 0;
    $pending_orders = 0;
    $processed_and_ready_to_ship_orders = 0;
    $dropped_off_orders = 0;
    $shipped_orders = 0;
    $out_for_delivery_orders = 0;
    $delivered_orders = 0;
    $cancelled_orders = 0;
    $refunded_orders = 0;

    if ($request->report_type == "order") {
      $orderList = Order::whereBetween('created_at', [$startDate, $endDate])->get();
      $orders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
      $pending_orders = Order::where("order_status", "pending")->whereBetween('created_at', [$startDate, $endDate])->count();
      $processed_and_ready_to_ship_orders = Order::where("order_status", "processed_and_ready_to_ship")->whereBetween('created_at', [$startDate, $endDate])->count();
      $dropped_off_orders = Order::where("order_status", "dropped_off")->whereBetween('created_at', [$startDate, $endDate])->count();
      $shipped_orders = Order::where("order_status", "shipped")->whereBetween('created_at', [$startDate, $endDate])->count();
      $out_for_delivery_orders = Order::where("order_status", "out_for_delivery")->whereBetween('created_at', [$startDate, $endDate])->count();
      $delivered_orders = Order::where("order_status", "delivered")->whereBetween('created_at', [$startDate, $endDate])->count();
      $cancelled_orders = Order::where("order_status", "cancelled")->whereBetween('created_at', [$startDate, $endDate])->count();
      $refunded_orders = Order::where("order_status", "refunded")->whereBetween('created_at', [$startDate, $endDate])->count();
    }

    $couponUsedCount = 0;

    if ($request->report_type == "coupon") {
      $couponUsedCount = Order::whereBetween('created_at', [$startDate, $endDate])->where("coupon", "!=", "null")->count();
      $orderList = Order::whereBetween('created_at', [$startDate, $endDate])->where("coupon", "!=", "null")->get();
    }

    return view('admin.report.index', compact("subTotals", "totalEarningsAdminVendor", "totalEarningsVendor", "totalEarningsOtherVendors", "finalTotalEarnings", "amountSale", "orders", "pending_orders", "processed_and_ready_to_ship_orders", "dropped_off_orders", "shipped_orders", "out_for_delivery_orders", "delivered_orders", "cancelled_orders", "refunded_orders", "orderList", "couponUsedCount"));
  }
}
