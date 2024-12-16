<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>Entrar</title>
</head>

<body class="font-inter bg-zinc-950 text-white min-h-screen flex flex-col gap-6 p-4 sm:p-6">
  <main class="flex-1 flex flex-col items-center justify-center gap-12 md:gap-16">
    <div class="w-full max-w-lg flex flex-col gap-5">
      <img src="{{ url('assets/logo.svg') }}" alt="Logo" class="mx-auto size-44">

      <div class="text-center space-y-3">
        <h1 class="font-bold text-3xl">Bem-vindo!</h1>
        <p class="opacity-60 font-medium">
          Siga as instruções do formulário para entrar e registrar as suas intenções para a missa desejada! 
        </p>
      </div>
    </div>

    <div class="max-w-6xl">
      <form method="POST" action="{{ route('auth.login') }}" class="grid gap-4 md:grid-cols-2">
        @csrf
        <div class="space-y-2">
          <label class="font-medium" for="name">Nome</label>
          <input 
            placeholder="Digite seu nome" 
            class="border-none w-full rounded-md bg-zinc-900 h-12 px-3 py-2 text-zinc-300 focus:outline-none focus:ring-2 focus:ring-cyan-700" 
            name="name" 
            id="name" 
            type="text">
          @error('name')
            <span class="text-red-500 font-medium">{{ $message }}</span>
          @enderror
        </div>

        <div class="space-y-2">
          <label class="font-medium" for="pin">
            PIN <span class="opacity-60">(Número de 5 caracteres)</span>
          </label>
          <input 
            placeholder="Exemplo: 12345" 
            class="border-none w-full rounded-md bg-zinc-900 h-12 px-3 py-2 text-zinc-300 focus:outline-none focus:ring-2 focus:ring-cyan-700" 
            name="pin" 
            id="pin" 
            type="text">
          @error('pin')
            <span class="text-red-500 font-medium">{{ $message }}</span>
          @enderror
        </div>

        <button 
          type="submit" 
          class="md:col-span-2 flex items-center justify-center gap-2 font-medium bg-cyan-800 hover:bg-cyan-900 h-12 rounded-md focus:ring-2 focus:ring-cyan-700 focus:ring-offset-2">
          Entrar 
          <img src="{{ url('assets/arrow-right-to-line.svg') }}" class="h-5 w-5">
        </button>
      </form>
    </div>
  </main>
</body>
