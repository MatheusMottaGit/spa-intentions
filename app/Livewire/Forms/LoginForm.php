<?php

namespace App\Livewire\Forms;

use Http;
use Livewire\Component;
use Log;

class LoginForm extends Component
{
    public $name;
    public $pin;
    public $isLoading = false;

    public function validateData() {
        $validated = $this->validate([
            'name' => 'required|string',
            'pin' => 'required|digits:5|max:5'
        ]);

        return $validated;
    }

    public function login() {
        $this->isLoading = true;

        $data = $this->validateData();

        $response = Http::post('http://localhost:8000/api/sign', $data);

        if ($response->successful()) {
            session()->flash('success', 'Loggado com sucesso!');
        }else{
            session()->flash('error', 'Não foi possível efetuar o login.');
        }

        $this->isLoading = false;

        return redirect()->route('home');
        // Log::debug($response);
    }

    public function render()
    {
        return view('livewire.forms.login-form');
    }
}
