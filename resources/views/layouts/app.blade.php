<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>Intenções</title>
</head>
<body class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col gap-8">
  <header class="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between px-5 py-2 gap-4 mx-auto">
    <div class="flex items-center gap-2">
      <img src="{{ url('assets/logo.svg') }}" alt="Logo" class="h-28">
      <div class="flex flex-col gap-1 items-start">
        <span class="font-bold">{{ auth()->user()->name }}</span>
        <form action="{{ route('auth.logOut') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="text-red-500 underline font-medium">
            Sair
          </button>
        </form>
      </div>
    </div>

    {{-- @if (Auth::user()->isAdmin() && !request()->is('intencoes'))
      <a href="{{ url('/intencoes') }}" class="flex items-center justify-center gap-1 bg-cyan-800 font-medium shadow-md py-2 px-3 rounded-md text-sm sm:text-base">
        <img src="{{ url('assets/notepad-text.svg') }}" class="h-5 sm:h-6">
        Ver todas as intenções
      </a>
    @endif --}}
  </header>

  <main class="flex-1 py-2">
    @yield('content')
  </main>
</body>
</html>
