<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Jika tidak ada pengguna yang terotentikasi, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Dapatkan role pengguna yang terotentikasi
        $userRole = Auth::user()->status;

        // Periksa apakah role pengguna ada dalam daftar role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Jika tidak ada role yang cocok, arahkan kembali ke halaman utama
        return redirect('/');
    }
}
