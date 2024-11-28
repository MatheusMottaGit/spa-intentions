<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Entrar</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <livewire:styles />
  <livewire:scripts />
</head>
<body class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col gap-6 p-4 sm:p-6">
  <main class="flex-1 flex flex-col items-center justify-center gap-12 md:gap-16">
    <div class="w-full max-w-lg flex flex-col gap-5">
      <img src="{{ url('assets/logo.svg') }}" alt="Logo" class="h-20 sm:h-24 md:h-32 mx-auto">

      <div class="text-center space-y-3">
        <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl">Cadastre-se!</h1>
        <p class="opacity-60 text-sm sm:text-base md:text-lg font-medium">
          Serve apenas para podermos te identificar no sistema, bem como suas intenções!
        </p>
      </div>
    </div>

    @livewire('forms.login-form')
  </main>
</body>
</html>
