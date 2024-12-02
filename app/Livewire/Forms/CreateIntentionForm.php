<?php

namespace App\Livewire\Forms;

use Http;
use Livewire\Component;

class CreateIntentionForm extends Component
{
    public $mass_date;
    public $contents = [];
    public $content = "";
    public $isLoading = false;

    public function addIntentions() {
        $this->contents[] = $this->content;
        $this->content = "";
    }

    public function registerIntentions() {
        $this->isLoading = true;

        $data = $this->validate([
            'mass_date' => 'required|date',
            'contents' => 'required|array'
        ]);

        $response = Http::withQueryParameters([
            'user_id' => session('user')['id']
        ])->post('http://localhost:8000/api/intentions/create', $data);

        // dd($response->successful());
    }

    public function render()
    {
        return view('livewire.forms.create-intention-form');
    }
}
