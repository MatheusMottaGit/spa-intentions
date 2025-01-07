<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
  @livewireStyles
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>@yield('title')</title>
</head>
<body class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col gap-5">
  <header class="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between mx-auto">
    <div class="flex items-start p-3">
      <img src="{{ url('assets/logo.svg') }}" class="h-28">
      <div class="flex flex-col gap-1 items-start mt-3">
        <span class="font-bold">{{ auth()->user()->name }}</span>
        <form action="{{ route('auth.logOut') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="text-red-500 underline font-medium">
            Sair
          </button>
        </form>
      </div>
    </div>
  </header>

  <main class="flex-1 py-4">
    @yield('content')
  </main>

  @livewireScripts
</body>
</html>
