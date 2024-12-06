<?php

namespace App\Livewire;

use App\Models\Church;
use App\Models\Intention;
use Carbon\Carbon;
use Livewire\Component;

class IntentionsDetailsTable extends Component
{   
    public $urlDate = "";
    public $intentionsGroup = [];
    public $massHours = [
        '07:00',
        '08:00',
        '09:00',
        '10:00',
        '18:00',
        '19:00'
    ];
    public $churches = []; 
    public $selectedHour;
    public $selectedChurch;

    public function filterIntentions(?string $hour, ?int $churchId) {
        $this->selectedHour = $hour;
        $this->selectedChurch = $churchId;
    
        $parsedDate = Carbon::parse($this->urlDate);
    
        $filteredIntentions = Intention::query()
            ->when($hour, function ($query, $hour) use ($parsedDate) {
                $parsedDate->setTimeFromTimeString($hour);
                return $query->where('mass_date', $parsedDate);
            })
            ->when($churchId, function ($query, $churchId) {
                return $query->where('church_id', $churchId);
            })
            ->get();
    
        $this->intentionsGroup = $filteredIntentions;
    }    

    public function render()
    {
        return view('livewire.intentions-details-table');
    }

    public function mount($intentionsGroup, $date) {
        $this->intentionsGroup = $intentionsGroup;
        $this->urlDate = $date;
        $this->churches = Church::all();
    }
}
