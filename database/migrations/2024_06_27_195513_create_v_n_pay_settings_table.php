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
    Schema::create('v_n_pay_settings', function (Blueprint $table) {
      $table->id();
      $table->boolean("status");
      $table->integer("mode");
      $table->text("client_id");
      $table->text("secret_key");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('v_n_pay_settings');
  }
};
