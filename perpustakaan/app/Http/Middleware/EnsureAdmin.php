<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Access denied.'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}

