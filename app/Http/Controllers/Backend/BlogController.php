<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $blogs = Blog::latest()->get();

    return view("admin.blog.index", compact("blogs"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.blog.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "image" => ["required", "image", "max:3000"],
      "title" => ["required", "unique:blogs,title"],
      "category" => ["required"],
      "description" => ["required"],
      "status" => ["required"]
    ]);

    $imagePath = $this->uploadImage($request, "image", "uploads/blogs");

    $blog = new Blog();

    $blog->image = $imagePath;
    $blog->title = $request->title;
    $blog->slug = Str::slug($request->title);
    $blog->category = $request->category;
    $blog->description = $request->description;
    $blog->status = $request->status;
    $blog->save();

    Toastr::success("Tạo mới bài viết thành công", "Thành công");

    return redirect()->route("admin.blog.index");
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
  public function edit(Blog $blog)
  {
    return view("admin.blog.edit", compact("blog"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Blog $blog)
  {
    $request->validate([
      "image" => ["nullable", "image", "max:3000"],
      "title" => ["required", "unique:blogs,title," . $blog->id],
      "category" => ["required"],
      "description" => ["required"],
      "status" => ["required"]
    ]);

    $imagePath = $this->updateImage($request, "image", "uploads/blogs", $blog->image);

    $blog->image = $imagePath ?? $blog->image;
    $blog->title = $request->title;
    $blog->slug = Str::slug($request->title);
    $blog->category = $request->category;
    $blog->description = $request->description;
    $blog->status = $request->status;
    $blog->save();

    Toastr::success("Chỉnh sửa bài viết thành công", "Thành công");

    return redirect()->route("admin.blog.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $blog = Blog::findOrFail($id);

    $this->deleteImage($blog->image);
    $blog->delete();

    return response([
      "message" => "Xóa bài viết thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $blog = Blog::findOrFail($request->id);

    $blog->status = $request->status == "true" ? 1 : 0;
    $blog->save();

    return response([
      "message" => "Cập nhật trạng thái bài viết thành công",
      "status" => "success"
    ]);
  }
}
