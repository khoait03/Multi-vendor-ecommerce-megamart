<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
  public function index()
  {
    $categories = Category::where("status", 1)->get();
    $popularCategories = HomePageSetting::where("key", "popular_category_section")->first();
    $sliderSectionOne = HomePageSetting::where("key", "product_slider_section_one")->first();
    $sliderSectionTwo = HomePageSetting::where("key", "product_slider_section_two")->first();
    $weeklyBestRated = HomePageSetting::where("key", "weekly_best_rated")->first();
    $weeklyBestSell = HomePageSetting::where("key", "weekly_best_sell")->first();

    return view('admin.home-page-setting.index', compact("categories", "popularCategories", "sliderSectionOne", "sliderSectionTwo", "weeklyBestRated", "weeklyBestSell"));
  }

  public function updatePopularCategorySection(Request $request)
  {
    $data = [
      [
        "category" => $request->category_1,
        "sub_category" => $request->sub_category_1,
        "child_category" => $request->child_category_1,
      ],
      [
        "category" => $request->category_2,
        "sub_category" => $request->sub_category_2,
        "child_category" => $request->child_category_2,
      ],
      [
        "category" => $request->category_3,
        "sub_category" => $request->sub_category_3,
        "child_category" => $request->child_category_3,
      ],
      [
        "category" => $request->category_4,
        "sub_category" => $request->sub_category_4,
        "child_category" => $request->child_category_4,
      ],
      [
        "category" => $request->category_5,
        "sub_category" => $request->sub_category_5,
        "child_category" => $request->child_category_5,
      ],
    ];

    HomePageSetting::updateOrCreate(
      [
        "key" => "popular_category_section"
      ],
      [
        "value" => json_encode($data)
      ]
    );

    Toastr::success("Cập nhật danh mục phổ biến trong tháng thành công", "Thành công");

    return redirect()->back();
  }

  public function updateProductSliderSectionOne(Request $request)
  {
    $request->validate([
      "category_slider_1" => ["required"]
    ]);

    $data = [
      "category" => $request->category_slider_1,
      "sub_category" => $request->sub_category_slider_1,
      "child_category" => $request->child_category_slider_1,
    ];


    HomePageSetting::updateOrCreate(
      [
        "key" => "product_slider_section_one"
      ],
      [
        "value" => json_encode($data)
      ]
    );

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    return redirect()->back();
  }

  public function updateProductSliderSectionTwo(Request $request)
  {
    $request->validate([
      "category_slider_1" => ["required"]
    ]);

    $data = [
      "category" => $request->category_slider_1,
      "sub_category" => $request->sub_category_slider_1,
      "child_category" => $request->child_category_slider_1,
    ];


    HomePageSetting::updateOrCreate(
      [
        "key" => "product_slider_section_two"
      ],
      [
        "value" => json_encode($data)
      ]
    );

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    return redirect()->back();
  }

  public function weeklyBestRated(Request $request)
  {

    $request->validate([
      "category_slider_1" => ["required"]
    ]);

    $data = [
      "category" => $request->category_slider_1,
      "sub_category" => $request->sub_category_slider_1,
      "child_category" => $request->child_category_slider_1,
    ];


    HomePageSetting::updateOrCreate(
      [
        "key" => "weekly_best_rated",
      ],
      [
        "value" => json_encode($data)
      ]
    );

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    return redirect()->back();
  }

  public function weeklyBestSell(Request $request)
  {

    $request->validate([
      "category_slider_1" => ["required"]
    ]);

    $data = [
      "category" => $request->category_slider_1,
      "sub_category" => $request->sub_category_slider_1,
      "child_category" => $request->child_category_slider_1,
    ];


    HomePageSetting::updateOrCreate(
      [
        "key" => "weekly_best_sell",
      ],
      [
        "value" => json_encode($data)
      ]
    );

    Toastr::success("Cập nhật danh mục thành công", "Thành công");

    return redirect()->back();
  }
}