<?php

namespace App\Filament\Client\Widgets;

use App\Models\Server;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class ServerSummary extends BaseWidget
{
    protected static ?string $heading = 'Mes Serveurs';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Server::query()
                    ->where('owner_id', auth()->id())
                    ->with(['egg', 'allocation'])
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Nom du serveur')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                
                TextColumn::make('egg.name')
                    ->label('Type de serveur')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('allocation.address')
                    ->label('Adresse IP')
                    ->searchable(),
                
                TextColumn::make('allocation.port')
                    ->label('Port')
                    ->sortable(),
                
                TextColumn::make('condition')
                    ->label('Statut')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state): string => 'Statut'),
                
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Server $record): string => route('filament.client.resources.servers.view', $record))
                    ->color('primary'),
                
                Action::make('console')
                    ->label('Console')
                    ->icon('heroicon-o-computer-desktop')
                    ->url(fn (Server $record): string => route('filament.client.resources.servers.view', $record))
                    ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->emptyStateHeading('Aucun serveur')
            ->emptyStateDescription('Vous n\'avez pas encore de serveurs attribués par notre équipe d\'administration.')
            ->emptyStateActions([
                Action::make('contact_support')
                    ->label('Contacter le support')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url(route('filament.client.resources.tickets.create'))
                    ->color('primary'),
            ]);
    }
}
