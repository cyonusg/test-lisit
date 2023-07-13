<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $administradorRole = Role::where('name', 'administrador')->first();
        $usuarioRole = Role::where('name', 'usuario')->first();

        User::create([
            'name' => 'Armando Casas',
            'email' => 'armando@mañosos.com',
            'password' => Hash::make('usuario'),
            'role_id' => $usuarioRole->id,
        ]);

        User::create([
            'name' => 'Carlos Pinto',
            'email' => 'carlos@mañosos.com',
            'password' => Hash::make('admin'),
            'role_id' => $administradorRole->id,
        ]);
    }
}
