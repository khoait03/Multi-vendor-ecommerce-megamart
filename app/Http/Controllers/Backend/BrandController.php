<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // return $dataTable->render("admin.brand.index");
    $brands = Brand::latest()->get();
    return view("admin.brand.index", compact("brands"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.brand.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "logo" => ["required", "image", "max:2000"],
      "name" => ["required", "max:100"],
      "is_featured" => ["required"],
      "status" => ["required"]
    ]);

    $brand = new Brand();

    $logoPath = $this->uploadImage($request, "logo", "uploads/brands");

    $brand->logo = $logoPath;
    $brand->name = $request->name;
    $brand->slug = Str::slug($request->name);
    $brand->is_featured = $request->is_featured;
    $brand->status = $request->status;
    $brand->save();

    Toastr::success("Tạo mới thương hiệu thành công", "Thành công");

    return redirect()->route("admin.brand.index");
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
  public function edit(Brand $brand)
  {
    return view("admin.brand.edit", compact("brand"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Brand $brand)
  {
    $request->validate([
      "logo" => ["nullable", "image", "max:2000"],
      "name" => ["required", "max:100"],
      "is_featured" => ["required"],
      "status" => ["required"]
    ]);

    $logoPath = $this->updateImage($request, "logo", "uploads/brands", $brand->logo);

    $brand->logo = $logoPath ?? $brand->logo;
    $brand->name = $request->name;
    $brand->slug = Str::slug($request->name);
    $brand->is_featured = $request->is_featured;
    $brand->status = $request->status;
    $brand->save();

    Toastr::success("Cập nhật thương hiệu thành công", "Thành công");

    return redirect()->route("admin.brand.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $brand = Brand::findOrFail($id);

    if (Product::where("brand_id", $brand->id)->count() > 0) {
      return response([
        "message" => "Thương hiệu này đang có ít nhất 1 sản phẩm, vui lòng xoá các sản phẩm trước",
        "status" => "error"
      ]);
    }

    $this->deleteImage($brand->logo);

    $brand->delete();

    return response([
      "message" => "Xóa thương hiệu thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $brand = Brand::findOrFail($request->id);

    $brand->status = $request->status == "true" ? 1 : 0;
    $brand->save();

    return response([
      "message" => "Cập nhật trạng thái thương hiệu thành công",
      "status" => "success"
    ]);
  }
}
