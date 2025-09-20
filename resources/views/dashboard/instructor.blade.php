@extends('layouts.instructor')

@section('instructor-content')
<h1 class="text-2xl font-bold mb-4">Dashboard Instructor</h1>
<a href="{{ route('courses.create') }}" class="mb-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Crear curso</a>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($courses as $course)
        <div class="bg-white shadow p-4 rounded">
            <h3 class="font-bold text-lg">{{ $course->title }}</h3>
            <p class="text-sm">{{ $course->description }}</p>
            <div class="mt-2 flex space-x-2">
                <a href="{{ route('instructor.courses.show', $course) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Ver</a>
                <a href="{{ route('courses.edit', $course) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('¿Seguro?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
