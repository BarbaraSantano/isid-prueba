<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showCourse(Course $course)
    {
        $course->load('lessons');
        $user = auth()->user();
        $isFavorite = $user->favorites()->where('course_id', $course->id)->exists();
        $averageRating = $course->reviews()->avg('rating');

        return view('courses.user.show', compact('course', 'isFavorite', 'averageRating'));
    }

    public function toggleFavorite(Course $course)
    {
        $user = auth()->user();
        $user->favorites()->toggle($course->id);
        return back();
    }

    public function storeReview(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $course->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back();
    }
}
