@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">{{ $course->title }}</h2>
    <p class="mb-2">{{ $course->description }}</p>
    <p class="mb-4 font-semibold">
        Rating promedio: {{ number_format($averageRating ?? 0, 1) }}/5
    </p>

    {{-- Botón de favoritos --}}
    <form action="{{ route('user.courses.favorite', $course) }}" method="POST" class="mb-6">
        @csrf
        <button type="submit"
                class="px-3 py-1 rounded {{ $isFavorite ? 'bg-yellow-400 text-black' : 'bg-gray-300 text-black' }}">
            {{ $isFavorite ? '★ Favorito' : '☆ Marcar favorito' }}
        </button>
    </form>

    {{-- Lecciones --}}
    <h3 class="text-xl font-bold mb-2">Lecciones</h3>
    <ul class="list-disc list-inside mb-6">
        @foreach($course->lessons as $lesson)
            <li class="mb-2">
                <h4 class="font-semibold">{{ $lesson->title }}</h4>
                <p>{{ $lesson->content }}</p>
                @if($lesson->video_url)
                    <div class="mt-2">
                        <video controls class="w-full rounded">
                            <source src="{{ $lesson->video_url }}" type="video/mp4">
                            Tu navegador no soporta el video.
                        </video>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>

    {{-- Reviews --}}
    <h3 class="text-xl font-bold mb-2">Reviews</h3>
    <div class="space-y-4 mb-6">
        @forelse($course->reviews as $review)
            <div class="border p-2 rounded">
                <p class="font-semibold">
                    {{ $review->user->name }}
                    <span class="text-yellow-400">
                        {{ str_repeat('★', $review->rating) }}
                    </span>
                </p>
                <p>{{ $review->comment }}</p>
            </div>
        @empty
            <p class="text-gray-500">Todavía no hay reviews para este curso.</p>
        @endforelse
    </div>

    {{-- Review del usuario logado --}}
    <h3 class="text-xl font-bold mt-4 mb-2">Tu review</h3>
    <form action="{{ route('user.courses.reviews.store', $course) }}" method="POST" class="space-y-3">
        @csrf
        <div>
            <label for="rating" class="block font-semibold">Rating (1-5)</label>
            <input type="number" name="rating" min="1" max="5"
                   value="{{ $userReview->rating ?? '' }}"
                   class="border p-1 rounded w-20">
        </div>

        <div>
            <label for="comment" class="block font-semibold">Comentario</label>
            <textarea name="comment" rows="3" class="border p-2 rounded w-full">{{ $userReview->comment ?? '' }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">
            Guardar review
        </button>
    </form>
</div>
@endsection
