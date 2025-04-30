<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna tidak teridentifikasi
        if (!Auth::check()) {
            return redirect()->route('error404'); // Arahkan ke halaman 404
        }

        // Jika pengguna teridentifikasi tetapi role-nya bukan admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('error404'); // Arahkan ke halaman 404
        }

        return $next($request); // Jika pengguna adalah admin, biarkan akses
    }

}
