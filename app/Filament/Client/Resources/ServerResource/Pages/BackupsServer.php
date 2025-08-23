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

class BackupsServer extends Page
{
    protected static string $resource = ServerResource::class;

    protected static string $view = 'filament.client.resources.server-resource.pages.backups-server';

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
        return "Sauvegardes du serveur {$this->record->name}";
    }

    public function getBreadcrumbs(): array
    {
        return [
            'Mes Serveurs' => route('filament.client.resources.servers.index'),
            $this->record->name => route('filament.client.resources.servers.view', $this->record),
            'Sauvegardes',
        ];
    }

    public function getViewData(): array
    {
        return [
            'server' => $this->record,
            'backups' => $this->getBackupsList(),
        ];
    }

    protected function getBackupsList(): array
    {
        // Simulation d'une liste de sauvegardes (à remplacer par l'API réelle)
        return [
            [
                'name' => 'backup_2025_01_15_120000.tar.gz',
                'size' => '2.1 GB',
                'created_at' => now()->subHours(2),
                'status' => 'completed',
                'type' => 'automatic',
            ],
            [
                'name' => 'backup_2025_01_14_120000.tar.gz',
                'size' => '2.0 GB',
                'created_at' => now()->subDay(),
                'status' => 'completed',
                'type' => 'automatic',
            ],
            [
                'name' => 'backup_manual_2025_01_13_150000.tar.gz',
                'size' => '2.1 GB',
                'created_at' => now()->subDays(2),
                'status' => 'completed',
                'type' => 'manual',
            ],
            [
                'name' => 'backup_2025_01_12_120000.tar.gz',
                'size' => '2.0 GB',
                'created_at' => now()->subDays(3),
                'status' => 'completed',
                'type' => 'automatic',
            ],
        ];
    }
}
