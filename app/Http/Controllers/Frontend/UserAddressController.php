<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $addresses = UserAddress::where("user_id", Auth::user()->id)->latest()->get();

    return view("frontend.dashboard.address.index", compact("addresses"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("frontend.dashboard.address.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "name" => ["required"],
      "email" => ["required", "email"],
      "phone" => ["required", "digits:10"],
      "province_city_name" => ["required"],
      "district_name" => ["required"],
      "commune_ward_name" => ["required"],
      "address" => ["required"],
    ]);

    $address = new UserAddress();

    $address->user_id = Auth::user()->id;
    $address->name = $request->name;
    $address->email = $request->email;
    $address->phone = $request->phone;
    $address->province_city = $request->province_city;
    $address->district = $request->district;
    $address->commune_ward = $request->commune_ward;
    $address->address = $request->address;
    $address->other = $request->other;

    $address->save();

    Toastr::success("Tạo mới địa chỉ thành công", "Thành công");

    return redirect()->route("user.address.index");
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
  public function edit(UserAddress $address)
  {
    return view("frontend.dashboard.address.edit", compact("address"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, UserAddress $address)
  {
    $request->validate([
      "name" => ["required"],
      "email" => ["required", "email"],
      "phone" => ["required", "digits:10"],
      "province_city_name" => ["required"],
      "district_name" => ["required"],
      "commune_ward_name" => ["required"],
      "address" => ["required"],
    ]);

    $address->name = $request->name;
    $address->email = $request->email;
    $address->phone = $request->phone;
    $address->province_city = $request->province_city;
    $address->district = $request->district;
    $address->commune_ward = $request->commune_ward;
    $address->address = $request->address;
    $address->other = $request->other;

    $address->save();

    Toastr::success("Chỉnh sửa địa chỉ thành công", "Thành công");

    return redirect()->route("user.address.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $address = UserAddress::findOrFail($id);
    $address->delete();

    return response([
      "message" => "Xóa địa chỉ thành công",
      "status" => "success"
    ]);
  }
}
