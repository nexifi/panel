<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vérifier le type de la colonne id de la table users
        $idType = $this->getUserIdColumnType();
        
        Schema::create('support_tickets', function (Blueprint $table) use ($idType) {
            $table->id();
            $table->string('uuid', 36)->unique();
            
            // Utiliser le même type que la colonne id de users
            if ($idType === 'bigint' || $idType === 'bigint unsigned') {
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('assigned_to')->nullable();
                $table->unsignedBigInteger('closed_by')->nullable();
            } else {
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('assigned_to')->nullable();
                $table->unsignedInteger('closed_by')->nullable();
            }
            
            $table->string('subject');
            $table->string('status')->default('open');
            $table->string('priority')->default('medium');
            $table->string('category')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'priority']);
            $table->index(['user_id', 'status']);
            $table->index(['assigned_to', 'status']);
        });

        // Créer la table des réponses
        Schema::create('support_ticket_responses', function (Blueprint $table) use ($idType) {
            $table->id();
            
            // Utiliser le même type que la colonne id de users
            if ($idType === 'bigint' || $idType === 'bigint unsigned') {
                $table->unsignedBigInteger('ticket_id');
                $table->unsignedBigInteger('user_id');
            } else {
                $table->unsignedInteger('ticket_id');
                $table->unsignedInteger('user_id');
            }
            
            $table->longText('content');
            $table->boolean('is_internal')->default(false);
            $table->boolean('is_staff_response')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['ticket_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });

        // Ajouter les contraintes de clé étrangère
        $this->addForeignKeys($idType);
    }

    public function down(): void
    {
        Schema::dropIfExists('support_ticket_responses');
        Schema::dropIfExists('support_tickets');
    }

    private function getUserIdColumnType(): string
    {
        try {
            $columns = DB::select('DESCRIBE users');
            foreach ($columns as $column) {
                if ($column->Field === 'id') {
                    return strtolower($column->Type);
                }
            }
        } catch (\Exception $e) {
            // En cas d'erreur, utiliser bigint par défaut
        }
        
        return 'bigint';
    }

    private function addForeignKeys(string $idType): void
    {
        try {
            // Contraintes pour support_tickets
            DB::statement('ALTER TABLE support_tickets ADD CONSTRAINT support_tickets_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
            DB::statement('ALTER TABLE support_tickets ADD CONSTRAINT support_tickets_assigned_to_foreign FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL');
            DB::statement('ALTER TABLE support_tickets ADD CONSTRAINT support_tickets_closed_by_foreign FOREIGN KEY (closed_by) REFERENCES users(id) ON DELETE SET NULL');
            
            // Contraintes pour support_ticket_responses
            DB::statement('ALTER TABLE support_ticket_responses ADD CONSTRAINT support_ticket_responses_ticket_id_foreign FOREIGN KEY (ticket_id) REFERENCES support_tickets(id) ON DELETE CASCADE');
            DB::statement('ALTER TABLE support_ticket_responses ADD CONSTRAINT support_ticket_responses_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
        } catch (\Exception $e) {
            // En cas d'erreur, ignorer les contraintes
        }
    }
};
