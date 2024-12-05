<?php

namespace App\Livewire;

use Livewire\Component;

class IntentionsDetailsTable extends Component
{
    public $intentionsGroup = [];
    public $massHours = [];

    public function mount($intentionsGroup, $massHours) {
        $this->intentionsGroup = $intentionsGroup;
        $this->massHours = $massHours;
    }

    public function render()
    {
        return view('livewire.intentions-details-table');
    }
}
