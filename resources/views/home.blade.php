@extends('layouts.app')

@section('content')
  <div class="flex flex-col items-center justify-center gap-3">
    <h1 class="font-bold text-lg text-center md:text-2xl">Nos mande sua intenção!</h1>

    <p class="text-center opacity-50 text-xs md:text-base">Tudo será enviado ao coordenador da comunidade, e será lida no dia especificado!</p>
    
    <form class="space-y-3 mt-5 w-full">
      <div class="space-y-1">
        <label class="text-xs md:text-base" for="">Data da missa</label>
        <input placeholder="Selecione a data" class="bg-transparent bg-zinc-800 rounded text-xs md:text-base h-10 py-1.5 px-2 w-full text-zinc-500" type="date">
      </div>      
      <div class="space-y-1">
        <label class="text-xs md:text-base" for="">Intenções</label>
        
        <div class="flex items-center gap-1">
          <input placeholder="Exemplo: Sétimos dias, aniversários..." class="bg-transparent text-xs md:text-base bg-zinc-800 rounded h-10 py-1.5 px-2 w-full text-zinc-500" type="text">
          <button class="border border-zinc-600 w-10 p-1.5 rounded text-zinc-400" type="button">+</button>
        </div>
      </div>      
      <button class="bg-cyan-800 p-2 font-medium w-full rounded text-xs md:text-base flex items-center justify-center gap-1" type="submit">
        Enviar <img src="{{ url('assets/send.svg') }}">
      </button>
    </form>
  </div>
@endsection