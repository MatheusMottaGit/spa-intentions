<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Str;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function authenticate(array $credentials): User
    {
        $user = new User([
            'id' => Str::uuid(),
            'name' => $credentials['name'],
            'pin' => $credentials['pin'],
            'role_id' => $this->determineRoleId($credentials['pin'])
        ]);
        
        $user->save();
        return $user;
    }

    private function determineRoleId(string $pin): int
    {
        $roleName = $pin === config('auth.admin_secret') ? 'admin' : 'user';
        return Role::where('role_name', $roleName)->value('id');
    }
}
