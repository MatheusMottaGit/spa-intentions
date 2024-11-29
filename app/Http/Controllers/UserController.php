<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\SanctumService;
use Auth;
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

        Auth::login($user); // start session

        return response()->json([
            'message' => "Autenticado com sucesso!",
            'user' => $user
        ], 201);
    }

    public function signOut(Request $request) {
        $userId = $request->query('user_id');
        
        if (!$userId) {
            return response()->json(['message' => 'ID necessário.'], 409);
        }

        $user = User::where('id', $userId)->firstOrFail();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        $user->delete();
        
        return response()->json(['message' => 'Logout efetuado!'], 200);
    }    

    protected function setRole($pin) {
        if ($pin === env('ADMIN_SECRET')) {
            return 'admin';
        }

        return 'user';
    }
}
