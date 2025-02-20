<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantItemController extends Controller
{
  public function index(Request $request)
  {
    $variant = ProductVariant::findOrFail($request->variant);
    $product = Product::findOrFail($request->product);
    if ($product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }
    $variantItems = ProductVariantItem::where("product_variant_id", $variant->id)->latest()->get();

    return view('vendor.product.product-variant-item.index', compact("variant", "product", "variantItems"));
  }

  public function create(Request $request)
  {
    $variant = ProductVariant::findOrFail($request->variant);
    $product = Product::findOrFail($request->product);

    return view('vendor.product.product-variant-item.create', compact("variant", "product"));
  }

  public function store(Request $request)
  {
    $request->validate([
      "variant_id" => ["required"],
      "name" => ["required", "max:100"],
      "price" => ["required", "integer"],
      "is_default" => ["required"],
      "status" => ["required"]
    ]);

    $variantItem = new ProductVariantItem();

    $variant = ProductVariant::findOrFail($request->variant_id);

    $variantItem->product_variant_id = $request->variant_id;
    $variantItem->name = $request->name;
    $variantItem->price = $request->price;
    $variantItem->is_default = $request->is_default;
    $variantItem->status = $request->status;
    $variantItem->save();

    Toastr::success("Tạo mới thành phần của biến thể thành công", "Thành công");

    return redirect()->route("vendor.product-variant-item.index", ["product" => $variant->product_id, "variant" => $variant->id]);
  }

  public function edit(Request $request)
  {
    $variant = ProductVariant::findOrFail($request->variant);

    if ($variant->product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    $product = Product::findOrFail($request->product);
    $variantItem = ProductVariantItem::findOrFail($request->variantItemId);

    return view('vendor.product.product-variant-item.edit', compact("variant", "product", "variantItem"));
  }

  public function update(Request $request)
  {
    $request->validate([
      "variant_id" => ["required"],
      "name" => ["required", "max:100"],
      "price" => ["required", "integer"],
      "is_default" => ["required"],
      "status" => ["required"]
    ]);

    $variantItem = ProductVariantItem::findOrFail($request->variantItemId);

    $variant = ProductVariant::findOrFail($variantItem->product_variant_id);

    if ($variant->product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    $variantItem->name = $request->name;
    $variantItem->price = $request->price;
    $variantItem->is_default = $request->is_default;
    $variantItem->status = $request->status;
    $variantItem->save();

    Toastr::success("Cập nhật thành phần của biến thể thành công", "Thành công");

    return redirect()->route("vendor.product-variant-item.index", ["product" => $variant->product_id, "variant" => $variant->id]);
  }

  public function destroy(string $variantItemId)
  {

    $variantItem = ProductVariantItem::findOrFail($variantItemId);
    $variantItem->delete();

    return response([
      "message" => "Xóa thành phần của biến thể thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $variantItem = ProductVariantItem::findOrFail($request->id);

    $variantItem->status = $request->status == "true" ? 1 : 0;
    $variantItem->save();

    return response([
      "message" => "Cập nhật trạng thái thành phần thành công",
      "status" => "success"
    ]);
  }
}