<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::create(['name' => 'Administrador']);
        $user = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'ver usuario'])->syncRoles([$admin]);
        Permission::create(['name' => 'crear usuario'])->syncRoles([$admin]);
        Permission::create(['name' => 'crear ticket'])->syncRoles([$admin, $user]);
        Permission::create(['name' => 'Mis tickets'])->syncRoles([$user]);
        Permission::create(['name' => 'Tickets generales'])->syncRoles([$admin]);
        /* Permission::create(['name' => 'users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'users.create'])->syncRoles([$admin]);

        Permission::create(['name' => 'tickets.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'tickets.create'])->syncRoles([$admin, $user]);
*/
    }
}
