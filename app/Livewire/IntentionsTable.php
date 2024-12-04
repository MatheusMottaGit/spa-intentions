<?php

namespace App\Livewire;

use Livewire\Component;

class IntentionsTable extends Component
{   
    public $intentions = [];

    public function mount($intentions) {
        $this->intentions = $intentions;
    }

    public function render()
    {
        return view('livewire.intentions-table');
    }
}
