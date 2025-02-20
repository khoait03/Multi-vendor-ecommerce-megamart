<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
  public function index()
  {
    if (!Auth::user()) {
      return redirect()->route("login");
    }

    $wishlistProducts = Wishlist::with("product")->where("user_id", Auth::user()->id)->latest()->get();

    return view('frontend.pages.wishlist', compact("wishlistProducts"));
  }

  public function addToWishlist(Request $request)
  {
    if (!Auth::check()) {
      return response([
        "status" => "error",
        "message" => "Vui lòng đăng nhập để thêm vào danh sách yêu thích"
      ]);
    }

    $wishlistCount = Wishlist::where(["user_id" => Auth::user()->id, "product_id" => $request->id])->count();

    if ($wishlistCount > 0) {
      return response([
        "status" => "error",
        "message" => "Sản phẩm này đã có trong danh sách yêu thích"
      ]);
    }

    $wishlist = new Wishlist();
    $wishlist->user_id = Auth::user()->id;
    $wishlist->product_id = $request->id;
    $wishlist->save();

    $count = Wishlist::where("user_id", Auth::user()->id)->count();

    return response([
      "status" => "success",
      "message" => "Thêm vào danh sách yêu thích thành công",
      "count" => $count
    ]);
  }

  public function removeFromWishlist($id)
  {
    $wishlist = Wishlist::findOrFail($id);
    if ($wishlist->user_id != Auth::user()->id) {
      return redirect()->back();
    }
    $wishlist->delete();

    Toastr::success("Bỏ yêu thích sản phẩm thành công", "Thành công");

    return redirect()->back();
  }
}
