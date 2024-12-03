<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>Entrar</title>
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

    <div class="w-full max-w-xl px-4 sm:px-6 md:px-0">
      <form method="POST" action="{{ route('auth.sign') }}" class="grid gap-4 md:grid-cols-2">
        @csrf
        <div class="space-y-2">
          <label class="text-sm sm:text-base md:text-lg font-medium" for="name">Nome</label>
          
          <input placeholder="Nome completo..." class="text-sm sm:text-base md:text-lg border-none w-full rounded-md bg-zinc-900 h-12 px-3 py-2 text-zinc-300" name="name" id="name" type="text">
        </div>

        <div class="space-y-2">
          <label class="text-sm sm:text-base md:text-lg font-medium" for="pin">
            PIN <span class="opacity-60 text-xs sm:text-sm">(Até 5 caracteres)</span>
          </label>

          <input placeholder="Exemplo: 12345" class="text-sm sm:text-base md:text-lg border-none w-full rounded-md bg-zinc-900 h-12 px-3 py-2 text-zinc-300" name="pin" id="pin" type="text">
        </div>

        <button type="submit" class="md:col-span-2 flex items-center justify-center gap-2 text-sm sm:text-base md:text-lg font-medium bg-cyan-800 hover:bg-cyan-900 h-12 rounded-md">
          {{-- @if ($isLoading)
            <img src="{{ url('assets/loader.svg') }}" class="animate-spin h-5 w-5">
          @else
            Entrar <img src="{{ url('assets/arrow-right-to-line.svg') }}" class="h-5 w-5">
          @endif --}}

          Entrar <img src="{{ url('assets/arrow-right-to-line.svg') }}" class="h-5 w-5">
        </button>
      </form>
    </div>
  </main>
</body>
</html>