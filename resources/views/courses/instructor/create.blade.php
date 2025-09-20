@extends('layouts.instructor')

@section('instructor-content')
<h1 class="text-2xl font-bold mb-4">Crear Curso</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Título</label>
        <input type="text" name="title" class="border px-2 py-1 rounded w-full" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Descripción</label>
        <textarea name="description" class="border px-2 py-1 rounded w-full" rows="3" required></textarea>
    </div>

    <h2 class="text-xl font-semibold mb-2">Lecciones</h2>
    <div id="lessons-container" class="space-y-4 mb-4">
        <div class="lesson border p-3 rounded">
            <input type="text" name="lessons[0][title]" placeholder="Título lección" class="border px-2 py-1 rounded w-full mb-2">
            <textarea name="lessons[0][content]" placeholder="Contenido lección" class="border px-2 py-1 rounded w-full mb-2"></textarea>
            <input type="text" name="lessons[0][video_url]" placeholder="URL video" class="border px-2 py-1 rounded w-full">
        </div>
    </div>
    <button type="button" id="add-lesson" class="bg-gray-500 text-white px-3 py-1 rounded mb-4">Añadir lección</button>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Crear curso</button>
</form>

<script>
let lessonIndex = 1;
document.getElementById('add-lesson').addEventListener('click', function() {
    const container = document.getElementById('lessons-container');
    const div = document.createElement('div');
    div.classList.add('lesson', 'border', 'p-3', 'rounded');
    div.innerHTML = `
        <input type="text" name="lessons[${lessonIndex}][title]" placeholder="Título lección" class="border px-2 py-1 rounded w-full mb-2">
        <textarea name="lessons[${lessonIndex}][content]" placeholder="Contenido lección" class="border px-2 py-1 rounded w-full mb-2"></textarea>
        <input type="text" name="lessons[${lessonIndex}][video_url]" placeholder="URL video" class="border px-2 py-1 rounded w-full">
    `;
    container.appendChild(div);
    lessonIndex++;
});
</script>
@endsection
