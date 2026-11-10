<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Cria o usuário de teste usado na tela de login.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'aluno@unimontes.br'],
            ['name' => 'Aluno Unimontes', 'password' => '123456'],
        );
    }
}
