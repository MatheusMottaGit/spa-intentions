<div class="flex-1 flex items-center justify-center">
    <form wire:submit.prevent="login" class="grid md:grid-cols-2 gap-3 w-full">
        @csrf
        <div class="space-y-1">
            <label for="name">Nome</label>
            <input wire:model="name" placeholder="Nome completo..." class="w-full rounded bg-zinc-900 h-12 px-2 py-1.5 text-sm text-zinc-300" id="name" type="text">
        </div>
        <div class="space-y-1">
            <label for="pin">PIN <span class="opacity-40">(Apenas números de até 5 caracteres)</span></label>
            <input wire:model="pin" placeholder="Exemplo: 12345" class="w-full rounded bg-zinc-900 h-12 px-2 py-1.5 text-sm text-zinc-300" id="pin" type="text">
        </div>
        <button type="submit" class="md:col-span-2 flex items-center justify-center gap-1 font-medium bg-cyan-800 hover:bg-cyan-900 h-12 rounded">
            @if ($isLoading)
                <img src="{{ url('assets/loader.svg') }}" class="animate-spin">
            @else
                Entrar <img src="{{ url('assets/arrow-right-to-line.svg') }}">
            @endif
        </button>
    </form>
</div>
