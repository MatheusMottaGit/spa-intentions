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
        Role::create([
            'role_name' => 'user',
        ]);

        Role::create([
            'role_name' => 'admin',
        ]);
    }
}
