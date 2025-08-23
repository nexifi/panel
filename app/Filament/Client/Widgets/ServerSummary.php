<?php

namespace App\Filament\Client\Widgets;

use App\Models\Server;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ServerSummary extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();
        
        return [
            Stat::make('Total des serveurs', Server::where('owner_id', $userId)->count())
                ->description('Tous vos serveurs')
                ->descriptionIcon('heroicon-m-server')
                ->color('primary'),
            
            Stat::make('Serveurs en ligne', Server::where('owner_id', $userId)->where('status', 'online')->count())
                ->description('Fonctionnels')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            
            Stat::make('Serveurs hors ligne', Server::where('owner_id', $userId)->where('status', 'offline')->count())
                ->description('Non fonctionnels')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
