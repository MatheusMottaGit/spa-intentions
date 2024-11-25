<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Intenções</title>
</head>
<body class="font-inter bg-zinc-900 text-white min-h-screen flex flex-col p-6">
  <header class="w-full px-4 flex items-center justify-start gap-1">
    <img src="{{ url('assets/spa-logo.png') }}" alt="Logo" class="h-34">
    
    <div class="flex flex-col gap-1">
      <span class="text-lg font-bold">Fulano</span>
      <a href="#" class="text-red-500 underline font-medium">Sair</a>
    </div>
  </header>

  <main class="flex-1 flex items-center justify-center px-4">
    @yield('content')
  </main>
</body>
</html>
