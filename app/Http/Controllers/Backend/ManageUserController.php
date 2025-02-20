<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreateMail;
use App\Models\User;
use App\Models\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
  public function index()
  {
    $users = User::latest()->get();

    return view("admin.manage-user.index", compact("users"));
  }

  public function create(Request $request)
  {
    $request->validate([
      "name" => ["required"],
      "email" => ["required", "email", "unique:users"],
      "password" => ["required", "min:6", "confirmed"],
      "role" => ["required"]
    ]);

    $user = new User();

    if ($request->role == "user") {
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password =  bcrypt($request->password);
      $user->role = $request->role;
      $user->status = "active";
      $user->save();

      Mail::to($request->email)->send(new AccountCreateMail($request->name, $request->email, $request->password, $request->role));

      Toastr::success("Tạo mới tài khoản thành công", "Thành công");

      return redirect()->back();
    }

    if ($request->role == "vendor") {
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password =  bcrypt($request->password);
      $user->role = $request->role;
      $user->status = "active";
      $user->save();

      $vendor = new Vendor();

      $vendor->banner = "uploads/vendor/123.png";
      $vendor->name = $request->name . " Shop";
      $vendor->email = "vendor_new" . rand(1, 999999999) . "@gmail.com";
      $vendor->phone = "1234567891";
      $vendor->address = "Việt Nam";
      $vendor->description = "Gian hàng mới";
      $vendor->user_id = $user->id;
      $vendor->status = 1;

      $vendor->save();

      Mail::to($request->email)->send(new AccountCreateMail($request->name, $request->email, $request->password, $request->role));

      Toastr::success("Tạo mới tài khoản thành công", "Thành công");

      return redirect()->back();
    }

    if ($request->role == "admin") {
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password =  bcrypt($request->password);
      $user->role = $request->role;
      $user->status = "active";
      $user->save();

      // $vendor = new Vendor();

      // $vendor->banner = "uploads/vendor/123.png";
      // $vendor->name = $request->name . "Shop";
      // $vendor->email = "vendor_new" . rand(1, 999999999) . "@gmail.com";
      // $vendor->phone = "1234567891";
      // $vendor->address = "Việt Nam";
      // $vendor->description = "Gian hàng mới";
      // $vendor->user_id = $user->id;
      // $vendor->status = 1;

      // $vendor->save();

      Mail::to($request->email)->send(new AccountCreateMail($request->name, $request->email, $request->password, $request->role));

      Toastr::success("Tạo mới tài khoản thành công", "Thành công");

      return redirect()->back();
    }
  }

  public function changeStatus(Request $request)
  {
    $user = User::findOrFail($request->id);

    $user->status = $request->status == "true" ? "active" : "inactive";
    $user->save();

    return response([
      "message" => "Cập nhật trạng thái tài khoản thành công",
      "status" => "success"
    ]);
  }
}
