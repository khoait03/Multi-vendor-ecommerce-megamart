<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendorProfileController extends Controller
{
  public function index()
  {
    return view('vendor.dashboard.profile');
  }

  public function updateProfile(Request $request)
  {
    $request->validate([
      "name" => ["required", "max:100"],
      "email" => ["required", "max:100", "email", "unique:users,email," . Auth::user()->id],
      "phone" => ["required", "digits:10"],
      "image" => ["nullable", "image", "max:2048"]
    ]);

    $user = $request->user();

    if ($request->hasFile("image")) {
      if (File::exists(public_path($user->image))) {
        File::delete(public_path($user->image));
      };

      $image = $request->file("image");
      $imageName = time() . "_" . $image->getClientOriginalName();
      $image->move(public_path("uploads/users"), $imageName);
      $user->image = "uploads/users/" . $imageName;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->save();

    Toastr::success('Cập nhật tài khoản thành công!', 'Thành công');
    return redirect()->back();
  }

  public function updatePassword(Request $request)
  {
    $request->validate([
      "current_password" => ["required", "current_password"],
      "password" => ["required", "confirmed", "min:8"],
      "password_confirmation" => ["required"]
    ]);

    $user = $request->user();
    $user->password =  bcrypt($request->password);
    $user->save();

    Toastr::success('Cập nhật mật khẩu thành công!', 'Thành công');
    return redirect()->back();
  }
}
