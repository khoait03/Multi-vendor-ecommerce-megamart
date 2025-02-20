<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\DataTables\SliderDataTable;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
  use ImageUploadTraits;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // return $dataTable->render('admin.slider.index');
    $sliders = Slider::latest()->get();
    return view('admin.slider.index', compact('sliders'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("admin.slider.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      "banner" => ["required", "image", "max:2000"],
      "type" => ["required", "string", "max:200"],
      "title" => ["required", "string", "max:200"],
      "starting_price" => ["required", "max:200"],
      "btn_url" => ["url"],
      "serial" => ["required", "integer"],
      "status" => ["required"]
    ]);

    $slider = new Slider();

    $imagePath = $this->uploadImage($request, "banner", "uploads/sliders");

    $slider->banner = $imagePath;
    $slider->type = $request->type;
    $slider->title = $request->title;
    $slider->starting_price = $request->starting_price;
    $slider->btn_url = $request->btn_url;
    $slider->serial = $request->serial;
    $slider->status = $request->status;
    $slider->save();

    Toastr::success("Tạo mới slider thành công", "Thành công");

    Cache::forget("sliders");

    return redirect()->route("admin.slider.index");
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
  public function edit(Slider $slider)
  {
    return view("admin.slider.edit", compact("slider"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Slider $slider)
  {
    $request->validate([
      "banner" => ["nullable", "image", "max:2000"],
      "type" => ["required", "string", "max:200"],
      "title" => ["required", "string", "max:200"],
      "starting_price" => ["required", "max:200"],
      "btn_url" => ["url"],
      "serial" => ["required", "integer"],
      "status" => ["required"]
    ]);

    $imagePath = $this->updateImage($request, "banner", "uploads/sliders", $slider->banner);

    $slider->banner = $imagePath ?? $slider->banner;
    $slider->type = $request->type;
    $slider->title = $request->title;
    $slider->starting_price = $request->starting_price;
    $slider->btn_url = $request->btn_url;
    $slider->serial = $request->serial;
    $slider->status = $request->status;
    $slider->save();

    Toastr::success("Cập nhật slider thành công", "Thành công");

    Cache::forget("sliders");

    return redirect()->route("admin.slider.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $slider = Slider::findOrFail($id);

    $this->deleteImage($slider->banner);

    $slider->delete();

    Cache::forget("sliders");

    return response([
      "message" => "Xóa slider thành công",
      "status" => "success"
    ]);
  }

  public function changeStatus(Request $request)
  {
    $slider = Slider::findOrFail($request->id);

    $slider->status = $request->status == "true" ? 1 : 0;
    $slider->save();

    Cache::forget("sliders");

    return response([
      "message" => "Cập nhật trạng thái slider thành công",
      "status" => "success"
    ]);
  }
}
