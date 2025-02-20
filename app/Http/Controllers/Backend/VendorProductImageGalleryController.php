<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $product = Product::findOrFail($request->product);
    if ($product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }
    $images = ProductImageGallery::where("product_id", $request->product)->latest()->get();
    return view("vendor.product.image-gallery.index", compact("product", "images"));
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
    $request->validate([
      "image" => ["required"],
      "image.*" => ["required", "image", "max:3000"],
    ]);

    $imagePaths = $this->uploadMultiImage($request, "image", "uploads/products");

    foreach ($imagePaths as $imagePath) {
      $productImage = new ProductImageGallery();

      $productImage->product_id = $request->product;
      $productImage->image = $imagePath;

      $productImage->save();
    }

    Toastr::success("Tải lên hình ảnh sản phẩm thành công", "Thành công");

    return redirect()->back();
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
    $image = ProductImageGallery::findOrFail($id);

    if ($image->product->vendor_id !== Auth::user()->vendor->id) {
      abort(404);
    }

    $this->deleteImage($image->image);
    $image->delete();

    return response([
      "message" => "Xóa hình ảnh thành công",
      "status" => "success"
    ]);
  }
}