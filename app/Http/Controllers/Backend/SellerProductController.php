<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
  public function index()
  {
    $products = Product::where("vendor_id", "!=", Auth::user()->vendor->id)->where("is_approved", "!=", 0)->latest()->get();

    return view("admin.product.seller-product.index", compact("products"));
  }

  public function pendingProducts()
  {
    $products = Product::where("vendor_id", "!=", Auth::user()->vendor->id)->where("is_approved", 0)->latest()->get();

    return view("admin.product.seller-pending-product.index", compact("products"));
  }

  public function changeApproveStatus()
  {
    $product = Product::findOrFail(request()->id);
    $product->is_approved = request()->value;
    $product->save();

    return response([
      "message" => "Cập nhật trang thái sản phẩm thành công",
      "status" => "success"
    ]);
  }
}
