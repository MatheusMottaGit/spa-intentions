<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\SanctumService;
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

        $roleName = $this->setRole($request->pin);
        
        $role = Role::where('role_name', $roleName)->firstOrFail();

        if ($roleName === 'user' && User::where('pin', $request->pin)->exists()) {
            return response()->json(['message' => 'Este PIN já estáem uso. Por favor, tente novamente.'], 409);
        }

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'pin' => $request->pin,
            'role_id' => $role->id
        ]);

        session(['user_id' => $user->id, 'role' => $roleName]);
        
        return response()->json([
            'message' => "Autenticado com sucesso!",
        ], 201);
    }

    protected function setRole($pin) {
        if ($pin === env('ADMIN_SECRET')) {
            return 'admin';
        }

        return 'user';
    }
}
