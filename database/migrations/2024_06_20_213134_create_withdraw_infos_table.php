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
    Schema::create('withdraw_infos', function (Blueprint $table) {
      $table->id();
      $table->integer("vendor_id");
      $table->string("bank_name");
      $table->string("account_name");
      $table->string("account_number");
      $table->text("note")->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('withdraw_infos');
  }
};
