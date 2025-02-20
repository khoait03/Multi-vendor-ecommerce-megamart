<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // return $dataTable->render("admin.sub-category.index");
    $subCategories = SubCategory::latest()->get();
    return view("admin.sub-category.index", compact('subCategories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();
    return view("admin.sub-category.create", compact("categories"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "category_id" => ["required"],
      "name" => ["required", "max:100", "unique:sub_categories,name"],
      "status" => ["required"]
    ]);

    $subCategory = new SubCategory();

    $subCategory->category_id = $request->category_id;
    $subCategory->name = $request->name;
    $subCategory->slug = Str::slug($request->name);
    $subCategory->status = $request->status;
    $subCategory->save();

    Toastr::success("Tạo mới danh mục thành công", "Thành công");

    return redirect()->route("admin.sub-category.index");
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
  public function edit(SubCategory $subCategory)
  {
    $categories = Category::all();
    return view("admin.sub-category.edit", compact("subCategory", "categories"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, SubCategory $subCategory)
  {
    $request->validate([
      "category_id" => ["required"],
      "name" => ["required", "max:100", "unique:sub_categories,name," . $subCategory->id],
      "status" => ["required"]
    ]);

    $subCategory->category_id = $request->category_id;
    $subCategory->name = $request->name;
    $subCategory->slug = Str::slug($request->name);
    $subCategory->status = $request->status;
    $subCategory->save();

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    return redirect()->route("admin.sub-category.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $subCategory = SubCategory::findOrFail($id);

    $childCategoryCount = ChildCategory::where("sub_category_id", $subCategory->id)->count();

    if ($childCategoryCount > 0) {
      return response([
        "message" => "Danh mục cấp 2 này đang có ít nhất 1 danh mục cấp 3, vui lòng xoá các danh mục cấp 3 trước",
        "status" => "error"
      ]);
    }

    if (Product::where("sub_category_id", $subCategory->id)->count() > 0) {
      return response([
        "message" => "Danh mục cấp 2 này đang có ít nhất 1 sản phẩm, vui lòng xoá các sản phẩm trước",
        "status" => "error"
      ]);
    }

    $subCategory->delete();

    return response([
      "message" => "Xóa danh mục thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $category = SubCategory::findOrFail($request->id);

    $category->status = $request->status == "true" ? 1 : 0;
    $category->save();

    return response([
      "message" => "Cập nhật trạng thái danh mục thành công",
      "status" => "success"
    ]);
  }
}
