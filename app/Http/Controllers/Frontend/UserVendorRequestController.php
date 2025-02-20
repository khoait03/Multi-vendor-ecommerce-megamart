<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCondition;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVendorRequestController extends Controller
{
  use ImageUploadTraits;

  public function index()
  {
    $vendor = Vendor::where("user_id", Auth::user()->id)->first();

    $condition = VendorCondition::first();

    return view('frontend.dashboard.vendor-request.index', compact("vendor", "condition"));
  }

  public function create(Request $request)
  {
    $request->validate([
      "shop_image" => ["required", "image", "max:3000"],
      "shop_name" => ["required", "max:200"],
      "shop_email" => ["required", "email"],
      "shop_phone" => ["required", "digits:10"],
      "shop_address" => ["required"],
      "shop_description" => ["required"]
    ]);

    $imagePath = $this->uploadImage($request, "shop_image", "uploads/vendors");

    $vendor = new Vendor();

    $vendor->user_id = Auth::user()->id;
    $vendor->banner = $imagePath;
    $vendor->name = $request->shop_name;
    $vendor->email = $request->shop_email;
    $vendor->phone = $request->shop_phone;
    $vendor->address = $request->shop_address;
    $vendor->description = $request->shop_description;
    $vendor->status = 0;
    $vendor->save();

    Toastr::success("Đăng ký trở thành gian hàng thành công. Vui lòng đợi quản trị viên xét duyệt", "Thành công");

    return redirect()->back();
  }
}
