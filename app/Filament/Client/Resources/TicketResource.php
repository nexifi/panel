<?php

namespace App\Filament\Client\Resources;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Filament\Client\Resources\TicketResource\Pages;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Mes Tickets';

    protected static ?string $modelLabel = 'Ticket';

    protected static ?string $pluralModelLabel = 'Tickets';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du ticket')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Décrivez brièvement votre problème')
                            ->helperText('Donnez un titre clair à votre demande'),
                        
                        Forms\Components\Select::make('priority')
                            ->label('Priorité')
                            ->options([
                                'low' => 'Basse',
                                'medium' => 'Moyenne', 
                                'high' => 'Haute',
                                'urgent' => 'Urgente'
                            ])
                            ->default('medium')
                            ->required()
                            ->helperText('Choisissez la priorité selon l\'urgence de votre demande'),
                        
                        Forms\Components\Select::make('category')
                            ->label('Catégorie')
                            ->options([
                                'technical' => 'Problème technique',
                                'billing' => 'Facturation',
                                'general' => 'Question générale',
                                'bug' => 'Signalement de bug',
                                'feature' => 'Demande de fonctionnalité'
                            ])
                            ->placeholder('Sélectionnez une catégorie')
                            ->helperText('Cela nous aide à traiter votre demande plus efficacement'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Description détaillée')
                    ->description('Décrivez votre problème ou votre demande en détail pour nous permettre de vous aider au mieux')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->label('Votre message')
                            ->required()
                            ->rows(8)
                            ->minLength(10)
                            ->maxLength(5000)
                            ->placeholder('Décrivez votre problème en détail... Incluez toutes les informations utiles comme :\n• Ce qui ne fonctionne pas\n• Ce que vous essayez de faire\n• Les étapes que vous avez suivies\n• Les messages d\'erreur si applicable')
                            ->helperText('Plus votre description est détaillée, plus nous pourrons vous aider rapidement')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn (Ticket $record): string => $record->subject),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'in_progress' => 'warning',
                        'waiting' => 'info',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'Ouvert',
                        'in_progress' => 'En cours',
                        'waiting' => 'En attente',
                        'closed' => 'Fermé',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('priority')
                    ->label('Priorité')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'gray',
                        'medium' => 'info',
                        'high' => 'warning',
                        'urgent' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Basse',
                        'medium' => 'Moyenne',
                        'high' => 'Haute',
                        'urgent' => 'Urgente',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'technical' => 'Technique',
                        'billing' => 'Facturation',
                        'general' => 'Général',
                        'bug' => 'Bug',
                        'feature' => 'Fonctionnalité',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'open' => 'Ouvert',
                        'in_progress' => 'En cours',
                        'waiting' => 'En attente',
                        'closed' => 'Fermé',
                    ]),
                Tables\Filters\SelectFilter::make('priority')
                    ->label('Priorité')
                    ->options([
                        'low' => 'Basse',
                        'medium' => 'Moyenne',
                        'high' => 'Haute',
                        'urgent' => 'Urgente',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options([
                        'technical' => 'Problème technique',
                        'billing' => 'Facturation',
                        'general' => 'Question générale',
                        'bug' => 'Signalement de bug',
                        'feature' => 'Demande de fonctionnalité'
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir'),
                Tables\Actions\Action::make('respond')
                    ->label('Répondre')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url(fn (Ticket $record): string => route('filament.client.resources.tickets.edit', $record))
                    ->visible(fn (Ticket $record): bool => $record->isOpen()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
