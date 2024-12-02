<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate([
            'role_name' => 'user',
        ]);

        Role::firstOrCreate([
            'role_name' => 'admin',
        ]);
    }
}
