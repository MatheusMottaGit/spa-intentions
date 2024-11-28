@props(['mass_date', 'currentYear', 'currentMonth', 'days'])

<div class="absolute z-10 p-3 ring-1 bg-zinc-950 ring-zinc-600 rounded-md w-full sm:w-auto right-0 sm:left-auto sm:mt-2">
    <div class="flex justify-between items-center mb-4">
        <button wire:click="backMonth" class="hover:bg-zinc-900 p-2 rounded-md">
            <img src="{{ url('assets/chevron-left.svg') }}">
        </button>

        <span class="text-lg font-bold">{{ \Carbon\Carbon::create($currentYear, $currentMonth)->format('F Y') }}</span>

        <button wire:click="addMonth" class="hover:bg-zinc-900 p-2 rounded-md">
            <img src="{{ url('assets/chevron-right.svg') }}">
        </button>
    </div>

    <div class="grid grid-cols-7 gap-2 text-center">
        <div class="font-semibold text-zinc-500">D</div>
        <div class="font-semibold text-zinc-500">S</div>
        <div class="font-semibold text-zinc-500">T</div>
        <div class="font-semibold text-zinc-500">Q</div>
        <div class="font-semibold text-zinc-500">Q</div>
        <div class="font-semibold text-zinc-500">S</div>
        <div class="font-semibold text-zinc-500">S</div>

        @foreach ($days as $day)
            @if ($day)
                <button wire:click="selectDate({{ $day }})" class="p-2 border-gray-300 rounded-md hover:bg-cyan-800 hover:text-white @if ($mass_date == "$currentYear-$currentMonth-$day") bg-blue-500 text-white @endif">
                    {{ $day }}
                </button>
            @else
                <div></div>
            @endif
        @endforeach
    </div>
</div>
