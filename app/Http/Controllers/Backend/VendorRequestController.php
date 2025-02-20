<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
  public function index()
  {
    $vendors = Vendor::where("status", 0)->latest()->get();

    return view('admin.vendor-request.index', compact("vendors"));
  }

  public function show($id)
  {
    $vendor = Vendor::findOrFail($id);

    return view("admin.vendor-request.show", compact("vendor"));
  }

  public function changeStatus(Request $request, $id)
  {
    $vendor = Vendor::findOrFail($id);
    $vendor->status = $request->status;
    $vendor->save();

    $user = User::findOrFail($vendor->user_id);
    $user->role = "vendor";
    $user->save();

    Toastr::success("Cập nhật trạng thái thành công", "Thành công");

    return redirect()->back();
  }
}
