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

    public function validateData() {
        $validated = $this->validate([
            'name' => 'required|string',
            'pin' => 'required|digits:5|max:5'
        ]);

        return $validated;
    }

    public function login()
    {
        $this->isLoading = true;

        try {
            $data = $this->validateData();

            $response = Http::withOptions([
                'cookies' => false,
            ])->post('http://localhost:8000/api/sign', $data);

            if ($response->successful()) {
                $user = $response->json('user');
                
                session()->put('user', $user);

                session()->flash('success', 'Login efetuado com sucesso!');

                return redirect()->route('home');
            } else {
                session()->flash('error', 'Credenciais inválidas.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao realizar login.');
            Log::error($e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.forms.login-form');
    }
}
