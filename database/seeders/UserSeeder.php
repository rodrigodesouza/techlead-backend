<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Criando usuário de acesso');
        $email = 'admin@admin.com';
        $password = '12345678';
        $user = User::updateOrCreate([
            'email' => $email,
        ],
        [
            'name' => 'Administrador',
            'email' => $email,
            'password' => Hash::make($password),
            'grupo_usuario_id' => 1,
        ]);
        $this->command->info('Login: ' . $email);
        $this->command->info('Senha: ' . $password);
        // (new Artisan:class)->info($exitCode);
    }
}
