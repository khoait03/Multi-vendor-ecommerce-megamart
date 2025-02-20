<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VendorCondition;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VendorConditionController extends Controller
{
  public function index()
  {
    $condition = VendorCondition::first();

    return view("admin.vendor-condition.index", compact("condition"));
  }

  public function update(Request $request)
  {
    $request->validate([
      "content" => ["required"]
    ]);

    VendorCondition::updateOrCreate([
      "id" => 1
    ], [
      "content" => $request->content
    ]);

    Toastr::success("Cập nhật điều khoản thành công", "Thành công");

    return redirect()->back();
  }
}
