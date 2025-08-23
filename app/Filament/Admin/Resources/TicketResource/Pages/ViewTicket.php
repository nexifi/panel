<?php

namespace App\Filament\Admin\Resources\TicketResource\Pages;

use App\Filament\Admin\Resources\TicketResource;
use App\Models\TicketResponse;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class ViewTicket extends ViewRecord implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = TicketResource::class;

    // Utiliser notre vue personnalisée
    protected static string $view = 'filament.admin.resources.ticket-resource.pages.view-ticket';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill();
        
        // Log pour debug
        \Log::info('ViewTicket mounted', [
            'record_id' => $this->record->id,
            'subject' => $this->record->subject,
            'responses_count' => $this->record->responses()->count()
        ]);
    }

    public function getFormStatePath(): string
    {
        return 'data';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('content')
                    ->label('Votre réponse')
                    ->required()
                    ->rows(5)
                    ->placeholder('Tapez votre réponse ici...'),

                Checkbox::make('is_internal')
                    ->label('Note interne (visible uniquement par l\'équipe)')
                    ->default(false),

                Checkbox::make('is_staff_response')
                    ->label('Réponse de l\'équipe')
                    ->default(true)
                    ->disabled(),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('close_ticket')
                ->label('Fermer le ticket')
                ->icon('tabler-check')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->isOpen())
                ->action(function () {
                    $this->record->close(auth()->user());
                    Notification::make()
                        ->title('Ticket fermé')
                        ->success()
                        ->send();
                }),

            Action::make('reopen_ticket')
                ->label('Rouvrir le ticket')
                ->icon('tabler-refresh')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->isClosed())
                ->action(function () {
                    $this->record->reopen();
                    Notification::make()
                        ->title('Ticket rouvert')
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function getViewData(): array
    {
        $ticket = $this->record;
        
        $allResponses = $ticket->responses()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        // Le message initial est la première réponse
        $initialResponse = $allResponses->first();
        
        // Les réponses suivantes (excluant le message initial)
        $followUpResponses = $allResponses->skip(1);

        // Log pour debug
        \Log::info('ViewTicket getViewData', [
            'ticket_id' => $ticket->id,
            'responses_count' => $allResponses->count(),
            'initial_response_exists' => $initialResponse ? true : false,
            'follow_up_count' => $followUpResponses->count()
        ]);

        return [
            'ticket' => $ticket,
            'initialResponse' => $initialResponse,
            'followUpResponses' => $followUpResponses,
            'allResponses' => $allResponses,
        ];
    }

    public function submitResponse(): void
    {
        $data = $this->form->getState();

        if (empty($data['content'])) {
            return;
        }

        TicketResponse::create([
            'ticket_id' => $this->record->id,
            'user_id' => auth()->id(),
            'content' => $data['content'],
            'is_internal' => $data['is_internal'] ?? false,
            'is_staff_response' => $data['is_staff_response'] ?? true,
        ]);

        // Mettre à jour le statut du ticket si c'est la première réponse du staff
        if ($this->record->status === 'open' && $data['is_staff_response']) {
            $this->record->update(['status' => 'in_progress']);
        }

        $this->form->fill();

        Notification::make()
            ->title('Réponse envoyée')
            ->success()
            ->send();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Widgets pour afficher les statistiques du ticket
        ];
    }
}
