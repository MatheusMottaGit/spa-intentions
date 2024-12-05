<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>Intenções</title>
</head>
<body class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col p-3">
  <header class="w-full flex items-center justify-between px-7">
    <div class="flex items-center gap-2">
      <img src="{{ url('assets/logo.svg') }}" alt="Logo" class="h-28">
    
      <div class="flex flex-col gap-1 items-start">
        <span class="text-xs font-bold md:text-lg">{{ auth()->user()->name }}</span>
        
        <form action="{{ route('auth.logOut') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="text-red-500 underline font-medium text-xs md:text-lg">
            Sair
          </button>
        </form>
      </div>
    </div>

    @if (Auth::user()->isAdmin() && !request()->is('intencoes'))
      <a href="{{ url('/intencoes') }}" class="flex items-center justify-center gap-2 bg-cyan-800 py-2 px-3 shadow-md rounded-md">
        Ver intenções <img src="{{ url('assets/notepad-text.svg') }}">
      </a>
    @endif
  </header>

  <main class="flex-1 flex items-center justify-center px-4">
    @yield('content')
  </main>
</body>
</html>
