<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::where("email", "vendor@gmail.com")->first();

    $vendor = new Vendor();

    $vendor->banner = "uploads/vendor/123.png";
    $vendor->name = "ABC Shop";
    $vendor->email = "vendor@gmail.com";
    $vendor->phone = "1234567891";
    $vendor->address = "3/2, Ninh Kiều, Cần Thơ";
    $vendor->description = "Description";
    $vendor->user_id = $user->id;
    $vendor->status = 1;

    $vendor->save();
  }
}
