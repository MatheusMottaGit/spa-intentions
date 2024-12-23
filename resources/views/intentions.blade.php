@extends('components.layouts.app')

@section('title', 'Intenções')

@section('content')
  <div class="flex flex-wrap gap-4 justify-start px-6">
    {{-- <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex">
          <a href="#" class="inline-flex items-center text-sm font-medium text-zinc-700 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-white">
            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            Criar
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-zinc-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="#" class="ms-1 text-sm font-medium text-zinc-700 hover:text-blue-600 md:ms-2 dark:text-zinc-400 dark:hover:text-white">Intenções</a>
          </div>
        </li>
      </ol>
    </nav> --}}

    @foreach ($intentions as $date => $intentionGroup)
      <div class="p-6 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(53.33%-1rem)] border border-zinc-200 space-y-4 rounded-lg shadow dark:bg-zinc-900 dark:border-zinc-700">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
          Acessar intenções do dia ({{ \Carbon\Carbon::parse($date)->format('d/m') }})
        </h2>
        
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
