<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna adalah 'user'
        if ($request->user() && $request->user()->role === 'user') {
            // Jika ya, redirect atau abort
            return redirect('/unauthorized');
        }

        // Jika tidak, redirect atau abort
        return $next($request);
    }
}
