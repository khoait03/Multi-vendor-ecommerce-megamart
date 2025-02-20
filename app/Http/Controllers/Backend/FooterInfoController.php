<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterInfoController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $footerInfo = FooterInfo::first();

    return view("admin.footer.footer-info.index", compact("footerInfo"));
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
    //
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
    $request->validate([
      "logo" => ["nullable", "image", "max:3000"],
      "phone" => ["nullable", "digits:10"],
      "email" => ["nullable", "email"],
      "address" => ["nullable"]
    ]);

    $footerInfo = FooterInfo::find($id);

    $imagePath = $this->updateImage($request, "logo", "uploads/footer", $footerInfo?->logo);

    FooterInfo::updateOrCreate([
      "id" => 1
    ], [
      "logo" => $imagePath ?? $footerInfo->banner,
      "email" => $request->email,
      "phone" => $request->phone,
      "address" => $request->address
    ]);

    Toastr::success("Cập nhật thông tin thành công", "Thành công");

    Cache::forget("footer_info");

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
