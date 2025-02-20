<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $shippings = ShippingRule::latest()->get();

    return view("admin.shipping-rule.index", compact("shippings"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.shipping-rule.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "name" => ["required"],
      "type" => ["required"],
      "min_cost" => ["nullable", "integer"],
      "cost" => ["required", "integer"],
      "status" => ["required"]
    ]);

    $shipping = new ShippingRule();

    $shipping->name = $request->name;
    $shipping->type = $request->type;
    $shipping->min_cost = $request->min_cost ?? 0;
    $shipping->cost = $request->cost;
    $shipping->status = $request->status;

    $shipping->save();

    Toastr::success("Tạo mới thông tin vận chuyển thành công", "Thành công");

    return redirect()->route("admin.shipping-rule.index");
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
  public function edit(ShippingRule $shippingRule)
  {
    return view("admin.shipping-rule.edit", compact("shippingRule"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ShippingRule $shippingRule)
  {
    $request->validate([
      "name" => ["required"],
      "type" => ["required"],
      "min_cost" => ["nullable", "integer"],
      "cost" => ["required", "integer"],
      "status" => ["required"]
    ]);

    $shippingRule->name = $request->name;
    $shippingRule->type = $request->type;
    $shippingRule->min_cost = $request->min_cost ?? 0;
    $shippingRule->cost = $request->cost;
    $shippingRule->status = $request->status;

    $shippingRule->save();

    Toastr::success("Cập nhật thông tin vận chuyển thành công", "Thành công");

    return redirect()->route("admin.shipping-rule.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $shipping = ShippingRule::findOrFail($id);
    $shipping->delete();
    return response([
      "message" => "Xóa thông tin vận chuyển thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $shipping = ShippingRule::findOrFail($request->id);

    $shipping->status = $request->status == "true" ? 1 : 0;
    $shipping->save();

    return response([
      "message" => "Cập nhật trạng thái thông tin vận chuyển thành công",
      "status" => "success"
    ]);
  }
}
