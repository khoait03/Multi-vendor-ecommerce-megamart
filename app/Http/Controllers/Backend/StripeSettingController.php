<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{
  public function update(Request $request, string $id)
  {
    $request->validate([
      "status" => ["required"],
      "mode" => ["required"],
      "country_name" => ["required"],
      "currency_name" => ["required"],
      "currency_rate" => ["required"],
      "client_id" => ["required"],
      "secret_key" => ["required"]
    ]);

    StripeSetting::updateOrCreate(
      [
        "id" => 1
      ],
      [
        "status" => $request->status,
        "mode" => $request->mode,
        "country_name" => $request->country_name,
        "currency_name" => $request->currency_name,
        "currency_rate" => $request->currency_rate,
        "client_id" => $request->client_id,
        "secret_key" => $request->secret_key,
      ]
    );

    Toastr::success("Cập nhật thông tin thanh toán thành công", "Thành công");

    return redirect()->back();
  }
}
