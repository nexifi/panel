<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalTickets = Ticket::count();
        $openTickets = Ticket::open()->count();
        $urgentTickets = Ticket::where('priority', 'urgent')->count();
        $ticketsToday = Ticket::whereDate('created_at', today())->count();

        return [
            Stat::make('Total des tickets', $totalTickets)
                ->description('Tous les tickets confondus')
                ->descriptionIcon('tabler-ticket')
                ->color('primary'),

            Stat::make('Tickets ouverts', $openTickets)
                ->description('Tickets en attente de traitement')
                ->descriptionIcon('tabler-clock')
                ->color('warning'),

            Stat::make('Tickets urgents', $urgentTickets)
                ->description('Tickets prioritaires')
                ->descriptionIcon('tabler-exclamation')
                ->color('danger'),

            Stat::make('Tickets aujourd\'hui', $ticketsToday)
                ->description('Nouveaux tickets créés')
                ->descriptionIcon('tabler-calendar')
                ->color('success'),
        ];
    }
}
