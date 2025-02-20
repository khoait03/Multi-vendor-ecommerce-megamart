<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
  public function index()
  {
    $vendors = User::whereIn('role', ['vendor', 'admin'])->latest()->get();

    return view("admin.vendor-list.index", compact("vendors"));
  }

  public function changeStatus(Request $request)
  {
    $customer = User::findOrFail($request->id);

    $customer->status = $request->status == "true" ? "active" : "inactive";
    $customer->save();

    return response([
      "message" => "Cập nhật trạng thái gian hàng thành công",
      "status" => "success"
    ]);
  }
}
