<div class="flex-1 flex flex-col gap-6 items-center justify-center">
  @session('intention-success')
    <div class="bg-black/60 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full flex p-4">
      <div class="relative rounded-lg shadow bg-zinc-900 w-full max-w-lg">
        <div class="flex items-center justify-between p-4 md:p-5 rounded-t border-b border-b-zinc-700">
          <h3 class="text-xl font-semibold text-white">{{ $value }}</h3>
          <button type="button" wire:click="toggleModal"
            class="text-zinc-400 bg-transparent hover:text-zinc-400 rounded-lg w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-zinc-600">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Fechar modal</span>
          </button>
        </div>

        <div class="p-4 md:p-5 space-y-4">
          <div
          class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-cyan-500 bg-cyan-100 rounded-lg dark:bg-cyan-900 dark:text-cyan-50">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
          </svg>
          <span class="sr-only">Check icon</span>
        </div>
          <p class="text-base leading-relaxed text-zinc-400">
            A partir de agora, aguarde sua intenção ser lida ao início da missa!
          </p>
        </div>
      </div>
    </div>
  @endsession

  @error('mass_date')
    <div id="toast-interactive-2"
      class="w-full max-w-xs p-3 text-zinc-400 rounded-lg shadow bg-zinc-800"
      role="alert">
      <div class="flex">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
          </svg>
          <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 font-normal">
          <div class="font-normal">{{ $message }}</div>
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-white items-center justify-center flex-shrink-0 text-zinc-400 hover:text-zinc-900 rounded-lg focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8 dark:text-zinc-500 dark:hover:text-white dark:bg-zinc-800 dark:hover:bg-zinc-700"
          data-dismiss-target="#toast-interactive-2" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    </div>
  @enderror

  <form method="POST" action="{{ route('intention.create', ['user_id' => auth()->user()->id, 'church_id' => $churchId]) }}" class="grid w-full max-w-6xl lg:grid-cols-2 gap-3">
    @csrf
    <div class="space-y-2">
      <label class="text-lg font-medium" for="mass_date">Data da missa</label>

      <div class="relative h-12 lg:h-14 rounded-md">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-zinc-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
          </svg>
        </div>

        <input name="mass_date" id="datepicker-format" datepicker datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom left" type="text" class="border-none text-zinc-400 bg-zinc-900 rounded-md h-full w-full ps-10" placeholder="Selecionar data...">
      </div>
    </div>

    <div class="space-y-2">
      <label for="time" class="text-lg font-medium">Horário</label>

      <div class="flex flex-column h-12 lg:h-14 base:flex-row flex-wrap space-y-4 base:space-y-0 items-center justify-between">
        <button id="dropdownDefaultButton-2" data-dropdown-toggle="dropdown-2" class="text-zinc-500 h-full bg-zinc-900 justify-between w-full focus:ring-2 focus:outline-none font-medium rounded-md text-base px-4 py-3 inline-flex items-center" type="button">
          {{ $selectedHour ? $selectedHour : 'Escolher horário' }}

          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <input type="hidden" name="mass_hour" value="{{ $selectedHour }}">

        <div id="dropdown-2" class="z-10 hidden divide-y divide-zinc-100 rounded-lg w-44 shadow bg-zinc-950 border border-zinc-600">
          <ul class="py-2 text-base text-zinc-300" aria-labelledby="dropdownDefaultButton-2">
            @foreach ($hours as $index => $hour)
            <li wire:click="selectHour({{ $index }})" class="block px-4 cursor-pointer py-2 hover:bg-cyan-800 transition-colors text-white">{{ $hour }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="space-y-2 lg:col-span-2">
      <label class="text-lg font-medium" for="church">Comunidade da missa</label>

      <div class="flex flex-column h-12 lg:h-14 base:flex-row flex-wrap space-y-4 base:space-y-0 items-center justify-between">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-zinc-500 bg-zinc-900 justify-between h-full w-full focus:ring-2 focus:outline-none font-medium rounded-md text-base px-4 py-3 inline-flex items-center" type="button">
          {{ $churchName ? $churchName : 'Escolher comunidade' }}

          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <div id="dropdown"
          class="z-10 hidden divide-y rounded-lg shadow border w-[85%] border-zinc-600 bg-zinc-950 divide-zinc-600">
          <ul class="py-2 text-base text-zinc-300" aria-labelledby="dropdownDefaultButton">
            @foreach ($churches as $church)
            <li wire:click="selectChurch('{{ $church->id }}', '{{ $church->name }}')"
              class="block px-4 cursor-pointer py-2 hover:bg-cyan-800 transition-colors text-white">{{ $church->name }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="space-y-2 lg:col-span-2 border-t border-t-zinc-800">
      <button wire:click="toggleModal" class="w-full flex gap-2 text-zinc-500 rounded-md px-3 py-3 items-center justify-start" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus-2"> <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4" /> <path d="M14 2v4a2 2 0 0 0 2 2h4" /> <path d="M3 15h6" /> <path d="M6 12v6" /></svg>
        Quais são suas intenções? {{ $contents ? '('.count($contents).')' : ''}}
      </button>

      <input type="hidden" name="contents" value="{{ json_encode($contents) }}">

      @if ($showModal)
      <div class="bg-black/60 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full flex p-4">
        <div class="relative rounded-lg shadow bg-zinc-900 w-full max-w-lg">
          <!-- Header -->
          <div class="flex items-center justify-between p-4 md:p-5 rounded-t border-b border-b-zinc-700">
            <h3 class="text-xl font-semibold text-white">Criar intenção</h3>
            <button type="button" wire:click="toggleModal"
              class="text-zinc-400 bg-transparent hover:text-zinc-400 rounded-lg w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-zinc-600">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Fechar modal</span>
            </button>
          </div>

          @if (count($contents) !== 0)
          <div class="flex flex-wrap gap-2 p-4">
            @foreach ($contents as $key => $intention)
            <div class="py-1.5 px-3 bg-zinc-800 rounded-md flex items-center gap-5 text-zinc-400">
              <span class="text-lg w-full text-center">{{ $intention }}</span>

              <button class="bg-transparent" type="button" wire:click="removeIntention({{ $key }})">
                <img src="{{ url('assets/x.svg') }}" class="size-5">
              </button>
            </div>
            @endforeach
          </div>
          @endif

          <!-- Footer -->
          <div class="flex items-center flex-col gap-2 p-4 md:p-5 rounded-b">
            <input placeholder="Digite sua intenção..."
              class="w-full rounded-md outline-none border-none bg-zinc-800 h-12 lg:h-14 px-3 py-2 text-zinc-300"
              wire:model="content" id="contents" type="text">

            <button wire:click='addIntentions'
              class="bg-cyan-800 hover:bg-cyan-900 rounded-md gap-2 h-12 lg:h-14 w-full lg:w-16 flex items-center justify-center"
              type="button">
              Adicionar
              <img src="{{ url('assets/plus.svg') }}" class="h-5 w-5 lg:h-6 lg:w-6">
            </button>
          </div>
        </div>
      </div>
      @endif
    </div>

    <button type="submit" class="lg:col-span-2 flex items-center justify-center gap-2 font-medium bg-cyan-800 hover:bg-cyan-900 h-12 lg:h-14 rounded-md">
      @if ($isLoading)
        <img src="{{ url('assets/loader.svg') }}" class="animate-spin size-5">
      @else
        Enviar <img src="{{ url('assets/send.svg') }}" class="size-5">
      @endif
    </button>
  </form>
</div>