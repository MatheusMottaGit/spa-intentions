<div>
  <div class="flex flex-col md:flex-row items-center gap-3">
    <!-- horários -->
    <div class="w-full md:w-auto flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 items-center">
      <button id="dropdownButton1" data-dropdown-toggle="dropdown1"
        class="text-white bg-cyan-800 w-full md:w-64 hover:bg-cyan-900 focus:ring-2 focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 flex justify-between items-center"
        type="button">
        <div class="flex items-center">
          <svg class="w-3 h-3 mr-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
            aria-hidden="true">
            <path
              d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
          </svg>
          {{ $selectedHour ? $selectedHour : 'Filtrar horários' }}
        </div>
        <svg class="w-2.5 h-2.5 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"
          aria-hidden="true">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 4 4 4-4" />
        </svg>
      </button>

      <div id="dropdown1"
        class="z-10 hidden divide-y divide-zinc-100 rounded-lg border border-zinc-600 shadow w-[85%] bg-zinc-950">
        <ul class="py-2 text-base text-zinc-300">
          @foreach ($massHours as $hour)
          <li wire:click="filterIntentions('{{ $hour }}', {{ $selectedChurch }})"
            class="block px-4 py-2 hover:bg-zinc-900 hover:text-white cursor-pointer">
            {{ $hour }}
          </li>
          @endforeach
        </ul>
      </div>
    </div>

    <!-- comunidades -->
    <div class="w-full md:w-auto flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 items-center">
      <button id="dropdownButton2" data-dropdown-toggle="dropdown2" class="text-white bg-cyan-800 w-full md:w-64 hover:bg-cyan-900 focus:ring-2 focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 flex justify-between items-center" type="button">
        <div class="flex items-center">
          <img src="{{ url('assets/church.svg') }}" class="mr-3">
          {{ $selectedChurch ? $churches->find($selectedChurch)->name : 'Filtrar comunidades' }}
        </div>
        
        <svg class="w-2.5 h-2.5 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6" aria-hidden="true">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
      </button>

      <div id="dropdown2"
        class="z-10 hidden divide-y divide-zinc-100 rounded-lg border border-zinc-600 shadow w-[85%] bg-zinc-950">
        <ul class="py-2 text-base text-zinc-300">
          @foreach ($churches as $church)
          <li wire:click="filterIntentions('{{ $selectedHour }}', {{ $church->id }})"
            class="cursor-pointer block px-4 py-2 hover:bg-zinc-900 hover:text-white">
            {{ $church->name }}
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="w-full text-sm space-y-3 mt-8">
    <span class="opacity-70 font-medium">* Clique na intenção para ver detalhes</span>
    <div class="relative overflow-x-auto shadow-md border border-zinc-600 rounded-lg mt-4">
      <table class="w-full text-sm sm:text-base text-left rtl:text-right">
        <thead class="text-zinc-300 uppercase bg-transparent border-b border-b-zinc-600">
          <tr>
            <th scope="col" class="px-4 py-3">Nome</th>
            <th scope="col" class="px-4 py-3">Intenções</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($intentionsGroup as $intention)
          <tr class="border-b bg-transparent border-zinc-700 hover:bg-zinc-900">
            <th scope="row" class="px-4 py-4 font-medium text-zinc-300 whitespace-nowrap text-base">
              {{ App\Models\User::where('id', $intention->user_id)->first()['name'] }}
            </th>
  
            <td class="px-4 py-4 text-zinc-300 text-base">
              @foreach ($intention->contents as $content)
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button">
                  {{ Str::limit($content, 10, '...') }}
                </button>
              @endforeach
  
              <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 bg-black/60 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                  <div class="relative rounded-lg shadow bg-zinc-900">
                    <button type="button" class="absolute top-3 end-2.5 text-zinc-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-zinc-600 hover:text-white" data-modal-hide="popup-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      
                      <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-lg">
                      <h2 class="font-semibold">
                        {{ App\Models\User::where('id', $intention->user_id)->first()['name'] }}
                      </h2>
                      
                      <span>{{ $content }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>