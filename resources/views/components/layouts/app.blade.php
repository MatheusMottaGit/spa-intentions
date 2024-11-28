<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Intenções</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <livewire:styles />
  <livewire:scripts />
</head>
<body class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col p-6">
  <header class="w-full px-4 flex items-center justify-start gap-1">
    <img src="{{ url('assets/logo.svg') }}" alt="Logo" class="h-20">
    
    <div class="flex flex-col gap-1">
      <span class="text-xs font-bold md:text-lg">Matheus</span>
      <a href="#" class="text-red-500 underline font-medium text-xs md:text-lg">Sair</a>
    </div>
  </header>
  
  <main class="flex-1 flex items-center justify-center px-4">
    @yield('content')
  </main>
</body>
</html>
