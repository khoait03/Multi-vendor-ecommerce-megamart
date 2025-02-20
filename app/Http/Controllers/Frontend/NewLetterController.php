<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewLetterSubscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewLetterController extends Controller
{
  public function newLetterRequest(Request $request)
  {
    $request->validate([
      "email" => ["required", "email"]
    ], [
      "email.required" => "Vui lòng nhập email",
      "email.email" => "Email không hợp lệ"
    ]);

    $existSubscriber = NewLetterSubscriber::where("email", $request->email)->first();

    if (!empty($existSubscriber)) {
      if ($existSubscriber->is_verified == 0) {
        $existSubscriber->verified_token = Str::random(15);
        $existSubscriber->save();

        Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));

        return response([
          "message" => "Đăng ký nhận tin thành công, Vui lòng kiểm tra email để xác thực!",
          "status" => "success"
        ]);
      } elseif ($existSubscriber->is_verified == 1) {
        return response([
          "message" => "Email đã được đăng ký",
          "status" => "error"
        ]);
      }
    } else {
      $subscriber = new NewLetterSubscriber();

      $subscriber->email = $request->email;
      $subscriber->verified_token = Str::random(15);
      $subscriber->is_verified = 0;
      $subscriber->save();

      Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

      return response([
        "message" => "Đăng ký nhận tin thành công, Vui lòng kiểm tra email để xác thực!",
        "status" => "success"
      ]);
    }
  }

  public function newLetterEmailVerify($token)
  {
    $verify = NewLetterSubscriber::where("verified_token", $token)->first();

    if ($verify) {

      if ($verify->is_verified == 1) {
        Toastr::warning("Email đã được xác thực!", "Thông báo");
        return redirect()->route("home");
      }

      // $verify->verified_token = "verified";
      $verify->is_verified = 1;
      $verify->save();
      Toastr::success("Xác thực email thành công!", "Thành công");
      return redirect()->route("home");
    } else {
      Toastr::error("Xác thực email thất bại!", "Thất bại");
      return redirect()->route("home");
    }
  }
}
