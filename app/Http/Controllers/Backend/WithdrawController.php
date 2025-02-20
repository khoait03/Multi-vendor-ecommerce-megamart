<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
  use ImageUploadTraits;

  public function index()
  {
    $withdraws = WithdrawRequest::latest()->get();

    return view("admin.withdraw.index", compact("withdraws"));
  }

  public function show($id)
  {

    $request = WithdrawRequest::findOrFail($id);

    return view("admin.withdraw.show", compact("request"));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      "status" => ["required", "in:pending,paid,deny"],
      "image" => ["required", "image", "max:3000"]
    ]);


    $imagePath = $this->uploadImage($request, "image", "uploads/withdraws");

    $withdraw = WithdrawRequest::findOrFail($id);
    $withdraw->status = $request->status;
    $withdraw->image = $imagePath;
    $withdraw->save();

    Toastr::success("Cập nhật trạng thái rút tiền thành công", "Thành công");

    return redirect()->back();
  }
}
