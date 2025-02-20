<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::where("email", "admin@gmail.com")->first();

    $vendor = new Vendor();

    $vendor->banner = "uploads/vendor/123.png";
    $vendor->name = "MegaMart";
    $vendor->email = "admin@gmail.com";
    $vendor->phone = "1234567890";
    $vendor->address = "209 Đ. 30 Tháng 4, Xuân Khánh, Ninh Kiều, Cần Thơ";
    $vendor->description = "Description";
    $vendor->user_id = $user->id;
    $vendor->save();
  }
}
