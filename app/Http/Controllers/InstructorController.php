<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->with('lessons')->get();
        return view('dashboard.instructor', compact('courses'));
    }

    public function create()
    {
        return view('courses.instructor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lessons' => 'nullable|array',
            'lessons.*.title' => 'required|string|max:255',
            'lessons.*.content' => 'nullable|string',
            'lessons.*.video_url' => 'nullable|string',
        ]);

        $course = auth()->user()->courses()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        foreach ($validated['lessons'] ?? [] as $lessonData) {
            $course->lessons()->create([
                'title' => $lessonData['title'],
                'content' => $lessonData['content'] ?? null,
                'video_url' => $lessonData['video_url'] ?? null,
            ]);
        }

        return redirect()->route('dashboard.instructor');
    }

    public function edit(Course $course)
    {
        return view('courses.instructor.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lessons.*.title' => 'required|string|max:255',
            'lessons.*.content' => 'nullable|string',
            'lessons.*.video_url' => 'nullable|string',
        ]);

        $course->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        $incomingLessonIds = collect($request->lessons ?? [])->pluck('id')->filter()->toArray();

        $course->lessons()->whereNotIn('id', $incomingLessonIds)->delete();

        foreach ($request->lessons ?? [] as $lessonData) {
            if (isset($lessonData['id'])) {
                $lesson = $course->lessons()->where('id', $lessonData['id'])->first();
                if ($lesson) {
                    $lesson->update([
                        'title' => $lessonData['title'],
                        'content' => $lessonData['content'] ?? null,
                        'video_url' => $lessonData['video_url'] ?? null,
                    ]);
                }
            } else {
                $course->lessons()->create([
                    'title' => $lessonData['title'],
                    'content' => $lessonData['content'] ?? null,
                    'video_url' => $lessonData['video_url'] ?? null,
                ]);
            }
        }

        return redirect()->route('instructor.courses.index')->with('success', 'Curso actualizado con éxito');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('dashboard.instructor');
    }

    public function showCourse(Course $course)
    {
        $course->load('lessons');
        return view('courses.instructor.show', compact('course'));
    }

}
