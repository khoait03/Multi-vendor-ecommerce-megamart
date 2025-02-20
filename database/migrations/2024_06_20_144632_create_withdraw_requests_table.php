<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('withdraw_requests', function (Blueprint $table) {
      $table->id();
      $table->string("request_id");
      $table->foreignId("vendor_id")->constrained();
      $table->string("method");
      $table->double("total_amount");
      $table->double("withdraw_amount");
      $table->double("withdraw_charge");
      $table->text("account_info");
      $table->enum("status", ["pending", "paid", "deny"]);
      $table->string("bank_name");
      $table->string("account_name");
      $table->string("account_number");
      $table->text("image");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('withdraw_requests');
  }
};
