<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class CreateIntentionForm extends Component
{
    public $mass_date;
    public $contents = [];
    public $content = "";
    public $isLoading = false;
    public $churches = [];
    public $churchId = "";
    public $churchName = "";

    public function addIntentions() {
        $this->contents[] = $this->content;
        $this->content = "";
    }

    public function removeIntention(int $key)
    {
        $filtered = [];

        foreach ($this->contents as $index => $content) {
            if ($index !== $key) {
                $filtered[] = $content;
            }
        }

        $this->contents = $filtered;
    }

    public function mount($churches) {
        $this->churches = $churches;
    }

    public function selectChurch(string $id, string $name) {
        $this->churchId = $id;
        $this->churchName = $name;
        // dd($this->churchId, $this->churchName);
    }

    public function render()
    {
        return view('livewire.forms.create-intention-form');
    }
}