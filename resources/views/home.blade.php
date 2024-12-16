@extends('layouts.app')

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
  </div>
@endsection