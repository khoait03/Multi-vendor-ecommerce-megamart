<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $withdrawMethods = WithdrawMethod::latest()->get();

    return view("admin.withdraw-method.index", compact("withdrawMethods"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.withdraw-method.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "name" => ["required", "max:200"],
      "minimum_amount" => ["required", "numeric", "lt:maximum_amount"],
      "maximum_amount" => ["required", "numeric", "gt:minimum_amount"],
      "withdraw_charge" => ["required", "numeric", "max:100"],
      "description" => ["required"]
    ]);

    $method = new WithdrawMethod();
    $method->name = $request->name;
    $method->minimum_amount = $request->minimum_amount;
    $method->maximum_amount = $request->maximum_amount;
    $method->withdraw_charge = $request->withdraw_charge;
    $method->description = $request->description;
    $method->save();

    Toastr::success("Tạo mới phương thức thành công", "Thành công");

    return redirect()->route("admin.withdraw-method.index");
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
    $method = WithdrawMethod::findOrFail($id);

    return view("admin.withdraw-method.edit", compact("method"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      "name" => ["required", "max:200"],
      "minimum_amount" => ["required", "numeric", "lt:maximum_amount"],
      "maximum_amount" => ["required", "numeric", "gt:minimum_amount"],
      "withdraw_charge" => ["required", "numeric", "max:100"],
      "description" => ["required"]
    ]);

    $method = WithdrawMethod::findOrFail($id);
    $method->name = $request->name;
    $method->minimum_amount = $request->minimum_amount;
    $method->maximum_amount = $request->maximum_amount;
    $method->withdraw_charge = $request->withdraw_charge;
    $method->description = $request->description;
    $method->save();

    Toastr::success("Chỉnh sửa phương thức thành công", "Thành công");

    return redirect()->route("admin.withdraw-method.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $method = WithdrawMethod::findOrFail($id);
    $method->delete();

    return response([
      "message" => "Xóa phương thức thành công",
      "status" => "success"
    ]);
  }
}
