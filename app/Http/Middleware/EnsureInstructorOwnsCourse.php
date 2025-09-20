<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureInstructorOwnsCourse
{
    public function handle(Request $request, Closure $next)
    {
        $course = $request->route('course');

        if (!$course || $course->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
}
