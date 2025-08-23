<?php

namespace App\Filament\Client\Pages;

use App\Filament\Client\Widgets\TicketSummary;
use App\Filament\Client\Widgets\ServerSummary;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Actions\Action;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.client.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            TicketSummary::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ServerSummary::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create_ticket')
                ->label('Créer un ticket')
                ->url(route('filament.client.resources.tickets.create'))
                ->icon('heroicon-o-plus-circle')
                ->color('primary')
                ->size('lg'),
            
            Action::make('view_tickets')
                ->label('Voir mes tickets')
                ->url(route('filament.client.resources.tickets.index'))
                ->icon('heroicon-o-ticket')
                ->color('secondary')
                ->size('lg'),
        ];
    }
}
