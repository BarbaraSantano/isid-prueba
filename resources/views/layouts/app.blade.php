<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Plataforma')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="font-bold text-xl">Mi Plataforma</a>
        <div class="space-x-4">
            @auth
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500">Salir</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Registro</a>
            @endauth
        </div>
    </nav>
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
