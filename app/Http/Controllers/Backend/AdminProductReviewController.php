<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminProductReviewController extends Controller
{
  public function index()
  {
    $reviews = ProductReview::latest()->get();

    return view('admin.review.index', compact("reviews"));
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

  public function changeStatus(Request $request)
  {
    $review = ProductReview::findOrFail($request->id);

    $review->status = $request->status == "true" ? 1 : 0;
    $review->save();

    return response([
      "message" => "Cập nhật trạng thái đánh giá thành công",
      "status" => "success"
    ]);
  }
}
