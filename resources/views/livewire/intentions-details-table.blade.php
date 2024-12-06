<div>
  <div class="flex items-center gap-3">
    <div class="flex flex-column base:flex-row flex-wrap space-y-4 base:space-y-0 items-center justify-between pb-4">
      <button id="dropdownButton1" data-dropdown-toggle="dropdown1" class="text-white bg-cyan-800 justify-between w-64 hover:bg-cyan-900 focus:ring-2 focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center" type="button">
        <div class="flex items-center">
          <svg class="w-3 h-3 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
          </svg>
          {{ $selectedHour ? $selectedHour : 'Filtrar horários' }}
        </div>
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
      </button>
      
      <div id="dropdown1" class="z-10 hidden divide-y divide-zinc-100 rounded-lg border border-zinc-600 shadow w-64 bg-zinc-950">
        <ul class="py-2 text-base text-zinc-300" aria-labelledby="dropdownButton1">
          @foreach ($massHours as $hour)
            <li wire:click="filterIntentions('{{ $hour }}')" class="block px-4 py-2 hover:bg-zinc-900 hover:text-white">
              {{ $hour }}
            </li>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="flex flex-column base:flex-row flex-wrap space-y-4 base:space-y-0 items-center justify-between pb-4">
      <button id="dropdownButton2" data-dropdown-toggle="dropdown2" class="text-white bg-cyan-800 justify-between w-64 hover:bg-cyan-900 focus:ring-2 focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center" type="button">
        <div class="flex items-center">
          <img src="{{ url('assets/church.svg') }}" class="mr-3">
          {{ $selectedChurch ? $selectedChurch : 'Filtrar comunidades' }}
        </div>
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
      </button>
      
      <div id="dropdown2" class="z-10 hidden divide-y divide-zinc-100 rounded-lg border border-zinc-600 shadow w-64 bg-zinc-950">
        <ul class="py-2 text-base text-zinc-300" aria-labelledby="dropdownButton2">
          @foreach ($churches as $church)
            <li wire:click="filterIntentions('{{ $selectedHour }}', '{{ $church->id }}')" class="cursor-pointer block px-4 py-2 hover:bg-zinc-900 hover:text-white">
              {{ $church->name }}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="relative overflow-x-auto shadow-md border border-zinc-600 rounded-lg">
    <table class="w-full text-base text-left rtl:text-right">
      <thead class="text-zinc-300 uppercase bg-transparent border-b border-b-zinc-600">
        <tr>
          <th scope="col" class="px-6 py-3">
            Nome
          </th>
          <th scope="col" class="px-6 py-3">
            Intenções
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($intentionsGroup as $intention)
          <tr class="border-b bg-transparent border-zinc-700 hover:bg-zinc-900">
            <th scope="row" class="px-6 py-4 font-medium text-zinc-300 whitespace-nowrap">
              {{ App\Models\User::where('id', $intention->user_id)->first()['name'] }}
            </th>
            <td class="px-6 py-4 text-zinc-300">
              @foreach ($intention->contents as $content)
                {{ $content }}
              @endforeach
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>