<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EsAnalista
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['analista', 'admin'])) {
            abort(403, 'Acceso denegado. Solo los analistas pueden acceder a este panel.');
        }

        return $next($request);
    }
}