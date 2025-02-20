<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\NewLetter;
use App\Models\NewLetterSubscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
  public function index()
  {
    $subscribers = NewLetterSubscriber::latest()->get();

    return view('admin.subscriber.index', compact("subscribers"));
  }

  public function sendMail(Request $request)
  {
    $request->validate([
      "title" => ["required"],
      "content" => ["required"]
    ]);

    $emails = NewLetterSubscriber::where("is_verified", 1)->pluck("email")->toArray();

    Mail::to($emails)->send(new NewLetter($request->title, $request->content));

    Toastr::success("Gửi tin tức thành công", "Thành công");

    return redirect()->back();
  }
}
