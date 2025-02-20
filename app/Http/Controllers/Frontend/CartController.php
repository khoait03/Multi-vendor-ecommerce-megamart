<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
  public function addToCart(Request $request)
  {
    if (!Auth::user()) {
      return response([
        "message" => "Vui lòng đăng nhập để mua hàng",
        "status" => "error"
      ]);
    }

    $product = Product::findOrFail($request->product_id);

    if ($product->quantity == 0) {
      return response([
        "message" => "Sản phẩm đã hết hàng",
        "status" => "error"
      ]);
    } elseif ($product->quantity < $request->quantity) {
      return response([
        "message" => "Sản phẩm không đủ số lượng",
        "status" => "error"
      ]);
    }

    $variants = [];

    $variantTotalAmount = 0;

    if ($request->has("variants_items")) {
      foreach ($request->variants_items as $item_id) {
        $variantItem = ProductVariantItem::find($item_id);
        $variants[$variantItem->productVariant->name]["name"] = $variantItem->name;
        $variants[$variantItem->productVariant->name]["price"] = $variantItem->price;
        $variantTotalAmount += $variantItem->price;
      }
    }

    $price = checkDisCount($product) ? $product->offer_price : $product->price;

    $cartData = [];

    $cartData["id"] = $product->id;
    $cartData["name"] = $product->name;
    $cartData["qty"] = $request->quantity;
    $cartData["price"] = $price;
    $cartData["weight"] = 10;
    $cartData["options"]["variants"] = $variants;
    $cartData["options"]["variants_total"] = $variantTotalAmount;
    $cartData["options"]["image"] = $product->thumb_image;
    $cartData["options"]["slug"] = $product->slug;
    $cartData["options"]["stock"] = $product->quantity;

    $userId = Auth::user()->id;
    Cart::restore($userId); // Khôi phục giỏ hàng hiện tại từ database

    Cart::add($cartData); // Thêm sản phẩm mới vào giỏ hàng

    Cart::store($userId); // Lưu lại giỏ hàng đã cập nhật vào database

    return response([
      "message" => "Thêm sản phẩm vào giỏ hàng thành công",
      "status" => "success"
    ]);
  }

  public function cartDetails()
  {
    if (!Auth::user()) {
      return redirect()->route("login");
    }

    $cartItems = Cart::content();

    if (count($cartItems) === 0) {
      Session::forget("coupon");
    }

    return view("frontend.pages.cart-detail", compact("cartItems"));
  }

  public function updateProductQuantity(Request $request)
  {
    $productId = Cart::get($request->rowId)->id;

    $product = Product::findOrFail($productId);

    if ($product->quantity == 0) {
      return response([
        "message" => "Sản phẩm đã hết hàng",
        "status" => "error"
      ]);
    } elseif ($product->quantity < $request->quantity) {
      return response([
        "message" => "Sản phẩm không đủ số lượng",
        "status" => "error"
      ]);
    }

    $userId = Auth::user()->id;
    Cart::restore($userId); // Khôi phục giỏ hàng hiện tại từ database

    Cart::update($request->rowId, $request->quantity);

    Cart::store($userId); // Lưu lại giỏ hàng đã cập nhật vào database


    $productTotal = $this->getProductTotal($request->rowId);

    return response([
      "message" => "Cập nhật số lượng sản phẩm thành công",
      "status" => "success",
      "product_total" => $productTotal
    ]);
  }

  public function getProductTotal($rowId)
  {
    $cartItem = Cart::get($rowId);

    return ($cartItem->price + $cartItem->options->variants_total) * $cartItem->qty;
  }

  public function clearCart()
  {
    $userId = Auth::user()->id;
    Cart::restore($userId); // Khôi phục giỏ hàng hiện tại từ database

    Cart::destroy();

    Cart::erase($userId);

    return response([
      "message" => "Xóa giỏ hàng thành công",
      "status" => "success"
    ]);
  }

  public function removeProduct($rowId)
  {
    $userId = Auth::user()->id;
    Cart::restore($userId); // Khôi phục giỏ hàng hiện tại từ database

    Cart::remove($rowId);

    Cart::store($userId); // Lưu lại giỏ hàng đã cập nhật vào database

    return redirect()->back();
  }

  public function getCartCount()
  {
    return Cart::content()->count();
  }

  public function getCartProducts()
  {
    return Cart::content();
  }

  public function removeSidebarProduct(Request $request)
  {
    $userId = Auth::user()->id;
    Cart::restore($userId); // Khôi phục giỏ hàng hiện tại từ database

    Cart::remove($request->rowId);

    Cart::store($userId); // Lưu lại giỏ hàng đã cập nhật vào database

    return response([
      "message" => "Xóa sản phẩm khỏi giỏ hàng thành công",
      "status" => "success"
    ]);
  }

  public function cartTotal()
  {
    $total = 0;

    foreach (Cart::content() as $item) {
      $total += $this->getProductTotal($item->rowId);
    }

    return $total;
  }

  public function applyCoupon(Request $request)
  {
    if ($request->code === null) {
      return response([
        "message" => "Vui lòng nhập mã giảm giá",
        "status" => "error"
      ]);
    }

    $coupon = Coupon::where(["code" => $request->code, "status" => 1])->first();

    if (!$coupon) {
      return response([
        "message" => "Mã giảm giá không tồn tại hoặc hết hạn",
        "status" => "error"
      ]);
    } elseif ($coupon->start_date > date("Y-m-d H:i:s") || date("Y-m-d H:i:s") > $coupon->end_date) {
      return response([
        "message" => "Mã giảm giá không tồn tại hoặc hết hạn",
        "status" => "error"
      ]);
    } elseif ($coupon->total_used >= $coupon->quantity) {
      return response([
        "message" => "Mã giảm giá đã hết lượt sử dụng",
        "status" => "error"
      ]);
    }

    if ($coupon->discount_type == "amount") {
      Session::put("coupon", [
        "coupon_name" => $coupon->name,
        "coupon_code" => $coupon->code,
        "discount_type" => "amount",
        "discount" => $coupon->discount,
      ]);
    } elseif ($coupon->discount_type == "percent") {
      Session::put("coupon", [
        "coupon_name" => $coupon->name,
        "coupon_code" => $coupon->code,
        "discount_type" => "percent",
        "discount" => $coupon->discount,
      ]);
    }

    return response([
      "message" => "Áp dụng mã giảm giá thành công",
      "status" => "success"
    ]);
  }

  public function couponCalculation()
  {
    if (Session::has("coupon")) {
      $coupon = Session::get("coupon");

      $total = 0;

      foreach (Cart::content() as $item) {
        $total += ($item->price + $item->options->variants_total) * $item->qty;
      }

      if ($coupon["discount_type"] == "amount") {
        $total = $total - $coupon["discount"];
        $total = $total < 0 ? 0 : $total;
        return response([
          "cart_total" => $total,
          "discount" => $coupon["discount"],
          "status" => "success"
        ]);
      } elseif ($coupon["discount_type"] == "percent") {
        $discount = $total * $coupon["discount"] / 100;
        $total = $total - ($total * $coupon["discount"] / 100);
        $total = $total < 0 ? 0 : $total;
        return response([
          "cart_total" => $total,
          "discount" => $discount,
          "status" => "success"
        ]);
      }
    } else {
      $total = getCartTotal();

      return response([
        "cart_total" => $total,
        "discount" => 0,
        "status" => "success"
      ]);
    }
  }
}
