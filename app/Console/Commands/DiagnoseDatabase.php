<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiagnoseDatabase extends Command
{
    protected $signature = 'db:diagnose';
    protected $description = 'Diagnostiquer la structure de la base de données';

    public function handle()
    {
        $this->info('🔍 Diagnostic de la base de données...');
        
        try {
            // Vérifier la connexion
            $this->info('✅ Connexion à la base de données réussie');
            
            // Vérifier si la table users existe
            if (Schema::hasTable('users')) {
                $this->info('✅ Table "users" existe');
                
                // Analyser la structure de la table users
                $columns = DB::select('DESCRIBE users');
                $this->info('📋 Structure de la table "users":');
                
                foreach ($columns as $column) {
                    $this->line("  - {$column->Field}: {$column->Type} ({$column->Null}) [Key: {$column->Key}]");
                }
                
                // Vérifier le type de la colonne id
                $idColumn = collect($columns)->firstWhere('Field', 'id');
                if ($idColumn) {
                    $this->info("🎯 Colonne 'id': {$idColumn->Type}");
                    
                    // Recommandations
                    if (str_contains($idColumn->Type, 'int')) {
                        $this->info('✅ Type compatible avec unsignedBigInteger');
                    } else {
                        $this->warn('⚠️  Type potentiellement incompatible');
                    }
                }
                
            } else {
                $this->error('❌ Table "users" n\'existe pas');
            }
            
            // Vérifier les tables existantes
            $tables = DB::select('SHOW TABLES');
            $this->info('📊 Tables existantes:');
            foreach ($tables as $table) {
                $tableName = array_values((array) $table)[0];
                $this->line("  - {$tableName}");
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors du diagnostic: ' . $e->getMessage());
        }
    }
}
