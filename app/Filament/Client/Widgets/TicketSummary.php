<?php

namespace App\Filament\Client\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketSummary extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();
        
        return [
            Stat::make('Total des tickets', Ticket::where('user_id', $userId)->count())
                ->description('Tous vos tickets')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('primary'),
            
            Stat::make('Tickets ouverts', Ticket::where('user_id', $userId)->where('status', 'open')->count())
                ->description('En attente de réponse')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('Tickets fermés', Ticket::where('user_id', $userId)->where('status', 'closed')->count())
                ->description('Résolus')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
