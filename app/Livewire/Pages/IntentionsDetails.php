<?php

namespace App\Livewire\Pages;

use App\Models\Church;
use App\Models\Intention;
use Livewire\Component;
use Livewire\WithPagination;

class IntentionsDetails extends Component
{
    use WithPagination;
    public $urlDate = "";
    public $intentionsGroup = [];
    public $massHours = ['07:00','08:00','09:00','10:00','18:00','19:00'];
    public $churches = []; 
    public $selectedHour = '07:00';
    public $selectedChurch = 1;        

    public function filterIntentions() {}

    public function mount($date) {
        $this->intentionsGroup = Intention::whereDate('mass_date', $date)->get();
        $this->urlDate = $date;
        $this->churches = Church::all();
    }

    public function render()
    {
        return view('livewire.pages.intentions-details')
            ->extends('components.layouts.app', ['title' => 'Intenções | Detalhes'])
            ->section('content');
    }
}
