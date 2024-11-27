@extends('components.layouts.app')

@section('content')
  <div class="flex-1 flex flex-col gap-5 items-center justify-center">
    <div class="text-center space-y-3">
      <h1 class="font-bold text-2xl">Envie suas intenções!</h1>
      <p class="opacity-60 font-medium">
        Tudo poderá ser acessado pelo coordenador da comunidade, e será lida no dia especificado!
      </p>
    </div>

    @livewire('forms.create-intention-form')
  </div>
@endsection