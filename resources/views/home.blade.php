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
      <div class="flex-1 flex flex-col gap-6 sm:gap-8 items-center justify-center px-4 sm:px-6">
        <form method="POST" action="" class="grid gap-4 md:grid-cols-2 w-full max-w-4xl">
          @csrf
          <div class="space-y-2">
            <label class="text-sm sm:text-base lg:text-lg font-medium" for="mass_date">Data da missa</label>

            <div class="relative h-12 lg:h-14 bg-zinc-900 rounded-md ps-4 px-2 flex items-center justify-between">
              <input type="datetime-local" class="bg-transparent outline-none text-sm sm:text-base lg:text-lg h-full w-full text-gray-300" placeholder="Selecionar data...">

              {{-- <div>
                <svg class="w-5 h-5 text-gray-500 -mt-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div> --}}

              {{-- @if ($showCalendar)
              <x-date-picker :$currentYear :$currentMonth :$selectedDate :$days :$mass_date />
              @endif --}}
            </div>
          </div>

          <div class="space-y-2">
            <label class="text-sm sm:text-base lg:text-lg font-medium" for="contents">Intenções</label>

            <div class="flex gap-2 sm:gap-3 items-center">
              <input placeholder="Exemplo: sétimos dias, aniversários..." class="w-full text-sm sm:text-base lg:text-lg rounded-md outline-none bg-zinc-900 h-12 lg:h-14 px-3 py-2 text-gray-300" id="contents" type="text">

              <button class="bg-cyan-800 hover:bg-cyan-900 rounded-md h-12 lg:h-14 w-14 lg:w-16 flex items-center justify-center" type="button">
                <img src="{{ url('assets/plus.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
              </button>
            </div>
          </div>

          <button type="submit" class="md:col-span-2 flex items-center justify-center gap-2 text-sm sm:text-base lg:text-lg font-medium bg-cyan-800 hover:bg-cyan-900 h-12 lg:h-14 rounded-md">
              {{-- @if ($isLoading)
                <img src="{{ url('assets/loader.svg') }}" class="animate-spin h-5 w-5 lg:h-6 lg:w-6">
              @else
                Enviar <img src="{{ url('assets/send.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
              @endif --}}

              Enviar <img src="{{ url('assets/send.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
          </button>
        </form>

        {{-- <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 lg:gap-6 w-full max-w-4xl">
          @foreach ($contents as $intention)
          <div class="py-2 px-3 w-52 bg-zinc-900 rounded-md flex items-center justify-between text-gray-400">
            <span class="text-sm sm:text-base lg:text-lg">{{ $intention }}</span>

            <button class="bg-transparent" type="button">
              <img src="{{ url('assets/x.svg') }}" class="h-4 w-4 lg:h-5 lg:w-5">
            </button>
          </div>
          @endforeach
        </div> --}}
      </div>
    </div>
  </div>
@endsection