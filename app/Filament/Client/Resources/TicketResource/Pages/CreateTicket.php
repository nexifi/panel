<?php

namespace App\Filament\Client\Resources\TicketResource\Pages;

use App\Filament\Client\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Validation supplémentaire du contenu
        if (empty($data['content']) || strlen(trim($data['content'])) < 10) {
            Notification::make()
                ->title('Erreur de validation')
                ->body('Le message doit contenir au moins 10 caractères.')
                ->danger()
                ->send();
            
            throw new \Exception('Le message doit contenir au moins 10 caractères.');
        }

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
        TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'content' => trim($data['content']), // Nettoyer les espaces
            'is_internal' => false,
            'is_staff_response' => false,
        ]);

        // Notification de succès
        Notification::make()
            ->title('Ticket créé avec succès !')
            ->body('Votre ticket a été créé et sera traité par notre équipe.')
            ->success()
            ->send();

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

    // Validation personnalisée avant création
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Log pour debug
        \Log::info('Données du formulaire avant création:', $data);
        
        // Nettoyer et valider le contenu
        if (isset($data['content'])) {
            $data['content'] = trim($data['content']);
            
            // Vérifier la longueur minimale
            if (strlen($data['content']) < 10) {
                throw new \Exception('Le message doit contenir au moins 10 caractères.');
            }
        }
        
        return $data;
    }

    // Validation personnalisée
    protected function getValidationRules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'priority' => ['required', 'string', 'in:low,medium,high,urgent'],
            'category' => ['nullable', 'string', 'in:technical,billing,general,bug,feature'],
            'content' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }
}
