<?php

namespace App\Livewire\Forms;

use Auth;
use Http;
use Livewire\Component;
use Log;

class LoginForm extends Component
{
    public $name;
    public $pin;
    public $isLoading = false;

    public function sign()
    {
        $this->isLoading = true;

        $response = Http::post(route('auth.sign'), data: [
            'name' => $this->name,
            'pin' => $this->pin
        ]);
        
        if ($response->successful()) {
            session()->flash('success', 'Login efetuado com sucesso!');

            return redirect()->route('home');
        } else {
            session()->flash('error', 'Credenciais inválidas.');
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.forms.login-form');
    }
}
