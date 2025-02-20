<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CODSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CODSettingController extends Controller
{
  public function update(Request $request, string $id)
  {
    $request->validate([
      "status" => ["required"],
    ]);

    CODSetting::updateOrCreate(
      [
        "id" => 1
      ],
      [
        "status" => $request->status,
      ]
    );

    Toastr::success("Cập nhật thông tin thanh toán thành công", "Thành công");

    return redirect()->back();
  }
}
