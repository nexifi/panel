<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(EggSeeder::class);

        Role::firstOrCreate(['name' => Role::ROOT_ADMIN]);
        
        // Ajouter le seeder des tickets si on est en environnement de développement
        if (app()->environment('local', 'development')) {
            $this->call(TicketSeeder::class);
        }
    }
}
