<?php

use Illuminate\Support\Str;

// Set sidebar item active

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

function setActive(array $route)
{
  if (is_array($route)) {
    foreach ($route as $r) {
      if (request()->routeIs($r)) {
        return "active";
      }
    }
  }
}

function formatMoney($number)
{
  return number_format($number, 0, ',', '.') . ' ₫';
}

function checkDisCount($product)
{
  $currentDate = date("Y-m-d");

  if ($product->offer_end_date > $product->offer_start_date && $product->offer_start_date <= $currentDate && $currentDate <= $product->offer_end_date && $product->offer_price < $product->price) {
    return true;
  }

  return false;
}

function calculateDiscountPercent($product)
{
  if ($product->offer_price < $product->price) {
    return round((($product->price - $product->offer_price) / $product->price) * 100, 0);
  }
}

function productType($product)
{
  switch ($product->product_type) {
    case 'new_product':
      return "Mới";
      break;
    case 'featured_product':
      return "Nổi bật";
      break;
    case 'top_product':
      return "Phổ biến";
      break;
    default:
      return "Tốt nhất";
      break;
  }
}

function getCartTotal()
{
  $total = 0;

  foreach (Cart::content() as $item) {
    $total += ($item->price + $item->options->variants_total) * $item->qty;
  }

  return $total;
}

function getMainCartTotal()
{
  if (Session::has("coupon")) {
    $coupon = Session::get("coupon");

    $total = 0;

    foreach (Cart::content() as $item) {
      $total += ($item->price + $item->options->variants_total) * $item->qty;
    }

    if ($coupon["discount_type"] == "amount") {
      $total = $total - $coupon["discount"];
      $total = $total < 0 ? 0 : $total;
      return $total;
    } elseif ($coupon["discount_type"] == "percent") {
      $total = $total - ($total * $coupon["discount"] / 100);
      $total = $total < 0 ? 0 : $total;
      return $total;
    }
  } else {
    return getCartTotal();
  }
}

function getCartDiscount()
{
  if (Session::has("coupon")) {
    $coupon = Session::get("coupon");

    $total = 0;

    foreach (Cart::content() as $item) {
      $total += ($item->price + $item->options->variants_total) * $item->qty;
    }

    if ($coupon["discount_type"] == "amount") {
      return $coupon["discount"];
    } elseif ($coupon["discount_type"] == "percent") {
      $discount = $total * $coupon["discount"] / 100;
      return $discount;
    }
  } else {
    return 0;
  }
}

function getShippingFee()
{
  if (Session::has("shipping_method")) {
    return Session::get("shipping_method")["cost"];
  } else {
    return 0;
  }
}

function getPayableAmount()
{
  return getMainCartTotal() + getShippingFee();
}

function limitText($text, $limit = 50)
{
  return Str::limit($text, $limit);
}