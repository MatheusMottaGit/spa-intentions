<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function sign(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'pin' => 'required|min:5|max:5'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Not valid data! Try again!');
        }

        $data = [
            'name' => $request->name,
            'pin' => $request->pin,
            'role' => $request->role === env('COORD_PIN') && "coord"
        ];

        User::create($data);

        $token = $request->user()->createToken('spa:token')->plainTextToken;

        return redirect()->route('intention.create')
            ->with('access_token', $token)
            ->with('success', "You're signed!");
    }
}
