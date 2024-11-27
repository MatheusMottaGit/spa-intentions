<div class="flex-1 flex flex-col gap-8 items-center justify-center">
    <form wire:submit.prevent="registerIntention" class="grid md:grid-cols-2 gap-3 w-full">
        @csrf
        <div class="space-y-1">
            <label for="mass_date">Data da missa</label>
            <div class="w-full rounded flex items-center justify-between bg-zinc-900 h-12 px-2 py-1.5 text-sm text-zinc-300 focus:ring-2 focus:ring-zinc-100">
                <input wire:model="mass_date" placeholder="Selecione a data..." class="bg-transparent h-full outline-none" id="mass_date" type="text">
                <button class="bg-transparent border-none" type="button">
                    <img src="{{ url('assets/calendar-range.svg') }}" class="size-5 opacity-60">
                </button>
            </div>
        </div>
        <div class="space-y-1">
            <label for="contents">Intenções</label>
            <div class="flex gap-2 items-center">
                <input wire:model="content" placeholder="Exemplo: sétimos dias, aniversários..." class="w-full rounded bg-zinc-900 h-12 px-2 py-1.5 text-sm text-zinc-300" id="contents" type="text">
                <button wire:click="addIntentions" class="bg-cyan-800 hover:bg-cyan-900 rounded h-12 w-14" type="button">
                    <img src="{{ url('assets/plus.svg') }}" class="size-5 mx-auto">
                </button>
            </div>
        </div>
        <button type="submit" class="md:col-span-2 flex items-center justify-center gap-1 font-medium bg-cyan-800 hover:bg-cyan-900 h-12 rounded">
            {{-- @if ($isLoading)
                <img src="{{ url('assets/loader.svg') }}" class="animate-spin">
            @else --}}
                Enviar <img src="{{ url('assets/send.svg') }}">
            {{-- @endif --}}
        </button>
    </form>

    @if (count($contents) !== 0)
        <div class="flex flex-shrink gap-3">
            @foreach ($contents as $intention)
                <div class="p-2 w-52 bg-zinc-900 rounded flex items-center justify-between text-zinc-400">
                    <span>{{ $intention }}</span>

                    <button class="bg-transparent border-none" type="button">
                        <img src="{{ url('assets/x.svg') }}" class="size-5 mx-auto">
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>
