<header class="w-full px-4 flex items-center justify-start gap-1">
    <img src="{{ url('assets/logo.svg') }}" alt="Logo" class="h-20">
    
    <div class="flex flex-col gap-1 items-start">
        <span class="text-xs font-bold md:text-lg">{{ session('user')['name'] }}</span>
        
        <button type="button" wire:click="logout" class="text-red-500 underline font-medium text-xs md:text-lg">
            Sair
        </button>
    </div>
</header>