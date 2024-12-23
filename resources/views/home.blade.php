@extends('components.layouts.app')

@section('title', 'Intenções | Criar')
    
@section('content')
  <div class="flex-1 flex flex-col gap-6 sm:gap-8 items-center justify-center px-4 sm:px-6">
    <div class="text-center space-y-4">
      <h1 class="text-2xl font-bold">Envie suas intenções!</h1>
      <p class="opacity-60 font-medium">
        Tudo será acessado pelo(a) animador(a) na comunidade, e será lida no seu dia especificado de forma anônima!
      </p>
    </div>

    <div class="w-full max-w-7xl">
      @livewire('forms.create-intention-form', ['churches' => $churches])
    </div>
    
    @if (Auth::user()->isAdmin())
      <div class="w-full flex flex-col gap-5">
        <div class="inline-flex items-center justify-center w-full">
          <hr class="w-full h-px bg-zinc-800 border-0">
          <span class="absolute px-3 font-medium -translate-x-1/2 bg-zinc-950 text-zinc-600 left-1/2">ou</span>
        </div>

        <a href="{{ url('/intencoes') }}" class="w-full flex items-center justify-center gap-2 px-4 font-medium text-zinc-300 bg-zinc-900 hover:bg-zinc-950 h-12 lg:h-14 rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notepad-text"><path d="M8 2v4"/><path d="M12 2v4"/><path d="M16 2v4"/><rect width="16" height="18" x="4" y="4" rx="2"/><path d="M8 10h6"/><path d="M8 14h8"/><path d="M8 18h5"/></svg>
          <span class="w-full">Veja todas as intenções</span>
          <svg class="w-5 h-5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
        </a> 
      </div>
    @endif
  </div>
@endsection