<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function user()
    {
        $user = auth()->user();

        $courses = Course::with('instructor')
            ->withAvg('reviews', 'rating')
            ->paginate(12);

        $favorites = $user->favorites()->pluck('course_id')->toArray();

        $instructors = User::where('is_instructor', true)
            ->select('id', 'name')
            ->paginate(20);

        return view('dashboard.user', compact(
            'user',
            'courses',
            'favorites',
            'instructors'
        ));
    }

    public function instructor()
    {
        $user = auth()->user();

        $courses = $user->courses()
            ->withAvg('reviews', 'rating')
            ->paginate(12);

        return view('dashboard.instructor', compact(
            'user',
            'courses'
        ));
    }
}

