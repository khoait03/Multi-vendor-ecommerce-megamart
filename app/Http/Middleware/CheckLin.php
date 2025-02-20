<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckLin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy License Key và ngày hết hạn từ file .env
        $licenseKey = env('LICENSE_KEY');
        $expiryDate = env('LICENSE_EXPIRY_DATE');

        // Kiểm tra nếu License không tồn tại hoặc đã hết hạn
        if (!$licenseKey || Carbon::parse($expiryDate)->isBefore(Carbon::now())) {
            // Nếu License không hợp lệ hoặc đã hết hạn, chuyển hướng tới trang lỗi
            return redirect()->route('license');
        }

        // Tiến hành tiếp tục request nếu License hợp lệ
        return $next($request);
    }
}