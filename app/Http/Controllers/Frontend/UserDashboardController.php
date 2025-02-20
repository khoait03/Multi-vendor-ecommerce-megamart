<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\UserAddress;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
  public function index()
  {
    $totalOrders = Order::where("user_id", Auth::user()->id)->count();
    $totalWishlists = Wishlist::where("user_id", Auth::user()->id)->count();
    $totalReviews = ProductReview::where("user_id", Auth::user()->id)->count();
    $totalAddress = UserAddress::where("user_id", Auth::user()->id)->count();
    $totalAmount = Order::where('user_id', Auth::user()->id)->sum('amount');
    $totalPendingOrder = Order::where('user_id', Auth::user()->id)
      ->whereIn('order_status', ['pending', "processed_and_ready_to_ship", 'dropped_off', 'shipped', "out_for_delivery"])
      ->count();
    $totalDeliveredOrder = Order::where('user_id', Auth::user()->id)
      ->whereIn('order_status', ["delivered"])
      ->count();
    $totalCancelOrder = Order::where('user_id', Auth::user()->id)
      ->whereIn('order_status', ["cancelled"])
      ->count();

    return view('frontend.dashboard.dashboard', compact("totalOrders", "totalWishlists", "totalReviews", "totalAddress", "totalAmount", "totalPendingOrder", "totalDeliveredOrder", "totalCancelOrder"));
  }
}
