<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CouponController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $coupons = Coupon::latest()->get();

    return view("admin.coupon.index", compact("coupons"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.coupon.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "name" => ["required"],
      "code" => ["required", "unique:coupons,code"],
      "quantity" => ["required", "integer"],
      "max_use" => ["required", "integer"],
      "discount_type" => ["required"],
      "discount" => ["required"],
      "start_date" => ["required"],
      "end_date" => ["required"],
      "status" => ["required"]
    ]);

    $coupon = new Coupon();

    $coupon->name = $request->name;
    $coupon->code = $request->code;
    $coupon->quantity = $request->quantity;
    $coupon->max_use = $request->max_use;
    $coupon->discount_type = $request->discount_type;
    $coupon->discount = $request->discount;
    $coupon->start_date = $request->start_date;
    $coupon->end_date = $request->end_date;
    $coupon->status = $request->status;
    $coupon->total_used = 0;

    $coupon->save();

    Toastr::success("Tạo mới mã giảm giá thành công", "Thành công");

    return redirect()->route("admin.coupons.index");
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
  public function edit(Coupon $coupon)
  {
    return view("admin.coupon.edit", compact("coupon"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Coupon $coupon)
  {
    $request->validate([
      "name" => ["required"],
      "code" => ["required", "unique:coupons,code," . $coupon->id],
      "quantity" => ["required", "integer"],
      "max_use" => ["required", "integer"],
      "discount_type" => ["required"],
      "discount" => ["required"],
      "start_date" => ["required"],
      "end_date" => ["required"],
      "status" => ["required"]
    ]);

    $coupon->name = $request->name;
    $coupon->code = $request->code;
    $coupon->quantity = $request->quantity;
    $coupon->max_use = $request->max_use;
    $coupon->discount_type = $request->discount_type;
    $coupon->discount = $request->discount;
    $coupon->start_date = $request->start_date;
    $coupon->end_date = $request->end_date;
    $coupon->status = $request->status;

    $coupon->save();

    Toastr::success("Cập nhật mã giảm giá thành công", "Thành công");

    return redirect()->route("admin.coupons.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $coupon = Coupon::findOrFail($id);
    $coupon->delete();

    return response([
      "message" => "Xóa mã giảm giá thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $coupon = Coupon::findOrFail($request->id);

    $coupon->status = $request->status == "true" ? 1 : 0;
    $coupon->save();

    return response([
      "message" => "Cập nhật trạng thái mã giảm giá thành công",
      "status" => "success"
    ]);
  }
}
