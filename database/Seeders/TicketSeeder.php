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
                'initial_message' => 'Bonjour, je n\'arrive plus à me connecter à mon serveur depuis hier soir. J\'ai essayé de redémarrer mais le problème persiste. Pouvez-vous m\'aider ?',
            ],
            [
                'subject' => 'Question sur la facturation',
                'status' => TicketStatus::IN_PROGRESS,
                'priority' => TicketPriority::MEDIUM,
                'category' => 'billing',
                'assigned_to' => $staffUsers->last()?->id,
                'initial_message' => 'Je ne comprends pas pourquoi j\'ai été facturé 25€ ce mois-ci. Mon abonnement était de 15€. Pouvez-vous vérifier ?',
            ],
            [
                'subject' => 'Demande d\'assistance générale',
                'status' => TicketStatus::WAITING,
                'priority' => TicketPriority::LOW,
                'category' => 'general',
                'assigned_to' => null,
                'initial_message' => 'Bonjour, j\'aimerais savoir comment configurer les sauvegardes automatiques de mon serveur. Pouvez-vous me guider ?',
            ],
            [
                'subject' => 'Problème de performance serveur',
                'status' => TicketStatus::CLOSED,
                'priority' => TicketPriority::URGENT,
                'category' => 'server',
                'assigned_to' => $staffUsers->first()?->id,
                'closed_at' => now()->subDays(2),
                'closed_by' => $staffUsers->first()?->id,
                'initial_message' => 'Mon serveur est très lent depuis hier soir. Les temps de réponse sont de 5-10 secondes au lieu de 1-2 secondes habituellement. C\'est critique pour mon activité.',
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

            // Créer d'abord le message initial du client
            TicketResponse::create([
                'ticket_id' => $ticket->id,
                'user_id' => $ticket->user_id, // Le client qui a créé le ticket
                'content' => $ticketData['initial_message'],
                'is_internal' => false,
                'is_staff_response' => false, // Message du client, pas du staff
            ]);

            // Créer ensuite des réponses de l'équipe
            $responseCount = rand(1, 2);
            for ($i = 0; $i < $responseCount; $i++) {
                TicketResponse::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $staffUsers->random()->id,
                    'content' => $this->getStaffResponseContent($ticketData['category']),
                    'is_internal' => false,
                    'is_staff_response' => true, // Réponse du staff
                ]);
            }
        }
    }

    private function getStaffResponseContent(string $category): string
    {
        return match ($category) {
            'technical' => 'Je vais examiner ce problème technique. Pouvez-vous me donner plus de détails sur l\'erreur que vous rencontrez ?',
            'billing' => 'Je vais vérifier votre facturation. Laissez-moi examiner votre compte.',
            'server' => 'Je vais analyser les performances de votre serveur. Pouvez-vous me dire quand le problème a commencé ?',
            default => 'Je vais vous aider avec votre demande. Laissez-moi examiner les détails.',
        };
    }
}
