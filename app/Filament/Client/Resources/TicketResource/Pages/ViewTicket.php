<?php

namespace App\Filament\Client\Resources\TicketResource\Pages;

use App\Filament\Client\Resources\TicketResource;
use App\Models\TicketResponse;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        parent::mount($record);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('content')
                    ->label('Votre réponse')
                    ->required()
                    ->rows(4)
                    ->placeholder('Tapez votre réponse ici...')
                    ->columnSpanFull(),
            ]);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        if (empty($data['content'])) {
            Notification::make()
                ->title('Erreur')
                ->body('Veuillez saisir une réponse.')
                ->danger()
                ->send();
            return;
        }

        // Créer la réponse
        TicketResponse::create([
            'ticket_id' => $this->record->id,
            'user_id' => auth()->id(),
            'content' => $data['content'],
            'is_internal' => false,
            'is_staff_response' => false,
        ]);

        // Vider le formulaire
        $this->form->fill();

        Notification::make()
            ->title('Réponse envoyée')
            ->body('Votre réponse a été ajoutée au ticket.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('submit_response')
                ->label('Envoyer la réponse')
                ->submit('submit')
                ->color('primary')
                ->icon('heroicon-o-paper-airplane'),
        ];
    }
}
