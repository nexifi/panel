<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur client de test
        User::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'email' => 'client@test.com',
            'username' => 'testclient',
            'password' => Hash::make('password'),
            'language' => 'fr',
            'timezone' => 'UTC',
            'use_totp' => false,
            'oauth' => [],
            'customization' => [],
        ]);

        // Créer un utilisateur admin de test
        User::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'email' => 'admin@test.com',
            'username' => 'testadmin',
            'password' => Hash::make('password'),
            'language' => 'fr',
            'timezone' => 'UTC',
            'use_totp' => false,
            'oauth' => [],
            'customization' => [],
        ]);

        $this->command->info('Utilisateurs de test créés avec succès !');
        $this->command->info('Client: client@test.com / password');
        $this->command->info('Admin: admin@test.com / password');
    }
}
