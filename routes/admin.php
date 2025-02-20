<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminMessageController;
use App\Http\Controllers\Backend\AdminProductReviewController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CODSettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorConditionController;
use App\Http\Controllers\Backend\VendorListController;
use App\Http\Controllers\Backend\VendorRequestController;
use App\Http\Controllers\Backend\VNPaySettingController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Backend\WithdrawMethodController;
use App\Models\ShippingRule;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get("dashboard", [AdminController::class, "dashboard"])->name("dashboard");

// Profile
Route::get("profile", [ProfileController::class, "index"])->name("profile");
Route::post("profile/update", [ProfileController::class, "updateProfile"])->name("profile.update");
Route::post("profile/update/password", [ProfileController::class, "updatePassword"])->name("password.update");

// Slider
Route::put("slider/change-status", [SliderController::class, "changeStatus"])->name("slider.change-status");
Route::resource('slider', SliderController::class);

// Category
Route::put("category/change-status", [CategoryController::class, "changeStatus"])->name("category.change-status");
Route::resource('category', CategoryController::class);

// SubCategory
Route::put("sub-category/change-status", [SubCategoryController::class, "changeStatus"])->name("sub-category.change-status");
Route::resource('sub-category', SubCategoryController::class);

// ChildCategory
Route::put("child-category/change-status", [ChildCategoryController::class, "changeStatus"])->name("child-category.change-status");
Route::get("get-subcategories", [ChildCategoryController::class, "getSubCategories"])->name("get-subcategories");
Route::resource('child-category', ChildCategoryController::class);

// Brand
Route::put("brand/change-status", [BrandController::class, "changeStatus"])->name("brand.change-status");
Route::resource('brand', BrandController::class);

// Vendor
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Product
Route::put("product/change-status", [ProductController::class, "changeStatus"])->name("products.change-status");
Route::put("product-variant/change-status", [ProductVariantController::class, "changeStatus"])->name("product-variant.change-status");
Route::put("product-variant-item/change-status", [ProductVariantItemController::class, "changeStatus"])->name("product-variant-item.change-status");

Route::get("product/get-subcategories", [ProductController::class, "getSubCategories"])->name("products.get-subcategories");
Route::get("product/get-childcategories", [ProductController::class, "getChildCategories"])->name("products.get-childcategories");
Route::resource('products', ProductController::class);
Route::resource('product-image-gallery', ProductImageGalleryController::class);
Route::resource('product-variant', ProductVariantController::class);

Route::get("product-variant-item", [ProductVariantItemController::class, "index"])->name("product-variant-item.index");
Route::get("product-variant-item/create", [ProductVariantItemController::class, "create"])->name("product-variant-item.create");
Route::post("product-variant-item", [ProductVariantItemController::class, "store"])->name("product-variant-item.store");
Route::get("product-variant-item/{variantItemId}/edit", [ProductVariantItemController::class, "edit"])->name("product-variant-item.edit");
Route::put("product-variant-item/{variantItemId}/update", [ProductVariantItemController::class, "update"])->name("product-variant-item.update");
Route::delete("product-variant-item/{variantItemId}", [ProductVariantItemController::class, "destroy"])->name("product-variant-item.destroy");

Route::get("seller-products", [SellerProductController::class, "index"])->name("seller-products.index");
Route::get("seller-pending-products", [SellerProductController::class, "pendingProducts"])->name("seller-pending-products.index");
Route::put("change-approve-status", [SellerProductController::class, "changeApproveStatus"])->name("change-approve-status");

// Flash sale
Route::get("flash-sale", [FlashSaleController::class, "index"])->name("flash-sale.index");
Route::put("flash-sale", [FlashSaleController::class, "update"])->name("flash-sale.update");
Route::post("flash-sale/add-product", [FlashSaleController::class, "addProduct"])->name("flash-sale.add-product");
Route::put("flash-sale/show-at-home/change-status", [FlashSaleController::class, "changeShowAtHomeStatus"])->name("flash-sale.show-at-home.change-status");
Route::put("flash-sale/change-status", [FlashSaleController::class, "changeStatus"])->name("flash-sale.change-status");
Route::delete("flash-sale/{id}", [FlashSaleController::class, "destroy"])->name("flash-sale.destroy");

// Settings
Route::get("settings", [SettingController::class, "index"])->name("setting.index");
Route::put("general-setting-update", [SettingController::class, "generalSettingUpdate"])->name("general-setting-update");
Route::put("email-setting-update", [SettingController::class, "emailSettingUpdate"])->name("email-setting-update");

// Homepage Settings
Route::get("home-page-setting", [HomePageSettingController::class, "index"])->name("home-page-setting.index");
Route::put("popular-category-section", [HomePageSettingController::class, "updatePopularCategorySection"])->name("popular-category-section");
Route::put("product-slider-section-one", [HomePageSettingController::class, "updateProductSliderSectionOne"])->name("product-slider-section-one");
Route::put("product-slider-section-two", [HomePageSettingController::class, "updateProductSliderSectionTwo"])->name("product-slider-section-two");
Route::put("weekly-best-rated", [HomePageSettingController::class, "weeklyBestRated"])->name("weekly-best-rated");
Route::put("weekly-best-sell", [HomePageSettingController::class, "weeklyBestSell"])->name("weekly-best-sell");

// Coupon
Route::put("coupons/change-status", [CouponController::class, "changeStatus"])->name("coupons.change-status");
Route::resource("coupons", CouponController::class);

// Shipping Rule
Route::put("shipping-rule/change-status", [ShippingRuleController::class, "changeStatus"])->name("shipping-rule.change-status");
Route::resource("shipping-rule", ShippingRuleController::class);

// Payment Setting
Route::get("payment-settings", [PaymentSettingController::class, "index"])->name("payment-settings.index");
Route::resource("paypal-setting", PaypalSettingController::class);
Route::put("stripe-setting/{id}", [StripeSettingController::class, "update"])->name("stripe-setting.update");
Route::put("cod-setting/{id}", [CODSettingController::class, "update"])->name("cod-setting.update");
Route::put("vnpay-setting/{id}", [VNPaySettingController::class, "update"])->name("vnpay-setting.update");

// Orders
Route::put("order-status", [OrderController::class, "changeOrderStatus"])->name("order.status");
Route::put("payment-status", [OrderController::class, "changePaymentStatus"])->name("order.payment-status");

Route::get("order-filter", [OrderController::class, "orderFilter"])->name("order.filter");
Route::get("cancel-orders", [OrderController::class, "cancelOrders"])->name("order.cancel-orders");
Route::get("cancel-orders/detail/{id}", [OrderController::class, "cancelOrdersShow"])->name("order.cancel-orders-show");
Route::post("cancel-orders/change-refund-status", [OrderController::class, "changeRefundStatus"])->name("order.cancel-orders-change-refund-status");
Route::resource("order", OrderController::class);

Route::get("transactions", [TransactionController::class, "index"])->name("transactions.index");

// Footer
Route::resource("footer-info", FooterInfoController::class);
Route::put("footer-grid-two/change-status", [FooterGridTwoController::class, "changeStatus"])->name("footer-grid-two.change-status");
Route::resource("footer-grid-two", FooterGridTwoController::class);

// Subscriber
Route::get("subscribers", [SubscriberController::class, "index"])->name("subscribers.index");
Route::post("subscribers-send-mail", [SubscriberController::class, "sendMail"])->name("subscribers-send-mail");

// Advertisement
Route::get("advertisement", [AdvertisementController::class, "index"])->name("advertisement.index");
Route::put("advertisement/home-page-banner-one", [AdvertisementController::class, "homePageBannerOne"])->name("advertisement.home-page-banner-one");
Route::put("advertisement/home-page-banner-two", [AdvertisementController::class, "homePageBannerTwo"])->name("advertisement.home-page-banner-two");
Route::put("advertisement/home-page-banner-three", [AdvertisementController::class, "homePageBannerThree"])->name("advertisement.home-page-banner-three");
Route::put("advertisement/home-page-banner-four", [AdvertisementController::class, "homePageBannerFour"])->name("advertisement.home-page-banner-four");

// Review
Route::get("reviews", [AdminProductReviewController::class, "index"])->name("reviews.index");
Route::put("reviews/change-status", [AdminProductReviewController::class, "changeStatus"])->name("reviews.change-status");
Route::delete("reviews/{id}", [AdminProductReviewController::class, "destroy"])->name("reviews.destroy");

// Vendor request
Route::get("vendor-requests", [VendorRequestController::class, "index"])->name("vendor-requests.index");
Route::get("vendor-requests-detail/{id}", [VendorRequestController::class, "show"])->name("vendor-requests.show");
Route::put("vendor-requests-change-status/{id}", [VendorRequestController::class, "changeStatus"])->name("vendor-requests.change-status");

// Customer List
Route::get("customers", [CustomerListController::class, "index"])->name("customers.index");
Route::put("customers/change-status", [CustomerListController::class, "changeStatus"])->name("customers.change-status");

// Vendor List
Route::get("vendor-list", [VendorListController::class, "index"])->name("vendor-list.index");
Route::put("vendor-list/change-status", [VendorListController::class, "changeStatus"])->name("vendor-list.change-status");

// Vendor Condition
Route::get("vendor-condition", [VendorConditionController::class, "index"])->name("vendor-condition.index");
Route::post("vendor-condition", [VendorConditionController::class, "update"])->name("vendor-condition.update");

// About
Route::get("about", [AboutController::class, "index"])->name("about.index");
Route::post("about", [AboutController::class, "update"])->name("about.update");

// Manage User
Route::get("manage-user", [ManageUserController::class, "index"])->name("manage-user.index");
Route::post("manage-user", [ManageUserController::class, "create"])->name("manage-user.create");
Route::put("manage-user/change-status", [ManageUserController::class, "changeStatus"])->name("manage-user.change-status");

// Blog
Route::put("blog/change-status", [BlogController::class, "changeStatus"])->name("blog.change-status");
Route::resource("blog", BlogController::class);

// Withdraw
Route::resource("withdraw-method", WithdrawMethodController::class);
Route::get("withdraw-list", [WithdrawController::class, "index"])->name("withdraw-list.index");
Route::get("withdraw/{id}", [WithdrawController::class, "show"])->name("withdraw.show");
Route::put("withdraw/{id}", [WithdrawController::class, "update"])->name("withdraw.update");

// Message
Route::get("messages", [AdminMessageController::class, "index"])->name("messages.index");
Route::post("send-message", [AdminMessageController::class, "sendMessage"])->name("send-message");
Route::get("get-messages", [AdminMessageController::class, "getMessages"])->name("get-messages");

// Report
Route::get("reports", [ReportController::class, "index"])->name("reports.index");

Route::fallback(function () {
  return redirect()->route("admin.dashboard");
});
