<?php

namespace App\Filament\Admin\Resources;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Filament\Admin\Resources\TicketResource\Pages;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\Filament\CanCustomizePages;
use App\Traits\Filament\CanCustomizeRelations;
use App\Traits\Filament\CanModifyForm;
use App\Traits\Filament\CanModifyTable;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TicketResource extends Resource
{
    use CanCustomizePages;
    use CanCustomizeRelations;
    use CanModifyForm;
    use CanModifyTable;

    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'tabler-ticket';

    protected static ?string $recordTitleAttribute = 'subject';

    public static function getNavigationLabel(): string
    {
        return 'Tickets';
    }

    public static function getModelLabel(): string
    {
        return 'Ticket';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tickets';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Support';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::open()->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('subject')
                            ->label('Sujet')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Select::make('user_id')
                            ->label('Utilisateur')
                            ->options(User::pluck('username', 'id'))
                            ->searchable()
                            ->required(),

                        Select::make('status')
                            ->label('Statut')
                            ->options(collect(TicketStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->getLabel()]))
                            ->required()
                            ->default(TicketStatus::OPEN->value),

                        Select::make('priority')
                            ->label('Priorité')
                            ->options(collect(TicketPriority::cases())->mapWithKeys(fn ($priority) => [$priority->value => $priority->getLabel()]))
                            ->required()
                            ->default(TicketPriority::MEDIUM->value),

                        Select::make('category')
                            ->label('Catégorie')
                            ->options([
                                'general' => 'Général',
                                'technical' => 'Technique',
                                'billing' => 'Facturation',
                                'server' => 'Serveur',
                                'other' => 'Autre',
                            ])
                            ->searchable()
                            ->nullable(),

                        Select::make('assigned_to')
                            ->label('Assigné à')
                            ->options(User::whereHas('roles')->pluck('username', 'id'))
                            ->searchable()
                            ->nullable(),

                        Textarea::make('initial_message')
                            ->label('Message initial')
                            ->rows(5)
                            ->columnSpan(2)
                            ->placeholder('Message initial du ticket (optionnel)'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('uuid')
                    ->label('ID')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('ID copié'),

                TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('user.username')
                    ->label('Utilisateur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'in_progress' => 'warning',
                        'waiting' => 'info',
                        'closed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => TicketStatus::from($state)->getLabel()),

                TextColumn::make('priority')
                    ->label('Priorité')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'success',
                        'medium' => 'info',
                        'high' => 'warning',
                        'urgent' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => TicketPriority::from($state)->getLabel()),

                TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'general' => 'Général',
                        'technical' => 'Technique',
                        'billing' => 'Facturation',
                        'server' => 'Serveur',
                        'other' => 'Autre',
                        default => 'Non définie',
                    }),

                TextColumn::make('assignedUser.username')
                    ->label('Assigné à')
                    ->placeholder('Non assigné')
                    ->searchable(),

                TextColumn::make('responses_count')
                    ->label('Réponses')
                    ->counts('responses')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options(collect(TicketStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->getLabel()])),

                SelectFilter::make('priority')
                    ->label('Priorité')
                    ->options(collect(TicketPriority::cases())->mapWithKeys(fn ($priority) => [$priority->value => $priority->getLabel()])),

                SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options([
                        'general' => 'Général',
                        'technical' => 'Technique',
                        'billing' => 'Facturation',
                        'server' => 'Serveur',
                        'other' => 'Autre',
                    ]),

                SelectFilter::make('assigned_to')
                    ->label('Assigné à')
                    ->options(User::whereHas('roles')->pluck('username', 'id'))
                    ->searchable(),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Voir'),
                EditAction::make()
                    ->label('Modifier'),
                Action::make('close')
                    ->label('Fermer')
                    ->icon('tabler-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Ticket $record) => $record->close(auth()->user()))
                    ->visible(fn (Ticket $record) => $record->isOpen()),
                Action::make('reopen')
                    ->label('Rouvrir')
                    ->icon('tabler-refresh')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(fn (Ticket $record) => $record->reopen())
                    ->visible(fn (Ticket $record) => $record->isClosed()),
            ])
            ->bulkActions([
                BulkAction::make('close_selected')
                    ->label('Fermer les tickets sélectionnés')
                    ->icon('tabler-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Collection $records) {
                        $records->each(fn (Ticket $record) => $record->close(auth()->user()));
                    })
                    ->deselectRecordsAfterCompletion(),
                BulkAction::make('assign_selected')
                    ->label('Assigner les tickets sélectionnés')
                    ->icon('tabler-user-plus')
                    ->form([
                        Select::make('assigned_to')
                            ->label('Assigner à')
                            ->options(User::whereHas('roles')->pluck('username', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (Collection $records, array $data) {
                        $records->each(fn (Ticket $record) => $record->update(['assigned_to' => $data['assigned_to']]));
                    })
                    ->deselectRecordsAfterCompletion(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
            'view' => Pages\ViewTicket::route('/{record}'),
        ];
    }
}
