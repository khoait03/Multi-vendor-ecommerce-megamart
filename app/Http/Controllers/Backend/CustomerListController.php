<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
  public function index()
  {
    $customers = User::where("role", "user")->latest()->get();

    return view("admin.customer-list.index", compact("customers"));
  }

  public function changeStatus(Request $request)
  {
    $customer = User::findOrFail($request->id);

    $customer->status = $request->status == "true" ? "active" : "inactive";
    $customer->save();

    return response([
      "message" => "Cập nhật trạng thái khách hàng thành công",
      "status" => "success"
    ]);
  }
}
