<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika tidak ada session 'admin_logged_in', lempar balik ke halaman login
        if (!$request->session()->has('admin_logged_in')) {
            return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses dashboard!');
        }

        return $next($request);
    }
}