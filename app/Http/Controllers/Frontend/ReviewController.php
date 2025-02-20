<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
  use ImageUploadTraits;

  public function index()
  {
    $reviews = ProductReview::where("user_id", Auth::user()->id)->latest()->get();

    return view("frontend.dashboard.review.index", compact("reviews"));
  }

  public function createReview(Request $request)
  {
    $request->validate([
      "rating" => ["required"],
      "review" => ["required"],
      "image" => ["nullable"],
      "image.*" => ["nullable", "image", "max:3000"],
    ]);

    // $checkReviewExist = ProductReview::where(["product_id" => $request->product_id, "user_id" => Auth::user()->id])->first();
    // if (!empty($checkReviewExist)) {
    //   Toastr::warning("Bạn đã đánh giá sản phẩm này rồi", "Thông báo");

    //   return redirect()->back();
    // }

    $imagePaths = $this->uploadMultiImage($request, "image", "uploads/reviews");

    $productReview = new ProductReview();

    $productReview->product_id = $request->product_id;
    $productReview->user_id = Auth::user()->id;
    $productReview->rating = $request->rating;
    $productReview->review = $request->review;
    $productReview->vendor_id = $request->vendor_id;
    $productReview->status = 1;
    $productReview->save();

    if (!empty($imagePaths)) {
      foreach ($imagePaths as $imagePath) {
        $reviewGallery = new ProductReviewGallery();

        $reviewGallery->product_review_id = $productReview->id;
        $reviewGallery->image = $imagePath;

        $reviewGallery->save();
      }
    }

    Toastr::success("Tạo mới đánh giá thành công", "Thành công");

    return redirect()->back();
  }

  public function edit(string $id)
  {
    $review = ProductReview::findOrFail($id);

    return view("frontend.dashboard.review.edit", compact("review"));
  }

  public function update(Request $request, string $id)
  {
    $request->validate([
      "rating" => ["required"],
      "review" => ["required"],
      "image" => ["nullable"],
      "image.*" => ["nullable", "image", "max:3000"],
    ]);

    $imagePaths = $this->uploadMultiImage($request, "image", "uploads/reviews");

    $review = ProductReview::findOrFail($id);
    $review->rating = $request->rating;
    $review->review = $request->review;
    $review->save();

    if (!empty($imagePaths)) {
      $imageGallery = ProductReviewGallery::where("product_review_id", $review->id)->get();
      foreach ($imageGallery as $image) {
        $this->deleteImage($image->image);
        $image->delete();
      }

      foreach ($imagePaths as $imagePath) {
        $reviewGallery = new ProductReviewGallery();

        $reviewGallery->product_review_id = $review->id;
        $reviewGallery->image = $imagePath;

        $reviewGallery->save();
      }
    }

    Toastr::success("Cập nhật đánh giá thành công", "Thành công");

    return redirect()->back();
  }

  public function destroy(string $id)
  {
    $review = ProductReview::findOrFail($id);
    $review->delete();
    return response([
      "message" => "Xóa đánh giá thành công",
      "status" => "success"
    ]);
  }
}
