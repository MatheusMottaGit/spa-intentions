<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
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
            return response()->json($validator->errors(), 405);
        }

        $user = new User([
            'id' => Str::uuid(),
            'name' => $request->name,
            'pin' => $request->pin
        ]);

        $user->assignRole($request->pin);

        $user->save();

        Auth::login($user);

        // Log::debug(auth()->user());

        return redirect()->route('home')->with('success', 'Usuário autenticado com sucesso!');
    }

    public function signForm() {
        return view('sign');
    }

    public function getUser() {
        $user = Auth::user();

        Log::debug($user);

        return response()->json($user, 200);
    }    
}
