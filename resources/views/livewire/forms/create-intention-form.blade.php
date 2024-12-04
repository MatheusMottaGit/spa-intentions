<div class="flex-1 flex flex-col gap-6 sm:gap-8 items-center justify-center px-4 sm:px-6">
  <form method="POST" action="{{ route('intention.create', ['user_id' => auth()->user()->id]) }}" class="grid gap-4 md:grid-cols-2 w-full max-w-4xl">
    @csrf
    <div class="space-y-2">
      <label class="text-sm sm:text-base lg:text-lg font-medium" for="mass_date">Data da missa</label>

      <div class="relative h-12 lg:h-14 rounded-md">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-zinc-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>

        <input name="mass_date" id ="datepicker-format" datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="top left" type="text" class="border-none text-zinc-400 bg-zinc-900 rounded-md h-full w-full ps-10 p-2.5" placeholder="Selecionar data...">
      </div>
    </div>

    <div class="space-y-2">
      <label for="time" class="text-sm sm:text-base lg:text-lg font-medium">Horário</label>
      
      <div class="relative h-12 lg:h-14 rounded-md">
        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
          </svg>
        </div>

        <input name="mass_hour" type="time" id="time" class="border-none text-zinc-400 bg-zinc-900 rounded-md h-full w-full px-3 py-2" min="07:00" max="19:00" required />
      </div>
    </div>

    <div class="space-y-2 col-span-2">
      <label class="text-sm sm:text-base lg:text-lg font-medium" for="contents">Intenções</label>

      <div class="flex gap-2 sm:gap-3 items-center">
        <input placeholder="Exemplo: sétimos dias, aniversários..." class="w-full text-sm sm:text-base lg:text-lg rounded-md outline-none border-none bg-zinc-900 h-12 lg:h-14 px-3 py-2 text-gray-300" name="contents" wire:model="content" id="contents" type="text">

        <button wire:click.prevent='addIntentions' class="bg-cyan-800 hover:bg-cyan-900 rounded-md h-12 lg:h-14 w-14 lg:w-16 flex items-center justify-center" type="button">
          <img src="{{ url('assets/plus.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
        </button>
      </div>
    </div>

    <input type="hidden" name="contents" value="{{ json_encode($contents) }}">

    <button type="submit" class="col-span-2 flex items-center justify-center gap-2 text-sm sm:text-base lg:text-lg font-medium bg-cyan-800 hover:bg-cyan-900 h-12 lg:h-14 rounded-md">
      @if ($isLoading)
        <img src="{{ url('assets/loader.svg') }}" class="animate-spin h-5 w-5 lg:h-6 lg:w-6">
      @else
        Enviar <img src="{{ url('assets/send.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
      @endif
    </button>
  </form>

  <div class="flex flex-wrap gap-2">
    @foreach ($contents as $intention)
      <div class="py-2 px-4 bg-zinc-900 rounded-md flex items-center gap-5 text-gray-400">
        <span class="text-sm sm:text-base lg:text-lg w-full text-center">{{ $intention }}</span>

        <button class="bg-transparent" type="button">
          <img src="{{ url('assets/x.svg') }}" class="h-4 w-4 lg:h-5 lg:w-5">
        </button>
      </div>
    @endforeach
  </div>
</div>