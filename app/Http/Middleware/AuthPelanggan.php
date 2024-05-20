<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthPelanggan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')->withErrors(['msg' => 'Harap login terlebih dahulu.']);
        }
        
        if ($request->user()->role === 'pelanggan') {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
