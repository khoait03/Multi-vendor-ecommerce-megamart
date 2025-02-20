<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();

    $request->session()->regenerate();

    Cart::restore($request->user()->id);
    Cart::store(Auth::user()->id);

    // if ($request->user()->role === "admin") {
    //   return redirect()->intended("admin/dashboard");
    // } else if ($request->user()->role === "vendor") {
    //   return redirect()->intended("vendor/dashboard");
    // }

    if ($request->user()->status == "inactive") {
      Auth::guard('web')->logout();

      $request->session()->regenerateToken();

      Toastr::error("Tài khoản của bạn đã bị khoá. Vui lòng liên hệ quản trị viên qua email hoặc số điện thoại để biết thêm chi tiết!", "Lỗi");

      return redirect()->back();
    }

    if ($request->user()->role === "user") {
      return redirect()->intended("/");
    } elseif ($request->user()->role === "vendor") {
      return redirect()->intended("vendor/dashboard");
    }

    // return redirect()->intended(RouteServiceProvider::HOME);
    return redirect()->intended("admin/dashboard");
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $isAdmin = $request->user()->role === "admin";

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return $isAdmin ? redirect('/admin') : redirect('/');
  }
}