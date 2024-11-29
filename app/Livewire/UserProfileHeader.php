<?php

namespace App\Livewire;

use Auth;
use Http;
use Livewire\Component;

class UserProfileHeader extends Component
{
    public function logout() {
        $response = Http::withQueryParameters([
            'user_id' => session('user')['id']
        ])->post('http://localhost:8000/api/logout');
        
        Auth::logout();
        
        session()->forget('user');
        session()->regenerate();

        // Log::debug($response);
        
        if ($response->successful()) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.user-profile-header');
    }
}
