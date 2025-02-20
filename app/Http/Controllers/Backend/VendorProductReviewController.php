<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductReviewController extends Controller
{
  public function index()
  {
    $reviews = ProductReview::where("vendor_id", Auth::user()->vendor->id)->latest()->get();

    return view("vendor.review.index", compact("reviews"));
  }
}
