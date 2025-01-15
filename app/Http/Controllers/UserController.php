<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'pin' => 'required|digits:5'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'pin.digits' => 'O campo :attribute deve ter, no máximo, 5 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect('/entrar')->withErrors($validator);
        }

        $user = new User([
            'id' => Str::uuid(),
            'name' => $request->name,
            'pin' => $request->pin,
        ]);
    
        $user->assignRole($request->pin);
    
        $user->save();

        auth()->login($user);

        return redirect()->route('home')->with('login-success', 'Usuário autenticado!');
    } 

    public function logOut(Request $request) {
        auth()->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerate();
        
        return redirect()->route('login');
    }
    
    public function loginView() {
        return view('auth.login');
    }
}
