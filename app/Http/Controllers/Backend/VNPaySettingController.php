<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VNPaySetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VNPaySettingController extends Controller
{
  public function update(Request $request, string $id)
  {
    $request->validate([
      "status" => ["required"],
      "mode" => ["required"],
      "client_id" => ["required"],
      "secret_key" => ["required"]
    ]);

    VNPaySetting::updateOrCreate(
      [
        "id" => 1
      ],
      [
        "status" => $request->status,
        "mode" => $request->mode,
        "client_id" => $request->client_id,
        "secret_key" => $request->secret_key,
      ]
    );

    Toastr::success("Cập nhật thông tin thanh toán thành công", "Thành công");

    return redirect()->back();
  }
}
