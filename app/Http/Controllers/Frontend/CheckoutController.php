<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
  public function index()
  {
    $cartItems = Cart::content();
    $addresses = UserAddress::where("user_id", Auth::user()->id)->get();
    $shippingMethods = ShippingRule::where("status", 1)->get();

    return view("frontend.pages.checkout", compact("cartItems", "addresses", "shippingMethods"));
  }

  public function createAddress(Request $request)
  {
    $request->validate([
      "name" => ["required"],
      "email" => ["required", "email"],
      "phone" => ["required", "digits:10"],
      "province_city_name" => ["required"],
      "district_name" => ["required"],
      "commune_ward_name" => ["required"],
      "address" => ["required"],
    ]);

    $address = new UserAddress();

    $address->user_id = Auth::user()->id;
    $address->name = $request->name;
    $address->email = $request->email;
    $address->phone = $request->phone;
    $address->province_city = $request->province_city;
    $address->district = $request->district;
    $address->commune_ward = $request->commune_ward;
    $address->address = $request->address;
    $address->other = $request->other;

    $address->save();

    Toastr::success("Tạo mới địa chỉ thành công", "Thành công");

    return redirect()->back();
  }

  public function checkoutFormSubmit(Request $request)
  {
    $request->validate([
      "shipping_method_id" => ["required"],
      "shipping_address_id" => ["required"],
    ]);

    $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);

    if ($shippingMethod) {
      Session::put("shipping_method", [
        "id" => $shippingMethod->id,
        "name" => $shippingMethod->name,
        "type" => $shippingMethod->type,
        "cost" => $shippingMethod->cost,
      ]);
    }

    $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();

    if ($address) {
      Session::put("shipping_address", $address);
    }

    return response(["status" => "success", "redirect_url" => route('user.payment')]);
  }
}
