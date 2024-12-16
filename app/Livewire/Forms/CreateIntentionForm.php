<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class CreateIntentionForm extends Component
{
    public $mass_date;
    public $contents = [];
    public $content = "";
    public $isLoading = false;
    public $showModal = false;
    public $churches = [];
    public $churchId = "";
    public $churchName = "";
    public $hours = [
        '07:00',
        '08:00',
        '09:00',
        '10:00',
        '18:00',
        '19:00'
    ];
    public $selectedHour;

    public function addIntentions() {
        $this->contents[] = $this->content;
        $this->content = "";
        // dd($this->contents);
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

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function selectHour(int $index) {
        if (isset($index)) {
            $this->selectedHour = $this->hours[$index];
        }
    }

    public function selectChurch(string $id, string $name) {
        $this->churchId = $id;
        $this->churchName = $name;
        // dd($this->churchId, $this->churchName);
    }
    
    public function mount($churches) {
        $this->churches = $churches;
    }

    public function render()
    {
        return view('livewire.forms.create-intention-form');
    }
}