<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Usuario Demo 1',
            'email' => 'user1@test.com',
            'password' => Hash::make('test12345'),
            'is_instructor' => false,
        ]);

        $user2 = User::create([
            'name' => 'Usuario Demo 2',
            'email' => 'user2@test.com',
            'password' => Hash::make('test12345'),
            'is_instructor' => false,
        ]);

        $instructorDemo1 = User::create([
            'name' => 'Instructor Demo 1',
            'email' => 'instructor1@test.com',
            'password' => Hash::make('test12345'),
            'is_instructor' => true,
        ]);

        $instructorDemo2 = User::create([
            'name' => 'Instructor Demo 2',
            'email' => 'instructor2@test.com',
            'password' => Hash::make('test12345'),
            'is_instructor' => true,
        ]);

        $otherInstructors = [
            User::create([
                'name' => 'Juan Pérez',
                'email' => 'juan@test.com',
                'password' => Hash::make('test12345'),
                'is_instructor' => true,
            ]),
            User::create([
                'name' => 'María López',
                'email' => 'maria@test.com',
                'password' => Hash::make('test12345'),
                'is_instructor' => true,
            ]),
        ];

        $courses = [
            [
                'title' => 'Curso de Laravel',
                'description' => 'Aprende Laravel desde cero',
                'user_id' => $instructorDemo1->id,
            ],
            [
                'title' => 'Curso de Tailwind',
                'description' => 'Diseño frontend moderno con Tailwind',
                'user_id' => $instructorDemo1->id,
            ],
        ];

        $otherCourses = [
            [
                'title' => 'Curso de PHP Avanzado',
                'description' => 'Profundiza en PHP y buenas prácticas',
                'user_id' => $instructorDemo2->id,
            ],
            [
                'title' => 'Curso de Vue.js',
                'description' => 'Aprende Vue.js desde cero',
                'user_id' => $instructorDemo2->id,
            ],
        ];

        $createdCourses = [];

        $allCourses = array_merge($courses, $otherCourses);

        foreach ($allCourses as $courseData) {
            $course = Course::create($courseData);
            $createdCourses[] = $course; 

            Lesson::create([
                'title' => $course->title . ' - Lección 1',
                'course_id' => $course->id,
                'video_url' => 'https://sample-videos.com/video123.mp4',
            ]);

            Lesson::create([
                'title' => $course->title . ' - Lección 2',
                'course_id' => $course->id,
                'video_url' => 'https://sample-videos.com/video123.mp4',
            ]);
        }

        $user1->favorites()->attach($createdCourses[0]['id']);
        $user2->favorites()->attach($createdCourses[1]['id']);
    }
}
