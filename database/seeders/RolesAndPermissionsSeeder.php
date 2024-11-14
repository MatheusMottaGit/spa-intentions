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
        // Criar permissões
        $createPermission = Permission::firstOrCreate(['permission_name' => 'create_intention']);
        $readPermission = Permission::firstOrCreate(['permission_name' => 'read_intentions']);

        // Criar roles, verificando se já existem
        $userRole = Role::firstOrCreate(['role_name' => 'user']);
        $adminRole = Role::firstOrCreate(['role_name' => 'admin']);

        // Associar permissões às roles
        $userRole->permissions()->sync([$createPermission->id]); // O "user" pode criar
        $adminRole->permissions()->sync([$createPermission->id, $readPermission->id]); // O "admin" pode criar e ler
    }
}
