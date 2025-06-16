<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        $user = app(AuthService::class)->authenticate($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token
        ], 'Usuário autenticado!');
    } 

    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        
        return $this->successResponse([], 'Logout realizado com sucesso!');
    }
}
