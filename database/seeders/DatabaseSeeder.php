<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Arr;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $user = User::factory()->create([
            'name' => 'Steven Rincon',
            'email' => 'stevenrincon60@gmail.com',
            'password' => bcrypt('12345678'), // Asegúrate de encriptar la contraseña
        ]);

        // Asignar un rol específico
        $user->assignRole('Administrador');
        User::factory(10)->create()->each(function ($user) {
            $role = Arr::random(['Administrador', 'Usuario']);
            $user->assignRole($role);
        });

    }
}
