<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur de test pour le panel client
        $user = User::firstOrCreate(
            ['email' => 'client@test.com'],
            [
                'username' => 'testclient',
                'email' => 'client@test.com',
                'password' => Hash::make('password'),
                'name_first' => 'Test',
                'name_last' => 'Client',
                'root_admin' => false,
                'language' => 'fr',
                'timezone' => 'UTC',
                'use_totp' => false,
                'totp_secret' => null,
                'oauth' => [],
                'customization' => [],
            ]
        );

        $this->command->info("Utilisateur de test créé : {$user->email} (mot de passe: password)");

        // Créer aussi un administrateur de test
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'username' => 'testadmin',
                'email' => 'admin@test.com',
                'password' => Hash::make('password'),
                'name_first' => 'Test',
                'name_last' => 'Admin',
                'root_admin' => true,
                'language' => 'fr',
                'timezone' => 'UTC',
                'use_totp' => false,
                'totp_secret' => null,
                'oauth' => [],
                'customization' => [],
            ]
        );

        $this->command->info("Administrateur de test créé : {$admin->email} (mot de passe: password)");
    }
}
