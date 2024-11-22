<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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

        $roleName = $request->pin === env('ADMIN_SECRET') ? 'admin' : 'user';

        $role = Role::where('role_name', $roleName)->firstOrFail();

        if ($role === 'user' && User::where('pin', $request->pin)->exists()) {
            return response()->json(['message' => 'PIN already taken. Please choose another.'], 409);
        }

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'pin' => $request->pin,
            'role_id' => $role->id
        ]);

        $token = $user->createToken('auth:spa:user')->plainTextToken;
        
        return response()->json([
            'access_token' => $token
        ], 201);
    }
}
