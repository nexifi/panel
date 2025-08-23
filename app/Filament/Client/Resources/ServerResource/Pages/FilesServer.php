<?php

namespace App\Filament\Client\Resources\ServerResource\Pages;

use App\Filament\Client\Resources\ServerResource;
use Filament\Resources\Pages\Page;
use App\Models\Server;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

class FilesServer extends Page
{
    protected static string $resource = ServerResource::class;

    protected static string $view = 'filament.client.resources.server-resource.pages.files-server';

    public ?Server $record = null;

    public function mount(Server $record): void
    {
        $this->record = $record;
        
        // Vérifier que l'utilisateur est propriétaire du serveur
        if ($this->record->owner_id !== auth()->id()) {
            abort(403);
        }
    }

    public function getTitle(): string
    {
        return "Fichiers du serveur {$this->record->name}";
    }

    public function getBreadcrumbs(): array
    {
        return [
            'Mes Serveurs' => route('filament.client.resources.servers.index'),
            $this->record->name => route('filament.client.resources.servers.view', $this->record),
            'Fichiers',
        ];
    }

    public function getViewData(): array
    {
        return [
            'server' => $this->record,
            'files' => $this->getFilesList(),
        ];
    }

    protected function getFilesList(): array
    {
        // Simulation d'une liste de fichiers (à remplacer par l'API réelle)
        return [
            [
                'name' => 'server.properties',
                'size' => '2.5 KB',
                'modified' => now()->subHours(2),
                'type' => 'file',
            ],
            [
                'name' => 'logs/',
                'size' => '15.2 MB',
                'modified' => now()->subHours(1),
                'type' => 'directory',
            ],
            [
                'name' => 'worlds/',
                'size' => '2.1 GB',
                'modified' => now()->subDay(),
                'type' => 'directory',
            ],
            [
                'name' => 'plugins/',
                'size' => '45.7 MB',
                'modified' => now()->subDays(2),
                'type' => 'directory',
            ],
        ];
    }
}
