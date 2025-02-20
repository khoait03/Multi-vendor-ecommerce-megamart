<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\Blog;
use App\Models\EmailConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
  public function about()
  {
    $about = About::first();

    return view('frontend.pages.about', compact("about"));
  }

  public function contact()
  {
    return view('frontend.pages.contact');
  }

  public function handleContactForm(Request $request)
  {
    $request->validate([
      "name" => ["required"],
      "phone" => ["required", "digits:10"],
      "email" => ["required", "email"],
      "subject" => ["required"],
      "message" => ["required"]
    ]);

    $settings = EmailConfiguration::first();

    Mail::to($settings->email)->send(new Contact($request->subject, $request->message, $request->email));

    return response([
      "message" => "Gửi liên hệ thành công. Chúng tôi sẽ phản hồi bạn sớm nhất!",
      "status" => "success"
    ]);
  }

  public function blogDetail($slug)
  {
    $blog = Blog::where("slug", $slug)->first();

    $relatedBlogs = Blog::where("category", $blog->category)->latest()->get();

    $latestBlogs = Blog::latest()->get();

    return view('frontend.pages.blog-detail', compact("blog", "relatedBlogs", "latestBlogs"));
  }

  public function blogList()
  {
    $blogs = Blog::where("status", 1)->latest()->paginate(8);

    return view('frontend.pages.blog-list', compact("blogs"));
  }
}
