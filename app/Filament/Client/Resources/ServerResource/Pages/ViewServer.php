<?php

namespace App\Filament\Client\Resources\ServerResource\Pages;

use App\Filament\Client\Resources\ServerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServer extends ViewRecord
{
    protected static string $resource = ServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('console')
                ->label('Accéder à la console')
                ->icon('heroicon-o-computer-desktop')
                ->color('primary')
                ->url(fn () => route('filament.client.resources.servers.console', $this->record))
                ->visible(fn () => $this->record->condition === 'online'),
            
            Actions\Action::make('files')
                ->label('Gérer les fichiers')
                ->icon('heroicon-o-folder')
                ->color('secondary')
                ->url(fn () => route('filament.client.resources.servers.files', $this->record)),
            
            Actions\Action::make('backups')
                ->label('Sauvegardes')
                ->icon('heroicon-o-archive-box')
                ->color('warning')
                ->url(fn () => route('filament.client.resources.servers.backups', $this->record)),
        ];
    }
}
