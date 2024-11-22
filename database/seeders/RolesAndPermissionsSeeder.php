<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate([
            'role_name' => 'user',
            'permissions' => json_encode(['create'])
        ]);

        Role::firstOrCreate([
            'role_name' => 'admin',
            'permissions' => json_encode(['create', 'read'])
        ]);
    }
}
