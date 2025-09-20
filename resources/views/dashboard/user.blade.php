@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tus cursos</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($courses as $course)
            <div class="bg-white shadow p-4 rounded relative">
                @if(in_array($course->id, $favorites ?? []))
                    <span class="absolute top-2 right-2 text-yellow-400 text-xl">★</span>
                @endif
                <h3 class="font-bold text-lg">{{ $course->title }}</h3>
                <p class="text-sm">{{ $course->description }}</p>
                <p class="mt-2 font-semibold">Rating: {{ number_format($course->reviews_avg_rating ?? 0, 1) }}/5</p>

                <a href="{{ route('user.courses.show', $course) }}"
                   class="mt-2 inline-block bg-blue-500 text-white px-3 py-1 rounded">
                    Ver curso
                </a>
            </div>
        @endforeach
    </div>

    <h2 class="text-xl mt-2 font-bold mb-4">Nuestros Instructores</h2>
    <ul class="divide-y divide-gray-200 bg-white shadow rounded">
        @foreach($instructors as $instructor)
            <li class="flex items-center p-4">
                {{-- Avatar con inicial --}}
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-lg font-bold text-blue-600 mr-4">
                    {{ strtoupper(substr($instructor->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold">{{ $instructor->name }}</p>
                    <p class="text-sm text-gray-500">{{ $instructor->email }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
