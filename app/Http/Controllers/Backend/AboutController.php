<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function index()
  {
    $about = About::first();

    return view("admin.about.index", compact("about"));
  }

  public function update(Request $request)
  {
    $request->validate([
      "content" => ["required"]
    ]);

    About::updateOrCreate([
      "id" => 1
    ], [
      "content" => $request->content
    ]);

    Toastr::success("Cập nhật giới thiệu thành công", "Thành công");

    return redirect()->back();
  }
}
