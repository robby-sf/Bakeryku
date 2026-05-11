<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses halaman ini.');
        }

        if (Auth::guard('user')->user()->role !== 'user') {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('error', 'Akses ditolak. Hanya pengguna terdaftar yang diizinkan.');
        }

        return $next($request);
    }
}
