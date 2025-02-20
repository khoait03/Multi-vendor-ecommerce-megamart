<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
  use ImageUploadTraits;

  public function index()
  {
    $homePageBannerOne = Advertisement::where("key", "home_page_banner_one")->first();
    $homePageBannerOne = json_decode($homePageBannerOne?->value);
    $homePageBannerTwo = Advertisement::where("key", "home_page_banner_two")->first();
    $homePageBannerTwo = json_decode($homePageBannerTwo?->value);
    $homePageBannerThree = Advertisement::where("key", "home_page_banner_three")->first();
    $homePageBannerThree = json_decode($homePageBannerThree?->value);
    $homePageBannerFour = Advertisement::where("key", "home_page_banner_four")->first();
    $homePageBannerFour = json_decode($homePageBannerFour?->value);

    return view('admin.advertisement.index', compact("homePageBannerOne", "homePageBannerTwo", "homePageBannerThree", "homePageBannerFour"));
  }

  public function homePageBannerOne(Request $request)
  {
    $request->validate([
      "banner_image" => ["nullable", "image", "max:3000"],
      "banner_url" => ["required", "url"],
    ]);

    $imagePath = $this->updateImage($request, "banner_image", "uploads/banners");

    $value = [
      "banner_one" => [
        "banner_url" => $request->banner_url,
        "status" => $request->status == "on" ? 1 : 0
      ]
    ];

    if (!empty($imagePath)) {
      $value["banner_one"]["banner_image"] = $imagePath;
    } else {
      $data = Advertisement::where("key", "home_page_banner_one")->first();
      $data = json_decode($data->value);
      $value["banner_one"]["banner_image"] = $data->banner_one->banner_image;
    }

    $value = json_encode($value);

    Advertisement::updateOrCreate([
      "key" => "home_page_banner_one",
    ], [
      "value" => $value
    ]);

    Toastr::success("Cập nhật quảng cáo thành công", "Thành công");

    return redirect()->back();
  }

  public function homePageBannerTwo(Request $request)
  {
    $request->validate([
      "banner_one_image" => ["nullable", "image", "max:3000"],
      "banner_two_image" => ["nullable", "image", "max:3000"],
      "banner_one_url" => ["required", "url"],
      "banner_two_url" => ["required", "url"],
    ]);

    $imagePathOne = $this->updateImage($request, "banner_one_image", "uploads/banners");
    $imagePathTwo = $this->updateImage($request, "banner_two_image", "uploads/banners");

    $value = [
      "banner_one" => [
        "banner_url" => $request->banner_one_url,
        "status" => $request->banner_one_status == "on" ? 1 : 0
      ],
      "banner_two" => [
        "banner_url" => $request->banner_two_url,
        "status" => $request->banner_two_status == "on" ? 1 : 0
      ]
    ];

    if (!empty($imagePathOne)) {
      $value["banner_one"]["banner_image"] = $imagePathOne;
    } else {
      $data = Advertisement::where("key", "home_page_banner_two")->first();
      $data = json_decode($data->value);
      $value["banner_one"]["banner_image"] = $data->banner_one->banner_image;
    }

    if (!empty($imagePathTwo)) {
      $value["banner_two"]["banner_image"] = $imagePathTwo;
    } else {
      $data = Advertisement::where("key", "home_page_banner_two")->first();
      $data = json_decode($data->value);
      $value["banner_two"]["banner_image"] = $data->banner_two->banner_image;
    }

    $value = json_encode($value);

    Advertisement::updateOrCreate([
      "key" => "home_page_banner_two",
    ], [
      "value" => $value
    ]);

    Toastr::success("Cập nhật quảng cáo thành công", "Thành công");

    return redirect()->back();
  }

  public function homePageBannerThree(Request $request)
  {
    $request->validate([
      "banner_one_image" => ["nullable", "image", "max:3000"],
      "banner_two_image" => ["nullable", "image", "max:3000"],
      "banner_three_image" => ["nullable", "image", "max:3000"],
      "banner_one_url" => ["required", "url"],
      "banner_two_url" => ["required", "url"],
      "banner_three_url" => ["required", "url"],
    ]);

    $imagePathOne = $this->updateImage($request, "banner_one_image", "uploads/banners");
    $imagePathTwo = $this->updateImage($request, "banner_two_image", "uploads/banners");
    $imagePathThree = $this->updateImage($request, "banner_three_image", "uploads/banners");

    $value = [
      "banner_one" => [
        "banner_url" => $request->banner_one_url,
        "status" => $request->banner_one_status == "on" ? 1 : 0
      ],
      "banner_two" => [
        "banner_url" => $request->banner_two_url,
        "status" => $request->banner_two_status == "on" ? 1 : 0
      ],
      "banner_three" => [
        "banner_url" => $request->banner_three_url,
        "status" => $request->banner_three_status == "on" ? 1 : 0
      ]
    ];

    if (!empty($imagePathOne)) {
      $value["banner_one"]["banner_image"] = $imagePathOne;
    } else {
      $data = Advertisement::where("key", "home_page_banner_three")->first();
      $data = json_decode($data->value);
      $value["banner_one"]["banner_image"] = $data->banner_one->banner_image;
    }

    if (!empty($imagePathTwo)) {
      $value["banner_two"]["banner_image"] = $imagePathTwo;
    } else {
      $data = Advertisement::where("key", "home_page_banner_three")->first();
      $data = json_decode($data->value);
      $value["banner_two"]["banner_image"] = $data->banner_two->banner_image;
    }

    if (!empty($imagePathThree)) {
      $value["banner_three"]["banner_image"] = $imagePathThree;
    } else {
      $data = Advertisement::where("key", "home_page_banner_three")->first();
      $data = json_decode($data->value);
      $value["banner_three"]["banner_image"] = $data->banner_three->banner_image;
    }

    $value = json_encode($value);

    Advertisement::updateOrCreate([
      "key" => "home_page_banner_three",
    ], [
      "value" => $value
    ]);

    Toastr::success("Cập nhật quảng cáo thành công", "Thành công");

    return redirect()->back();
  }

  public function homePageBannerFour(Request $request)
  {
    $request->validate([
      "banner_image" => ["nullable", "image", "max:3000"],
      "banner_url" => ["required", "url"],
    ]);

    $imagePath = $this->updateImage($request, "banner_image", "uploads/banners");

    $value = [
      "banner_one" => [
        "banner_url" => $request->banner_url,
        "status" => $request->status == "on" ? 1 : 0
      ]
    ];

    if (!empty($imagePath)) {
      $value["banner_one"]["banner_image"] = $imagePath;
    } else {
      $data = Advertisement::where("key", "home_page_banner_four")->first();
      $data = json_decode($data->value);
      $value["banner_one"]["banner_image"] = $data->banner_one->banner_image;
    }

    $value = json_encode($value);

    Advertisement::updateOrCreate([
      "key" => "home_page_banner_four",
    ], [
      "value" => $value
    ]);

    Toastr::success("Cập nhật quảng cáo thành công", "Thành công");

    return redirect()->back();
  }
}
