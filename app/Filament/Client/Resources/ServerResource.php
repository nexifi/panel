<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\ServerResource\Pages;
use App\Models\Server;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServerResource extends Resource
{
    protected static ?string $model = Server::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';

    protected static ?string $navigationLabel = 'Mes Serveurs';

    protected static ?string $modelLabel = 'Serveur';

    protected static ?string $pluralModelLabel = 'Serveurs';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('owner_id', auth()->id())
            ->orderBy('name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du serveur')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom du serveur')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('external_id')
                            ->label('ID externe')
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('egg_id')
                            ->label('Type de serveur')
                            ->relationship('egg', 'name')
                            ->searchable()
                            ->preload(),
                        
                        Forms\Components\TextInput::make('allocation.address')
                            ->label('Adresse IP')
                            ->disabled()
                            ->dehydrated(false),
                        
                        Forms\Components\TextInput::make('allocation.port')
                            ->label('Port')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('egg.name')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('allocation.address')
                    ->label('Adresse IP')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('allocation.port')
                    ->label('Port')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('condition')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'success',
                        'offline' => 'danger',
                        'installing' => 'warning',
                        'install_failed' => 'danger',
                        'suspended' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'online' => 'En ligne',
                        'offline' => 'Hors ligne',
                        'installing' => 'Installation',
                        'install_failed' => 'Échec installation',
                        'suspended' => 'Suspendu',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('egg_id')
                    ->label('Type de serveur')
                    ->relationship('egg', 'name'),
                Tables\Filters\SelectFilter::make('condition')
                    ->label('Statut')
                    ->options([
                        'online' => 'En ligne',
                        'offline' => 'Hors ligne',
                        'installing' => 'Installation',
                        'install_failed' => 'Échec installation',
                        'suspended' => 'Suspendu',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Voir'),
                Tables\Actions\Action::make('files')
                    ->label('Fichiers')
                    ->icon('heroicon-o-folder')
                    ->url(fn (Server $record): string => route('filament.client.resources.servers.files', $record))
                    ->color('info'),
                Tables\Actions\Action::make('console')
                    ->label('Console')
                    ->icon('heroicon-o-computer-desktop')
                    ->url(fn (Server $record): string => route('filament.client.resources.servers.view', $record))
                    ->visible(fn (Server $record): bool => $record->condition === 'online'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServers::route('/'),
            'view' => Pages\ViewServer::route('/{record}'),
            'files' => Pages\FilesServer::route('/{record}/files'),
        ];
    }
}
