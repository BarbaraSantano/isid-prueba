<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureInstructor
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_instructor) {
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
}
