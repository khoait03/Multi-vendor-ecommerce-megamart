<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // return $dataTables->render("admin.category.index");
    $categories = Category::latest()->get();
    return view("admin.category.index", compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.category.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "icon" => ["not_in:empty"],
      "name" => ["required", "max:100", "unique:categories,name"],
      "status" => ["required"]
    ]);

    $category = new Category();

    $category->icon = $request->icon;
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->status = $request->status;
    $category->save();

    Toastr::success("Tạo mới danh mục thành công", "Thành công");

    return redirect()->route("admin.category.index");
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
    $category = Category::findOrFail($id);

    return view("admin.category.edit", compact("category"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    $request->validate([
      "icon" => ["not_in:empty"],
      "name" => ["required", "max:100", "unique:categories,name," . $category->id],
      "status" => ["required"]
    ]);

    $category->icon = $request->icon;
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->status = $request->status;
    $category->save();

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    return redirect()->route("admin.category.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $category = Category::findOrFail($id);

    $subCategoryCount = SubCategory::where("category_id", $category->id)->count();

    if ($subCategoryCount > 0) {
      return response([
        "message" => "Danh mục cấp 1 này đang có ít nhất 1 danh mục cấp 2, vui lòng xoá các danh mục cấp 2 trước",
        "status" => "error"
      ]);
    }

    if (Product::where("category_id", $category->id)->count() > 0) {
      return response([
        "message" => "Danh mục cấp 1 này đang có ít nhất 1 sản phẩm, vui lòng xoá các sản phẩm trước",
        "status" => "error"
      ]);
    }

    $category->delete();

    return response([
      "message" => "Xóa danh mục thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $category = Category::findOrFail($request->id);

    $category->status = $request->status == "true" ? 1 : 0;
    $category->save();

    return response([
      "message" => "Cập nhật trạng thái danh mục thành công",
      "status" => "success"
    ]);
  }
}
