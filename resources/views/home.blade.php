@extends('components.layouts.app')

@section('content')
  <div class="flex-1 flex flex-col gap-6 sm:gap-8 items-center justify-center px-4 sm:px-6">
    <div class="text-center space-y-4">
      <h1 class="text-lg sm:text-xl md:text-2xl font-bold">Envie suas intenções!</h1>
      <p class="text-sm sm:text-base md:text-lg opacity-60 font-medium">
        Tudo poderá ser acessado pelo coordenador da comunidade, e será lida no dia especificado!
      </p>
    </div>

    <div class="w-full max-w-7xl">
      @livewire('forms.create-intention-form')
    </div>
  </div>
@endsection
