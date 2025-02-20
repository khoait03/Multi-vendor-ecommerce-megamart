<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // return $dataTable->render("admin.child-category.index");
    $childCategories = ChildCategory::latest()->get();
    return view("admin.child-category.index", compact("childCategories"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();
    return view("admin.child-category.create", compact("categories"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "category_id" => ["required"],
      "sub_category_id" => ["required"],
      "name" => ["required", "max:100", "unique:child_categories,name"],
      "status" => ["required"]
    ]);

    $childCategory = new ChildCategory();

    $childCategory->category_id = $request->category_id;
    $childCategory->sub_category_id = $request->sub_category_id;
    $childCategory->name = $request->name;
    $childCategory->slug = Str::slug($request->name);
    $childCategory->status = $request->status;
    $childCategory->save();

    Toastr::success("Tạo mới danh mục thành công", "Thành công");

    return redirect()->route("admin.child-category.index");
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
  public function edit(ChildCategory $childCategory)
  {
    $categories = Category::all();
    $subCategories = SubCategory::where("category_id", $childCategory->category_id)->get();
    return view("admin.child-category.edit", compact("categories", "subCategories", "childCategory"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ChildCategory $childCategory)
  {
    $request->validate([
      "category_id" => ["required"],
      "sub_category_id" => ["required"],
      "name" => ["required", "max:100", "unique:child_categories,name," . $childCategory->id],
      "status" => ["required"]
    ]);

    $childCategory->category_id = $request->category_id;
    $childCategory->sub_category_id = $request->sub_category_id;
    $childCategory->name = $request->name;
    $childCategory->slug = Str::slug($request->name);
    $childCategory->status = $request->status;
    $childCategory->save();

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    // return redirect()->route("admin.child-category.index")->with('reload', true);
    return redirect()->route("admin.child-category.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $category = ChildCategory::findOrFail($id);

    if (Product::where("child_category_id", $category->id)->count() > 0) {
      return response([
        "message" => "Danh mục cấp 3 này đang có ít nhất 1 sản phẩm, vui lòng xoá các sản phẩm trước",
        "status" => "error"
      ]);
    }

    $category->delete();

    return response([
      "message" => "Xóa danh mục thành công",
      "status" => "success"
    ]);
  }

  public function getSubCategories(Request $request)
  {
    $subCategories = SubCategory::where("category_id", $request->id)->where("status", 1)->get();

    return $subCategories;
  }

  public function changeStatus(Request $request)
  {
    $category = ChildCategory::findOrFail($request->id);

    $category->status = $request->status == "true" ? 1 : 0;
    $category->save();

    return response([
      "message" => "Cập nhật trạng thái danh mục thành công",
      "status" => "success"
    ]);
  }
}
