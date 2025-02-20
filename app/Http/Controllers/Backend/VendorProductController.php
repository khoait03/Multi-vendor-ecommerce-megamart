<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\SubCategory;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $products = Product::where("vendor_id", Auth::user()->vendor->id)->latest()->get();
    return view("vendor.product.index", compact("products"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();
    $brands = Brand::all();
    return view("vendor.product.create", compact("categories", "brands"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "thumb_image" => ["required", "image", "max:3000"],
      "category" => ["required"],
      "brand" => ["required"],
      "sku" => ["required"],
      "name" => ["required", "max:200"],
      "short_description" => ["required", "max:200"],
      "long_description" => ["required"],
      "price" => ["required", "numeric"],
      "offer_price" => ["required", "numeric"],
      "quantity" => ["required", "numeric"],
      "status" => ["required"],
      "seo_title" => ["nullable", "max:200"],
      "seo_description" => ["nullable", "max:1000"],
    ]);

    $product = new Product();

    $imagePath = $this->uploadImage($request, "thumb_image", "uploads/products");

    $product->thumb_image = $imagePath;
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->vendor_id = Auth::user()->vendor->id;
    $product->category_id = $request->category;
    $product->sub_category_id = $request->sub_category;
    $product->child_category_id = $request->child_category;
    $product->brand_id = $request->brand;
    $product->quantity = $request->quantity;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->offer_price = $request->offer_price;
    $product->offer_start_date = $request->offer_start_date;
    $product->offer_end_date = $request->offer_end_date;
    $product->short_description = $request->short_description;
    $product->long_description = $request->long_description;
    $product->video_link = $request->video_link;
    $product->status = $request->status;
    $product->product_type = $request->product_type;
    $product->is_approved = 0;
    $product->seo_title = $request->seo_title;
    $product->seo_description = $request->seo_description;
    $product->save();

    Toastr::success("Tạo sản phẩm mới thành công", "Thành công");

    return redirect()->route("vendor.products.index");
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
  public function edit(Product $product)
  {
    if ($product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    $categories = Category::all();
    $brands = Brand::all();
    $subCategories = SubCategory::where("category_id", $product->category_id)->where("status", 1)->get();
    $childCategories = ChildCategory::where("sub_category_id", $product->sub_category_id)->where("status", 1)->get();
    return view("vendor.product.edit", compact("product", "categories", "brands", "subCategories", "childCategories"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    if ($product->vendor_id != Auth::user()->vendor->id) {
      abort(404);
    }

    $request->validate([
      "thumb_image" => ["nullable", "image", "max:3000"],
      "category" => ["required"],
      "brand" => ["required"],
      "sku" => ["required"],
      "name" => ["required", "max:200"],
      "short_description" => ["required", "max:200"],
      "long_description" => ["required"],
      "price" => ["required", "numeric"],
      "offer_price" => ["required", "numeric"],
      "quantity" => ["required", "numeric"],
      "status" => ["required"],
      "seo_title" => ["nullable", "max:200"],
      "seo_description" => ["nullable", "max:1000"],
    ]);

    $imagePath = $this->updateImage($request, "thumb_image", "uploads/products", $product->thumb_image);

    $product->thumb_image = $imagePath ?? $product->thumb_image;
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->vendor_id = Auth::user()->vendor->id;
    $product->category_id = $request->category;
    $product->sub_category_id = $request->sub_category;
    $product->child_category_id = $request->child_category;
    $product->brand_id = $request->brand;
    $product->quantity = $request->quantity;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->offer_price = $request->offer_price;
    $product->offer_start_date = $request->offer_start_date;
    $product->offer_end_date = $request->offer_end_date;
    $product->short_description = $request->short_description;
    $product->long_description = $request->long_description;
    $product->video_link = $request->video_link;
    $product->status = $request->status;
    $product->product_type = $request->product_type;
    $product->is_approved = $product->is_approved;
    $product->seo_title = $request->seo_title;
    $product->seo_description = $request->seo_description;
    $product->save();

    Toastr::success("Cập nhật sản phẩm thành công", "Thành công");

    return redirect()->route("vendor.products.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $product = Product::findOrFail($id);

    $variants = ProductVariant::where("product_id", $product->id)->get();

    foreach ($variants as $variant) {
      ProductVariantItem::where("product_variant_id", $variant->id)->delete();
      $variant->delete();
    }

    $imageGallery = ProductImageGallery::where("product_id", $product->id)->get();

    foreach ($imageGallery as $image) {
      $this->deleteImage($image->image);
      $image->delete();
    }

    $this->deleteImage($product->thumb_image);
    $product->delete();

    return response([
      "message" => "Xóa sản phẩm thành công",
      "status" => "success"
    ]);
  }

  public function getSubCategories(Request $request)
  {
    $subCategories = SubCategory::where("category_id", $request->id)->where("status", 1)->get();

    return $subCategories;
  }

  public function getChildCategories(Request $request)
  {
    $childCategories = ChildCategory::where("sub_category_id", $request->id)->where("status", 1)->get();

    return $childCategories;
  }

  public function changeStatus(Request $request)
  {
    $product = Product::findOrFail($request->id);

    $product->status = $request->status == "true" ? 1 : 0;
    $product->save();

    return response([
      "message" => "Cập nhật trạng thái sản phẩm thành công",
      "status" => "success"
    ]);
  }
}
