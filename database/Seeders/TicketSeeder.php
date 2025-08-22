<?php

namespace Database\Seeders;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Créer quelques utilisateurs si ils n'existent pas
        $users = User::factory(5)->create();
        $staffUsers = User::whereHas('roles')->take(2)->get();

        if ($staffUsers->isEmpty()) {
            $staffUsers = $users->take(2);
        }

        // Créer des tickets de démonstration
        $tickets = [
            [
                'subject' => 'Problème de connexion au serveur',
                'status' => TicketStatus::OPEN,
                'priority' => TicketPriority::HIGH,
                'category' => 'technical',
                'assigned_to' => $staffUsers->first()?->id,
            ],
            [
                'subject' => 'Question sur la facturation',
                'status' => TicketStatus::IN_PROGRESS,
                'priority' => TicketPriority::MEDIUM,
                'category' => 'billing',
                'assigned_to' => $staffUsers->last()?->id,
            ],
            [
                'subject' => 'Demande d\'assistance générale',
                'status' => TicketStatus::WAITING,
                'priority' => TicketPriority::LOW,
                'category' => 'general',
                'assigned_to' => null,
            ],
            [
                'subject' => 'Problème de performance serveur',
                'status' => TicketStatus::CLOSED,
                'priority' => TicketPriority::URGENT,
                'category' => 'server',
                'assigned_to' => $staffUsers->first()?->id,
                'closed_at' => now()->subDays(2),
                'closed_by' => $staffUsers->first()?->id,
            ],
        ];

        foreach ($tickets as $ticketData) {
            $ticket = Ticket::create([
                'uuid' => \Illuminate\Support\Str::uuid(),
                'user_id' => $users->random()->id,
                'subject' => $ticketData['subject'],
                'status' => $ticketData['status']->value,
                'priority' => $ticketData['priority']->value,
                'category' => $ticketData['category'],
                'assigned_to' => $ticketData['assigned_to'],
                'closed_at' => $ticketData['closed_at'] ?? null,
                'closed_by' => $ticketData['closed_by'] ?? null,
            ]);

            // Créer des réponses pour chaque ticket
            $responseCount = rand(1, 3);
            for ($i = 0; $i < $responseCount; $i++) {
                $isStaff = $i % 2 === 0; // Alterner entre staff et utilisateur
                
                TicketResponse::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $isStaff ? $staffUsers->random()->id : $ticket->user_id,
                    'content' => $this->getResponseContent($ticketData['category'], $isStaff),
                    'is_internal' => false,
                    'is_staff_response' => $isStaff,
                ]);
            }
        }
    }

    private function getResponseContent(string $category, bool $isStaff): string
    {
        if ($isStaff) {
            return match ($category) {
                'technical' => 'Je vais examiner ce problème technique. Pouvez-vous me donner plus de détails sur l\'erreur que vous rencontrez ?',
                'billing' => 'Je vais vérifier votre facturation. Laissez-moi examiner votre compte.',
                'server' => 'Je vais analyser les performances de votre serveur. Pouvez-vous me dire quand le problème a commencé ?',
                default => 'Je vais vous aider avec votre demande. Laissez-moi examiner les détails.',
            };
        }

        return match ($category) {
            'technical' => 'J\'ai essayé de redémarrer le service mais le problème persiste.',
            'billing' => 'Je ne comprends pas pourquoi j\'ai été facturé ce montant.',
            'server' => 'Mon serveur est très lent depuis hier soir.',
            default => 'Merci de votre aide avec cette question.',
        };
    }
}
