<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
  use ImageUploadTraits;

  public function index()
  {
    $userId = Auth::user()->id;

    $chatUsers = Chat::with("receiverProfile.vendor")->select(["receiver_id"])->where("sender_id", $userId)->where("receiver_id", "!=", $userId)->groupBy("receiver_id")->get();

    return view('frontend.dashboard.message.index', compact("chatUsers"));
  }

  public function sendMessage(Request $request)
  {
    $request->validate([
      "message" => ["required"],
      "receiver_id" => ["required"],
      "images" => ["nullable"],
      "images.*" => ["nullable", "image", "max:10000"],
    ], [
      "message.required" => "Vui lòng nhập tin nhắn"
    ]);

    $images = [];
    if ($request->hasFile('images')) {
      $imagePaths = $this->uploadMultiImage($request, "images", "uploads/messages");
      foreach ($imagePaths as $imagePath) {
        array_push($images, asset($imagePath));
      }
    }

    $message = new Chat();
    $message->sender_id = Auth::user()->id;
    $message->receiver_id = $request->receiver_id;
    $message->message = $request->message;
    $message->images = json_encode($images); // Save images as JSON
    $message->save();

    broadcast(new MessageEvent($message->message, $message->receiver_id, $message->created_at, $images));

    return response([
      "message" => "Gửi tin nhắn thành công",
      "status" => "success"
    ]);
  }

  public function getMessages(Request $request)
  {
    $senderId = Auth::user()->id;
    $receiverId = $request->receiverId;

    $messages = Chat::whereIn("receiver_id", [$senderId, $receiverId])->whereIn("sender_id", [$senderId, $receiverId])->orderBy("created_at", "asc")->get();

    Chat::where(["sender_id" => $receiverId, "receiver_id" => $senderId])->update(["seen" => 1]);

    $vendorName = User::where("id", $receiverId)->first();

    $messages->each(function ($message) {
      $message->images = json_decode($message->images);
    });

    return response([
      "messages" => $messages,
      "vendorName" => $vendorName->vendor->name
    ]);

    // return response($messages);
  }
}
