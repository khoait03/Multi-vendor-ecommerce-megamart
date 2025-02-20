<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $product = Product::findOrFail($request->product);
    if ($product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }
    $variants = ProductVariant::where("product_id", $request->product)->latest()->get();
    return view("vendor.product.product-variant.index", compact("product", "variants"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    $product = Product::findOrFail($request->product);

    return view("vendor.product.product-variant.create", compact("product"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "name" => ["required", "max:100"],
      "status" => ["required"]
    ]);

    $variant = new ProductVariant();
    $variant->product_id = $request->product;
    $variant->name = $request->name;
    $variant->status = $request->status;
    $variant->save();

    Toastr::success("Tạo mới biến thể thành công", "Thành công");

    return redirect()->route("vendor.product-variant.index", ["product" => $request->product]);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ProductVariant $productVariant)
  {
    $product = Product::findOrFail($productVariant->product_id);

    if ($product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    return view("vendor.product.product-variant.edit", compact("productVariant", "product"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ProductVariant $productVariant)
  {
    if ($productVariant->product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    $request->validate([
      "name" => ["required", "max:100"],
      "status" => ["required"]
    ]);

    $productVariant->name = $request->name;
    $productVariant->status = $request->status;
    $productVariant->save();

    Toastr::success("Cập nhật biến thể thành công", "Thành công");

    return redirect()->route("vendor.product-variant.index", ["product" => $productVariant->product_id]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $variant = ProductVariant::findOrFail($id);

    if ($variant->product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    ProductVariantItem::where("product_variant_id", $variant->id)->delete();

    $variant->delete();

    return response([
      "message" => "Xóa biến thể thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $variant = ProductVariant::findOrFail($request->id);

    $variant->status = $request->status == "true" ? 1 : 0;
    $variant->save();

    return response([
      "message" => "Cập nhật trạng thái biến thể thành công",
      "status" => "success"
    ]);
  }
}