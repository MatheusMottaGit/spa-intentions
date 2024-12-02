<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Str;
use Validator;

class UserController extends Controller
{
    public function sign(Request $request) {
        $validator = Validator::make($request->all(), [
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 405);
        }

        $roleName = $this->setRole($request->pin);
        
        $role = Role::where('role_name', $roleName)->firstOrFail();

        if ($roleName === 'user' && User::where('pin', $request->pin)->exists()) {
            return response()->json(['message' => 'Este PIN já está em uso. Por favor, tente outro.'], 409);
        }

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'pin' => $request->pin,
            'role_id' => $role->id
        ]);

        return response()->json([
            'message' => "Autenticado!",
            'user' => $user
        ], 201);
    }    

    protected function setRole($pin) {
        if ($pin === env('ADMIN_SECRET')) {
            return 'admin';
        }

        return 'user';
    }
}
