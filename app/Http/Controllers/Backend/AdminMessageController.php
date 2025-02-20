<?php

namespace App\Http\Controllers\Backend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMessageController extends Controller
{
  use ImageUploadTraits;

  public function index()
  {
    $userId = Auth::user()->id;

    $chatUsers = Chat::with("senderProfile")->select(["sender_id"])->where("receiver_id", $userId)->where("sender_id", "!=", $userId)->groupBy("sender_id")->get();

    return view('admin.message.index', compact("chatUsers"));
  }

  public function getMessages(Request $request)
  {
    $senderId = Auth::user()->id;
    $receiverId = $request->receiverId;

    $messages = Chat::whereIn("receiver_id", [$senderId, $receiverId])->whereIn("sender_id", [$senderId, $receiverId])->orderBy("created_at", "asc")->get();

    Chat::where(["sender_id" => $receiverId, "receiver_id" => $senderId])->update(["seen" => 1]);

    $messages->each(function ($message) {
      $message->images = json_decode($message->images);
    });

    return response($messages);
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
    $message->images = json_encode($images);
    $message->save();

    broadcast(new MessageEvent($message->message, $message->receiver_id, $message->created_at, $images));

    return response([
      "message" => "Gửi tin nhắn thành công",
      "status" => "success"
    ]);
  }
}
