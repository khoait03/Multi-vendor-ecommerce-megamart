<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTraits
{

  public function uploadImage(Request $request, $inputName, $path)
  {
    if ($request->hasFile($inputName)) {
      $image = $request->{$inputName};
      $ext = $image->getClientOriginalExtension();
      $imageName = "image_" . uniqid() . "." . $ext;
      $image->move(public_path($path), $imageName);

      return $path . "/" . $imageName;
    }
  }

  public function uploadMultiImage(Request $request, $inputName, $path)
  {
    $paths = [];

    if ($request->hasFile($inputName)) {
      $images = $request->{$inputName};

      foreach ($images as $image) {
        $ext = $image->getClientOriginalExtension();
        $imageName = "image_" . uniqid() . "." . $ext;
        $image->move(public_path($path), $imageName);
        $paths[] = $path . "/" . $imageName;
      }
      return $paths;
    }
  }

  public function updateImage(Request $request, $inputName, $path, $oldPath = null)
  {
    if ($request->hasFile($inputName)) {
      if (File::exists(public_path($oldPath))) {
        File::delete(public_path($oldPath));
      };

      $image = $request->{$inputName};
      $ext = $image->getClientOriginalExtension();
      $imageName = "image_" . uniqid() . "." . $ext;
      $image->move(public_path($path), $imageName);

      return $path . "/" . $imageName;
    }
  }

  public function deleteImage($path)
  {
    if (File::exists(public_path($path))) {
      File::delete(public_path($path));
    };
  }
}
