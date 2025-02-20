<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterGridTwo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridTwoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $footerContents = FooterGridTwo::latest()->get();

    return view("admin.footer.footer-grid-two.index", compact("footerContents"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.footer.footer-grid-two.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "column" => ["required"],
      "name" => ["required", "max:100"],
      "url" => ["required", "url"],
      "status" => ["required"]
    ]);

    $footer = new FooterGridTwo();

    $footer->column = $request->column;
    $footer->name = $request->name;
    $footer->url = $request->url;
    $footer->status = $request->status;
    $footer->save();

    Toastr::success("Tạo mới nội dung thành công", "Thành công");

    Cache::forget("footer_content_1");
    Cache::forget("footer_content_2");

    return redirect()->route("admin.footer-grid-two.index");
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
  public function edit(FooterGridTwo $footerGridTwo)
  {
    return view("admin.footer.footer-grid-two.edit", compact("footerGridTwo"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, FooterGridTwo $footerGridTwo)
  {
    $request->validate([
      "column" => ["required"],
      "name" => ["required", "max:100"],
      "url" => ["required", "url"],
      "status" => ["required"]
    ]);

    $footerGridTwo->column = $request->column;
    $footerGridTwo->name = $request->name;
    $footerGridTwo->url = $request->url;
    $footerGridTwo->status = $request->status;
    $footerGridTwo->save();

    Toastr::success("Cập nhật nội dung thành công", "Thành công");

    Cache::forget("footer_content_1");
    Cache::forget("footer_content_2");

    return redirect()->route("admin.footer-grid-two.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $footer = FooterGridTwo::findOrFail($id);
    $footer->delete();

    Cache::forget("footer_content_1");
    Cache::forget("footer_content_2");

    return response([
      "message" => "Xóa nội dung thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $footer = FooterGridTwo::findOrFail($request->id);

    $footer->status = $request->status == "true" ? 1 : 0;
    $footer->save();

    Cache::forget("footer_content_1");
    Cache::forget("footer_content_2");

    return response([
      "message" => "Cập nhật trạng thái nội dung thành công",
      "status" => "success"
    ]);
  }
}
