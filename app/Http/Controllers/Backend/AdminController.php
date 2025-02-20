<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Coupon;
use App\Models\FlashSaleItem;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  public function dashboard(Request $request)
  {
    $categories = Category::count();
    $subCategories = SubCategory::count();
    $childCategories = ChildCategory::count();
    $brands = Brand::count();
    $products = Product::count();
    $productsAdmin = Product::where("vendor_id", Auth::user()->vendor->id)->count();
    $productsVendor = Product::where("vendor_id", "!=", Auth::user()->vendor->id)->count();
    $productsPending = Product::where("is_approved", 0)->count();
    $flashSales = FlashSaleItem::count();
    $coupons = Coupon::count();
    $orders = Order::count();
    $pending_orders = Order::where("order_status", "pending")->count();
    $processed_and_ready_to_ship_orders = Order::where("order_status", "processed_and_ready_to_ship")->count();
    $dropped_off_orders = Order::where("order_status", "dropped_off")->count();
    $shipped_orders = Order::where("order_status", "shipped")->count();
    $out_for_delivery_orders = Order::where("order_status", "out_for_delivery")->count();
    $delivered_orders = Order::where("order_status", "delivered")->count();
    $cancelled_orders = Order::where("order_status", "cancelled")->count();
    $refunded_orders = Order::where("order_status", "refunded")->count();
    $users = User::count();
    $customers = User::where("role", "user")->count();
    $vendors = User::where("role", "vendor")->count();
    $vendorsPending = Vendor::where("status", 0)->count();
    $reviews = ProductReview::count();
    $blogs = Blog::count();
    $subTotals = Order::where("payment_status", 1)->where("order_status", "delivered")->sum("sub_total");
    $amount = Order::where("payment_status", 1)->where("order_status", "delivered")->sum("amount");
    $amountSale = $subTotals - $amount;

    $year = $request->input('year', Carbon::now()->year);
    $currentMonth = Carbon::now()->month;

    $monthlyEarnings = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
      ->whereYear('order_products.created_at', $year)
      ->where("orders.payment_status", 1)
      ->where('orders.order_status', '!=', 'cancelled')
      ->selectRaw('MONTH(order_products.created_at) as month, SUM((order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity) as total')
      ->groupByRaw('MONTH(order_products.created_at)')
      ->orderByRaw('MONTH(order_products.created_at)')
      ->pluck('total', 'month');

    // Monthly orders count
    $monthlyOrders = Order::whereYear('created_at', $year)
      ->selectRaw('MONTH(created_at) as month, COUNT(*) as orders_count')
      ->groupBy('month')
      ->pluck('orders_count', 'month');

    $totalEarningsAdminVendor = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
      ->where('order_products.vendor_id', Auth::user()->vendor->id)
      ->where('orders.order_status', 'delivered')
      ->where("orders.payment_status", 1)
      ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity'));

    // Tính 10% tổng doanh thu từ các gian hàng khác
    $totalEarningsOtherVendors = OrderProduct::join('orders', 'order_products.order_id', '=', 'orders.id')
      ->where('order_products.vendor_id', '<>', Auth::user()->vendor->id)
      ->where('orders.order_status', 'delivered')
      ->where("orders.payment_status", 1)
      ->sum(DB::raw('(order_products.unit_price + COALESCE(order_products.variant_total, 0)) * order_products.quantity')) * 0.1;

    $totalEarningsVendor = $subTotals - $totalEarningsAdminVendor;

    // Tính tổng doanh thu
    $finalTotalEarnings = $totalEarningsAdminVendor + $totalEarningsOtherVendors;

    // $ratings = ProductReview::select('rating', DB::raw('count(*) as total'))
    //   ->where('vendor_id', Auth::user()->vendor->id)
    //   ->groupBy('rating')
    //   ->pluck('total', 'rating')
    //   ->toArray();
    $ratings = ProductReview::select('rating', DB::raw('count(*) as total'))
      ->groupBy('rating')
      ->pluck('total', 'rating')
      ->toArray();

    // Truy vấn để lấy danh sách sản phẩm bán chạy
    $topSellingProducts = OrderProduct::select('product_id', DB::raw('count(*) as total_sales'))
      ->join('orders', 'order_products.order_id', '=', 'orders.id')
      ->where('orders.order_status', 'delivered')
      ->groupBy('product_id')
      ->orderBy('total_sales', 'desc')
      ->take(5) // Lấy top 10 sản phẩm bán chạy
      ->get();

    // Lấy thông tin chi tiết sản phẩm và vendor
    $productsBestSale = Product::whereIn('id', $topSellingProducts->pluck('product_id'))->get();
    $vendorsProduct = Vendor::whereIn('id', $productsBestSale->pluck('vendor_id'))->get();

    // Gộp thông tin chi tiết sản phẩm với số lần xuất hiện và tên gian hàng
    $topSellingProducts = $topSellingProducts->map(function ($item) use ($productsBestSale, $vendorsProduct) {
      $product = $productsBestSale->where('id', $item->product_id)->first();
      $vendorsProduct = $vendorsProduct->where('id', $product->vendor_id)->first();
      return [
        'product' => $product,
        'vendor_name' => $vendorsProduct->name,
        'total_sales' => $item->total_sales
      ];
    });

    return view("admin.dashboard", compact(
      "categories",
      "subCategories",
      "childCategories",
      "brands",
      "products",
      "productsAdmin",
      "productsVendor",
      "productsPending",
      "flashSales",
      "coupons",
      "orders",
      "pending_orders",
      "processed_and_ready_to_ship_orders",
      "dropped_off_orders",
      "shipped_orders",
      "out_for_delivery_orders",
      "delivered_orders",
      "cancelled_orders",
      "refunded_orders",
      "users",
      "customers",
      "vendors",
      "vendorsPending",
      "reviews",
      "blogs",
      "subTotals",
      "amount",
      "amountSale",
      "monthlyEarnings",
      "monthlyOrders",
      "year",
      "finalTotalEarnings",
      "totalEarningsAdminVendor",
      "totalEarningsOtherVendors",
      "ratings",
      "topSellingProducts",
      "totalEarningsVendor"
    ));
  }

  public function login()
  {
    return view("admin.auth.login");
  }
}
