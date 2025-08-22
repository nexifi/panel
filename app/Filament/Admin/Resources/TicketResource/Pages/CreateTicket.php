<?php

namespace App\Filament\Admin\Resources\TicketResource\Pages;

use App\Filament\Admin\Resources\TicketResource;
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
        $ticket = Ticket::create($data);

        // Si un message initial est fourni, créer la première réponse
        if (!empty($data['initial_message'])) {
            TicketResponse::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->id(),
                'content' => $data['initial_message'],
                'is_internal' => false,
                'is_staff_response' => true,
            ]);
        }

        return $ticket;
    }
}
