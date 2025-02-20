<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewLetterController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProductReviewController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserVendorRequestController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, "index"])->name("home");

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get("/admin", function () {
  if (!request()->user()) {
    return redirect()->route("admin.login");
  }
  return redirect()->route("admin.dashboard");
});

Route::get("flash-sale", [FlashSaleController::class, "index"])->name("flash-sale");

Route::get("products", [FrontendProductController::class, "productIndex"])->name("product.index");
Route::get("product-detail/{slug}", [FrontendProductController::class, "showProduct"])->name("product-detail");
Route::get("change-product-list-view", [FrontendProductController::class, "changeListView"])->name("change-product-list-view");
Route::get('product-suggestions', [FrontendProductController::class, 'getSuggestions'])->name('product.suggestions');

Route::group(["middleware" => ["auth", "verified", "role:user,vendor"], "prefix" => "user", "as" => "user."], function () {
  Route::get("dashboard", [UserDashboardController::class, "index"])->name("dashboard");
  Route::get("profile", [UserProfileController::class, "index"])->name("profile");
  Route::put("profile", [UserProfileController::class, "updateProfile"])->name("profile.update");
  Route::post("profile", [UserProfileController::class, "updatePassword"])->name("profile.update.password");
  Route::resource("address", UserAddressController::class);
  Route::get("checkout", [CheckoutController::class, "index"])->name("checkout");
  Route::post("checkout/address-create", [CheckoutController::class, "createAddress"])->name("checkout.address.create");
  Route::post("checkout/form-submit", [CheckoutController::class, "checkoutFormSubmit"])->name("checkout.form-submit");
  Route::get("payment", [PaymentController::class, "index"])->name("payment");
  Route::get("payment-success", [PaymentController::class, "paymentSuccess"])->name("payment.success");

  Route::get("paypal/payment", [PaymentController::class, "payWithPaypal"])->name("paypal.payment");
  Route::get("paypal/success", [PaymentController::class, "paypalSuccess"])->name("paypal.success");
  Route::get("paypal/cancel", [PaymentController::class, "paypalCancel"])->name("paypal.cancel");

  Route::post("stripe/payment", [PaymentController::class, "payWithStripe"])->name("stripe.payment");

  Route::get("cod/payment", [PaymentController::class, "payWithCOD"])->name("cod.payment");

  Route::post("vnpay_payment", [PaymentController::class, "payWithVNPay"])->name("vnpay.payment");
  Route::get("vnpay_success", [PaymentController::class, "vnpaySuccess"])->name("vnpay.success");

  Route::get("orders", [UserOrderController::class, "index"])->name("orders.index");
  Route::get("orders/show/{id}", [UserOrderController::class, "show"])->name("orders.show");
  Route::post("orders/cancel-order", [UserOrderController::class, "cancelOrder"])->name("orders.cancel");

  Route::post("review", [ReviewController::class, "createReview"])->name("review.create");
  Route::get("reviews", [ReviewController::class, "index"])->name("review.index");
  Route::delete("reviews/{id}", [ReviewController::class, "destroy"])->name("reviews.destroy");
  Route::get("reviews/{id}", [ReviewController::class, "edit"])->name("reviews.edit");
  Route::put("reviews/{id}", [ReviewController::class, "update"])->name("reviews.update");

  Route::get("vendor-request", [UserVendorRequestController::class, "index"])->name("vendor-request.index");
  Route::post("vendor-request", [UserVendorRequestController::class, "create"])->name("vendor-request.create");

  Route::get("messages", [UserMessageController::class, "index"])->name("messages.index");
  Route::post("send-message", [UserMessageController::class, "sendMessage"])->name("send-message");
  Route::get("get-messages", [UserMessageController::class, "getMessages"])->name("get-messages");
});

Route::post("add-to-cart", [CartController::class, "addToCart"])->name("add-to-cart");
Route::get("cart-details", [CartController::class, "cartDetails"])->name("cart-details");
Route::post("cart/update-quantity", [CartController::class, "updateProductQuantity"])->name("cart.update-quantity");
Route::get("clear-cart", [CartController::class, "clearCart"])->name("clear-cart");
Route::get("cart/remove-product/{rowId}", [CartController::class, "removeProduct"])->name("cart.remove-product");
Route::get("cart-count", [CartController::class, "getCartCount"])->name("cart-count");
Route::get("cart-products", [CartController::class, "getCartProducts"])->name("cart-products");
Route::post("cart/remove-sidebar-product", [CartController::class, "removeSidebarProduct"])->name("cart.remove-sidebar-product");
Route::get("cart/sidebar-product-total", [CartController::class, "cartTotal"])->name("cart.cart-total");
Route::post("apply-coupon", [CartController::class, "applyCoupon"])->name("apply-coupon");
Route::get("coupon-calculation", [CartController::class, "couponCalculation"])->name("coupon-calculation");

Route::get("wishlist", [WishlistController::class, "index"])->name("wishlist.index");
Route::post("wishlist/add-product", [WishlistController::class, "addToWishlist"])->name("wishlist.store");
Route::get("wishlist/remove-product/{id}", [WishlistController::class, "removeFromWishlist"])->name("wishlist.destroy");

Route::post("new-letter-request", [NewLetterController::class, "newLetterRequest"])->name("new-letter-request");
Route::get("new-letter-email-verify/{token}", [NewLetterController::class, "newLetterEmailVerify"])->name("new-letter-email-verify");

Route::get("vendors", [HomeController::class, "vendorPage"])->name("vendors.index");
Route::get("vendors-detail/{id}", [HomeController::class, "vendorDetail"])->name("vendor.show");

Route::get("about", [PageController::class, "about"])->name("about");
Route::get("contact", [PageController::class, "contact"])->name("contact");
Route::post("contact", [PageController::class, "handleContactForm"])->name("handle-contact-form");
Route::get("order-tracking", [OrderTrackingController::class, "index"])->name("order-tracking.index");
Route::get("blog-detail/{slug}", [PageController::class, "blogDetail"])->name("blog-detail");
Route::get("blog-list", [PageController::class, "blogList"])->name("blog-list");

Route::get("show-product-modal/{id}", [HomeController::class, "showProductModal"])->name("show-product-modal");

Route::get('/csrf-token', function () {
  return response()->json(['csrfToken' => csrf_token()]);
});

Route::get('/fetch-tinhthanh/{type}/{id}', function ($type, $id) {
  $response = Http::get("https://esgoo.net/api-tinhthanh/{$type}/{$id}.htm");
  return $response->body();
});

// Upload File Tinymce
Route::post('/upload', function (Request $request) {
  if ($request->hasFile("file")) {
    $image = $request->file('file');
    $ext = $image->getClientOriginalExtension();
    $imageName = "image_" . uniqid() . "." . $ext;
    $image->move(public_path("uploads/tinymce_images"), $imageName);

    $imageUrl = url("uploads/tinymce_images/" . $imageName);

    return response()->json(['location' => $imageUrl]);
  }
})->name("upload");

Route::fallback(function () {
  return redirect()->route("home");
});