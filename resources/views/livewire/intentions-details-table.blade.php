<div>
  <div class="flex flex-col md:flex-row gap-2">
    <!-- horários -->
    <div class="w-40 flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 items-center">
      <button id="dropdownButton1" data-dropdown-toggle="dropdown1" class="text-white w-full md:w-64 hover:bg-zinc-900 border border-zinc-600 focus:ring-2 focus:outline-none font-medium rounded-lg text-base px-4 py-2.5 flex justify-between items-center" type="button">
        <svg class="size-3 text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
        </svg>
        
        <div class="flex items-center">
          {{ $selectedHour ? $selectedHour : 'Horários' }}
        </div>
        
        <svg class="w-2.5 h-2.5 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6" aria-hidden="true">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
      </button>

      <div id="dropdown1" class="z-10 hidden w-48 divide-y rounded-lg shadow border border-zinc-600 bg-zinc-950 divide-zinc-600">
        <ul class="py-2 text-base text-zinc-300">
          @foreach ($massHours as $hour)
          <li wire:click="filterIntentions('{{ $hour }}', {{ $selectedChurch }})"
            class="block px-4 py-2 hover:bg-cyan-800 transition-colors cursor-pointer text-white">
            {{ $hour }}
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    
    <!-- comunidades -->
    <div class="w-full md:w-auto flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 items-center">      
      <button id="dropdownButton2" data-dropdown-toggle="dropdown2" class="text-white w-full md:w-64 hover:bg-zinc-900 border border-zinc-600 focus:ring-2 focus:outline-none font-medium rounded-lg text-base px-4 py-2.5 flex justify-between items-center" type="button">
        <div class="flex items-center gap-2">
          <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-church"><path d="M10 9h4"/><path d="M12 7v5"/><path d="M14 22v-4a2 2 0 0 0-4 0v4"/><path d="M18 22V5.618a1 1 0 0 0-.553-.894l-4.553-2.277a2 2 0 0 0-1.788 0L6.553 4.724A1 1 0 0 0 6 5.618V22"/><path d="m18 7 3.447 1.724a1 1 0 0 1 .553.894V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9.618a1 1 0 0 1 .553-.894L6 7"/></svg>
        
          {{ $selectedChurch ? $churches->find($selectedChurch)->name : 'Comunidades' }}
        </div>

        <svg class="w-2.5 h-2.5 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6" aria-hidden="true">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
      </button>

      <div id="dropdown2" class="z-10 hidden divide-y rounded-lg shadow border border-zinc-600 bg-zinc-950 divide-zinc-600">
        <ul class="py-2 text-base text-zinc-300">
          @foreach ($churches as $church)
            <li wire:click="filterIntentions('{{ $selectedHour }}', {{ $church->id }})" class="cursor-pointer block px-4 py-2 hover:bg-cyan-800 transition-colors text-white">
              {{ $church->name }}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="w-full text-sm space-y-3 mt-5">
    <div class="relative overflow-x-auto shadow-md border border-zinc-600 rounded-lg mt-4">
      <table class="w-full text-sm sm:text-base text-left rtl:text-right">
        <thead class="text-zinc-300 uppercase bg-transparent border-b border-b-zinc-600">
          <tr>
            <th scope="col" class="px-4 py-3">
              Intenções
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($intentionsGroup as $date => $item)
            @foreach ($item['contents'] as $content)
              <tr class="bg-transparent border-b border-b-zinc-700 hover:bg-zinc-900">
                <td class="px-4 py-4 text-zinc-300 text-base">
                  <span class="text-lg">
                    {{ $content }}
                  </span>
                </td>
              </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>