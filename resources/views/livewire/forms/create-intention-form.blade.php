<div class="flex-1 flex flex-col gap-6 sm:gap-8 items-center justify-center px-3 sm:px-6">
  <form method="POST" action="{{ route('intention.create', ['user_id' => auth()->user()->id, 'church_id' => $churchId]) }}" class="grid w-full max-w-6xl lg:grid-cols-2 gap-3">
    @csrf
    <div class="space-y-2">
      <label class="text-sm sm:text-base lg:text-lg font-medium" for="mass_date">Data da missa</label>

      <div class="relative h-12 lg:h-14 rounded-md">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-zinc-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
              d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
          </svg>
        </div>

        <input name="mass_date" id="datepicker-format" datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom left" type="text" class="border-none text-zinc-400 bg-zinc-900 rounded-md h-full w-full ps-10 p-2.5" placeholder="Selecionar data...">
      </div>
    </div>

    <div class="space-y-2">
      <label for="time" class="text-sm sm:text-base lg:text-lg font-medium">Horário</label>

      <div class="relative h-12 lg:h-14 rounded-md">
        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
              d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
              clip-rule="evenodd" />
          </svg>
        </div>

        <input name="mass_hour" type="time" id="time" class="border-none text-zinc-400 bg-zinc-900 rounded-md h-full w-full px-3 py-2" min="07:00" max="19:00" required />
      </div>
    </div>

    <div class="space-y-2 lg:col-span-2">
      <label class="text-sm sm:text-base lg:text-lg font-medium" for="church">Comunidade em que vai ocorrer a missa</label>

      <div class="flex flex-column base:flex-row flex-wrap space-y-4 base:space-y-0 items-center justify-between">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-zinc-500 bg-zinc-900 justify-between w-full focus:ring-2 focus:outline-none font-medium rounded-md text-base px-4 py-3 inline-flex items-center" type="button">
          {{ $churchName ? $churchName : 'Ver comunidades' }}

          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <div id="dropdown"class="z-10 hidden divide-y divide-zinc-100 rounded-lg border border-zinc-600 shadow w-[80%] bg-zinc-950">
          <ul class="py-2 text-base text-zinc-300" aria-labelledby="dropdownDefaultButton">
            @foreach ($churches as $church)
              <li wire:click="selectChurch('{{ $church->id }}', '{{ $church->name }}')" class="block px-4 cursor-pointer py-2 hover:bg-zinc-900 hover:text-white">{{ $church->name }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="space-y-2 lg:col-span-2">
      <label class="text-sm sm:text-base lg:text-lg font-medium" for="contents">Intenções</label>

      <div class="flex gap-2 sm:gap-3 items-center">
        <input placeholder="Exemplo: sétimos dias, aniversários..." class="w-full rounded-md outline-none border-none bg-zinc-900 h-12 lg:h-14 px-3 py-2 text-gray-300" name="contents" wire:model="content" id="contents" type="text">

        <button wire:click.prevent='addIntentions' class="bg-cyan-800 hover:bg-cyan-900 rounded-md h-12 lg:h-14 w-14 lg:w-16 flex items-center justify-center" type="button">
          <img src="{{ url('assets/plus.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
        </button>
      </div>
    </div>

    <input type="hidden" name="contents" value="{{ json_encode($contents) }}">

    <button type="submit" class="lg:col-span-2 flex items-center justify-center gap-2 text-sm sm:text-base lg:text-lg font-medium bg-cyan-800 hover:bg-cyan-900 h-12 lg:h-14 rounded-md">
      @if ($isLoading)
        <img src="{{ url('assets/loader.svg') }}" class="animate-spin h-5 w-5 lg:h-6 lg:w-6">
      @else
        Enviar <img src="{{ url('assets/send.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
      @endif
    </button>
  </form>

  <div class="flex flex-wrap gap-2">
    @foreach ($contents as $key => $intention)
      <div class="py-2 px-4 bg-zinc-900 rounded-md flex items-center gap-5 text-gray-400">
        <span class="text-sm sm:text-base lg:text-lg w-full text-center">{{ $intention }}</span>

        <button class="bg-transparent" type="button" wire:click="removeIntention({{ $key }})">
          <img src="{{ url('assets/x.svg') }}" class="h-4 w-4 lg:h-5 lg:w-5">
        </button>
      </div>
    @endforeach
  </div>
</div>