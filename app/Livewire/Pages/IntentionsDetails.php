<?php

namespace App\Livewire\Pages;

use App\Models\Church;
use App\Models\Intention;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class IntentionsDetails extends Component
{
    use WithPagination;
    public $urlDate = "";
    public $massHours = ['07:00', '08:00', '09:00', '10:00', '18:00', '19:00'];
    public $churches = [];
    public $selectedHour = '08:00';
    public $selectedChurch = 1;

    public function filterIntentions(string $hour = null, string $churchId = null)
    {
        $this->selectedHour = $hour ?? $this->selectedHour;
        $this->selectedChurch = $churchId ?? $this->selectedChurch;

        $this->resetPage();
    }

    public function mount($date)
    {
        $this->urlDate = $date;
        $this->churches = Church::all();
    }

    public function render()
    {
        $date = Carbon::parse($this->urlDate);

        $intentionsGroup = Intention::whereDate('mass_date', $date)
            ->whereTime('mass_date', $this->selectedHour)
            ->where('church_id', $this->selectedChurch)
            ->paginate(5);

        return view('livewire.pages.intentions-details', [
            'intentionsGroup' => $intentionsGroup,
        ])
            ->extends('components.layouts.app')
            ->section('content');
    }
}
