@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow p-6 rounded-lg">
    <h1 class="text-2xl font-bold mb-2">{{ $course->title }}</h1>
    <p class="text-gray-700 mb-4">{{ $course->description }}</p>

    {{-- Rating promedio --}}
    <div class="mb-6">
        <p class="text-lg font-semibold">
            ⭐ Promedio: {{ number_format($course->reviews()->avg('rating') ?? 0, 1) }}/5
        </p>
        <p class="text-sm text-gray-500">Total de valoraciones: {{ $course->reviews()->count() }}</p>
    </div>

    {{-- Lecciones --}}
    <h2 class="text-xl font-bold mb-2">Lecciones</h2>
    <ul class="list-disc pl-5 mb-6">
        @foreach($course->lessons as $lesson)
            <li class="mb-2">
                <strong>{{ $lesson->title }}</strong><br>
                <span class="text-sm text-gray-600">{{ $lesson->content }}</span><br>
                <a href="{{ $lesson->video_url }}" target="_blank" class="text-blue-500 text-sm">Ver video</a>
            </li>
        @endforeach
    </ul>

    {{-- Reviews de los usuarios --}}
    <h2 class="text-xl font-bold mb-2">Reseñas de estudiantes</h2>
    <div class="space-y-4">
        @forelse($course->reviews as $review)
            <div class="border p-3 rounded">
                <p class="text-yellow-500">⭐ {{ $review->rating }}/5</p>
                <p class="text-gray-800">{{ $review->comment }}</p>
                <p class="text-sm text-gray-500">— {{ $review->user->name }}</p>
            </div>
        @empty
            <p class="text-gray-500">Este curso todavía no tiene reseñas.</p>
        @endforelse
    </div>

    {{-- Botón volver --}}
    <div class="mt-6">
        <a href="{{ route('dashboard.instructor') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Volver a mis cursos
        </a>
    </div>
</div>
@endsection
