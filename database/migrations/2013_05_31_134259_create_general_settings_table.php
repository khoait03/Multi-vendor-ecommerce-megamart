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
    // Schema::create('general_settings', function (Blueprint $table) {
    //   $table->id();
    //   $table->string('site_name')->nullable();
    //   $table->string('contact_email')->nullable();
    //   $table->string('contact_phone')->nullable();
    //   $table->string('contact_address')->nullable();
    //   $table->text('map')->nullable();
    //   $table->timestamps();
    // });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    // Schema::dropIfExists('general_settings');
  }
};