<?php

namespace App\Livewire;

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

    public function filterIntentions(string $hour) {
        if ($hour !== null) {
            $parsedDate = Carbon::parse($this->urlDate)->setHours((int) $hour);
            
            $filteredIntentions = Intention::where('mass_date', $parsedDate)->get();

            $this->intentionsGroup = $filteredIntentions;
        }
    }

    public function render()
    {
        return view('livewire.intentions-details-table');
    }

    public function mount($intentionsGroup, $date) {
        $this->intentionsGroup = $intentionsGroup;
        $this->urlDate = $date;
    }
}
