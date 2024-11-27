<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class CreateIntentionForm extends Component
{
    public $mass_date;
    public $contents = [];

    public $content = "";

    public function addIntentions() {
        $this->contents[] = $this->content;
        $this->content = "";
    }

    public function render()
    {
        return view('livewire.forms.create-intention-form');
    }
}
