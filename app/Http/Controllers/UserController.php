<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Log;
use Str;
use Validator;

class UserController extends Controller
{
    public function sign(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'pin' => 'required|digits:5|max:5'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = new User([
            'id' => Str::uuid(),
            'name' => $request->name,
            'pin' => $request->pin,
        ]);
    
        $user->assignRole($request->pin);
    
        $user->save();

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Usuário autenticado!');
    } 

    public function signOut(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('sign');
    }
    
    public function signView() {
        return view('auth.sign');
    }
}
