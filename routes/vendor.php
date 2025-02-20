<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorMessageController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorWithdrawController;
use Illuminate\Support\Facades\Route;

Route::get("dashboard", [VendorController::class, "dashboard"])->name("dashboard");
Route::get("profile", [VendorProfileController::class, "index"])->name("profile");
Route::put("profile", [VendorProfileController::class, "updateProfile"])->name("profile.update");
Route::post("profile", [VendorProfileController::class, "updatePassword"])->name("profile.update.password");

Route::get("product/get-subcategories", [VendorProductController::class, "getSubCategories"])->name("products.get-subcategories");
Route::get("product/get-childcategories", [VendorProductController::class, "getChildCategories"])->name("products.get-childcategories");

Route::put("product/change-status", [VendorProductController::class, "changeStatus"])->name("products.change-status");
Route::put("product-variant/change-status", [VendorProductVariantController::class, "changeStatus"])->name("product-variant.change-status");
Route::put("product-variant-item/change-status", [VendorProductVariantItemController::class, "changeStatus"])->name("product-variant-item.change-status");

Route::resource("shop-profile", VendorShopProfileController::class);
Route::resource("products", VendorProductController::class);
Route::resource('product-image-gallery', VendorProductImageGalleryController::class);
Route::resource('product-variant', VendorProductVariantController::class);

Route::get("product-variant-item", [VendorProductVariantItemController::class, "index"])->name("product-variant-item.index");
Route::get("product-variant-item/create", [VendorProductVariantItemController::class, "create"])->name("product-variant-item.create");
Route::post("product-variant-item", [VendorProductVariantItemController::class, "store"])->name("product-variant-item.store");
Route::get("product-variant-item/{variantItemId}/edit", [VendorProductVariantItemController::class, "edit"])->name("product-variant-item.edit");
Route::put("product-variant-item/{variantItemId}/update", [VendorProductVariantItemController::class, "update"])->name("product-variant-item.update");
Route::delete("product-variant-item/{variantItemId}", [VendorProductVariantItemController::class, "destroy"])->name("product-variant-item.destroy");

Route::get("orders", [VendorOrderController::class, "index"])->name("orders.index");
Route::get("orders/show/{id}", [VendorOrderController::class, "show"])->name("orders.show");
Route::put("order/change-status/{id}", [VendorOrderController::class, "changeStatus"])->name("orders.change-status");

Route::get("withdraw-detail/{id}", [VendorWithdrawController::class, "showRequest"])->name("withdraw.detail");
Route::post("withdraw-info", [VendorWithdrawController::class, "addWithdrawInfo"])->name("withdraw.add-info");
Route::resource("withdraw", VendorWithdrawController::class);

Route::get("reviews", [VendorProductReviewController::class, "index"])->name("reviews.index");

Route::get("messages", [VendorMessageController::class, "index"])->name("messages.index");
Route::post("send-message", [VendorMessageController::class, "sendMessage"])->name("send-message");
Route::get("get-messages", [VendorMessageController::class, "getMessages"])->name("get-messages");
