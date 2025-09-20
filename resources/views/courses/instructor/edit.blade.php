@extends('layouts.instructor')

@section('instructor-content')
<h1 class="text-2xl font-bold mb-4">Editar Curso</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('courses.update', $course) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1">Título</label>
        <input type="text" name="title" value="{{ $course->title }}" class="border px-2 py-1 rounded w-full" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Descripción</label>
        <textarea name="description" class="border px-2 py-1 rounded w-full" rows="3" required>{{ $course->description }}</textarea>
    </div>

    <h2 class="text-xl font-semibold mb-2">Lecciones</h2>
    <div id="lessons-container" class="space-y-4 mb-4">
        @foreach($course->lessons as $index => $lesson)
            <div class="lesson border p-3 rounded relative">

                <input type="hidden" name="lessons[{{ $index }}][id]" value="{{ $lesson->id }}">

                <label class="block text-sm">Título</label>
                <input type="text" name="lessons[{{ $index }}][title]" value="{{ $lesson->title }}" class="border px-2 py-1 rounded w-full mb-2" required>

                <label class="block text-sm">Contenido</label>
                <textarea name="lessons[{{ $index }}][content]" class="border px-2 py-1 rounded w-full mb-2">{{ $lesson->content }}</textarea>

                <label class="block text-sm">URL del video</label>
                <input type="text" name="lessons[{{ $index }}][video_url]" value="{{ $lesson->video_url }}" class="border px-2 py-1 rounded w-full">

                <button type="button" class="remove-lesson mb-4 absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs">Eliminar</button>
            </div>
        @endforeach
    </div>

    <button type="button" id="add-lesson" class="bg-gray-500 text-white px-3 py-1 rounded mb-4">Añadir lección</button>

    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar curso</button>
</form>

<script>
let lessonIndex = {{ $course->lessons->count() }};

document.getElementById('add-lesson').addEventListener('click', function() {
    const container = document.getElementById('lessons-container');
    const div = document.createElement('div');
    div.classList.add('lesson', 'border', 'p-3', 'rounded', 'relative');
    div.innerHTML = `
        <label class="block text-sm">Título</label>
        <input type="text" name="lessons[${lessonIndex}][title]" placeholder="Título lección" class="border px-2 py-1 rounded w-full mb-2" required>

        <label class="block text-sm">Contenido</label>
        <textarea name="lessons[${lessonIndex}][content]" placeholder="Contenido lección" class="border px-2 py-1 rounded w-full mb-2"></textarea>

        <label class="block text-sm">URL del video</label>
        <input type="text" name="lessons[${lessonIndex}][video_url]" placeholder="URL video" class="border px-2 py-1 rounded w-full">

        <button type="button" class="remove-lesson absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs">Eliminar</button>
    `;
    container.appendChild(div);
    lessonIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-lesson')) {
        e.target.closest('.lesson').remove();
    }
});
</script>
@endsection
