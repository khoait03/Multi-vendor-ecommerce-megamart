<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VNPaySetting extends Model
{
  use HasFactory;

  protected $fillable = ["status", "mode", "client_id", "secret_key"];
}
