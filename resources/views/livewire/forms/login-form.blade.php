<div class="w-full max-w-xl px-4 sm:px-6 md:px-0">
    <form wire:submit.prevent="sign" class="grid gap-4 md:grid-cols-2">
        @csrf
        <div class="space-y-2">
            <label class="text-sm sm:text-base md:text-lg font-medium" for="name">Nome</label>
            <input wire:model="name" placeholder="Nome completo..." class="text-sm sm:text-base md:text-lg border-none w-full rounded-md bg-zinc-900 h-12 px-3 py-2 text-zinc-300" id="name" type="text">
        </div>
        <div class="space-y-2">
            <label class="text-sm sm:text-base md:text-lg font-medium" for="pin">PIN 
                <span class="opacity-60 text-xs sm:text-sm">(Até 5 caracteres)</span>
            </label>
            
            <input wire:model="pin" placeholder="Exemplo: 12345" class="text-sm sm:text-base md:text-lg border-none w-full rounded-md bg-zinc-900 h-12 px-3 py-2 text-zinc-300" id="pin" type="text">
        </div>
        <button type="submit" class="md:col-span-2 flex items-center justify-center gap-2 text-sm sm:text-base md:text-lg font-medium bg-cyan-800 hover:bg-cyan-900 h-12 rounded-md">
            @if ($isLoading)
                <img src="{{ url('assets/loader.svg') }}" class="animate-spin h-5 w-5">
            @else
                Entrar 
                <img src="{{ url('assets/arrow-right-to-line.svg') }}" class="h-5 w-5">
            @endif
        </button>
    </form>
</div>