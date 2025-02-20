<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function index()
  {
    $generalSetting = GeneralSetting::first();
    $emailSetting = EmailConfiguration::first();

    return view("admin.setting.index", compact("generalSetting", "emailSetting"));
  }

  public function generalSettingUpdate(Request $request)
  {
    $request->validate([
      "site_name" => ["required", "max:100"],
      "contact_email" => ["required", "email"],
      "contact_phone" => ["required"],
      "contact_address" => ["required"]
    ]);

    GeneralSetting::updateOrCreate([
      "id" => 1
    ], [
      "site_name" => $request->site_name,
      "contact_email" => $request->contact_email,
      "contact_phone" => $request->contact_phone,
      "contact_address" => $request->contact_address,
      "map" => $request->map
    ]);

    Toastr::success("Cập nhật cài đặt thành công", "Thành công");

    return redirect()->back();
  }

  public function emailSettingUpdate(Request $request)
  {
    $request->validate([
      "email" => ["required", "email"],
      "host" => ["required", "max:100"],
      "username" => ["required", "max:100"],
      "password" => ["required", "min:6"],
      "port" => ["required", "max:100"],
      "encryption" => ["required", "max:100"]
    ]);

    EmailConfiguration::updateOrCreate([
      "id" => 1
    ], [
      "email" => $request->email,
      "host" => $request->host,
      "username" => $request->username,
      "password" => $request->password,
      "port" => $request->port,
      "encryption" => $request->encryption
    ]);

    Toastr::success("Cập nhật cài đặt thành công", "Thành công");

    return redirect()->back();
  }
}
