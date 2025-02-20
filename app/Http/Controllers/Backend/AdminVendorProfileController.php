<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $profile = Vendor::where("user_id", Auth::user()->id)->first();

    return view("admin.vendor-profile.index", compact("profile"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "banner" => ["nullable", "image", "max:2000"],
      "name" => ["required", "string", "max:100"],
      "email" => ["required", "email", "max:100"],
      "phone" => ["required", "digits:10"],
      "address" => ["required", "string", "max:100"],
      "description" => ["required", "string", "max:1000"],
      "fb_link" => ["nullable", "url"],
      "tw_link" => ["nullable", "url"],
      "insta_link" => ["nullable", "url"],
    ]);

    $vendor = Vendor::where("user_id", Auth::user()->id)->first();

    $imagePath = $this->updateImage($request, "banner", "uploads/vendors", $vendor->banner);

    $vendor->banner = $imagePath ?? $vendor->banner;
    $vendor->name = $request->name;
    $vendor->email = $request->email;
    $vendor->phone = $request->phone;
    $vendor->address = $request->address;
    $vendor->description = $request->description;
    $vendor->fb_link = $request->fb_link;
    $vendor->tw_link = $request->tw_link;
    $vendor->insta_link = $request->insta_link;
    $vendor->save();

    Toastr::success('Cập nhật thông tin gian hàng thành công!', 'Thành công');

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
