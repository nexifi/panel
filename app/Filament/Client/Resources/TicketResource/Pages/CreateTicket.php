<?php

namespace App\Filament\Client\Resources\TicketResource\Pages;

use App\Filament\Client\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Créer le ticket
        $ticket = Ticket::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'user_id' => auth()->id(),
            'subject' => $data['subject'],
            'status' => 'open',
            'priority' => $data['priority'],
            'category' => $data['category'],
        ]);

        // Créer la première réponse avec le contenu
        if (!empty($data['content'])) {
            TicketResponse::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->id(),
                'content' => $data['content'],
                'is_internal' => false,
                'is_staff_response' => false,
            ]);
        }

        return $ticket;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Ticket créé avec succès !';
    }

    protected function getCreatedNotificationMessage(): ?string
    {
        return 'Votre ticket a été créé et sera traité par notre équipe.';
    }
}
