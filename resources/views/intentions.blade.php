@extends('layouts.app')

@section('title', 'Intenções')

@section('content')
  <div class="flex flex-wrap gap-4 mt-6 justify-center px-6">
    @foreach ($intentions as $date => $intentionGroup)
      <div class="p-6 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(53.33%-1rem)] border border-zinc-200 space-y-4 rounded-lg shadow dark:bg-zinc-900 dark:border-zinc-700">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
          Acessar intenções do dia ({{ \Carbon\Carbon::parse($date)->format('d/m') }})
        </h2>

        <p class="mb-3 font-normal text-zinc-700 dark:text-zinc-400">
          {{ count($intentionGroup) > 1 ? count($intentionGroup) . ' intenções registradas' : count($intentionGroup) . ' intenção registrada' }}
        </p>
        
        <a href="{{ route('intentions.details', ['date' => $date]) }}" class="inline-flex items-center w-full justify-center sm:w-auto px-3 py-2 font-medium text-center text-white bg-cyan-800 rounded-lg hover:bg-cyan-900 focus:ring-4 focus:outline-none">
          Acessar
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
        </a>
      </div>
    @endforeach
  </div>
@endsection
