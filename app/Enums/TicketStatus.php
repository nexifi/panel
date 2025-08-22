<?php

namespace App\Enums;

enum TicketStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case WAITING = 'waiting';
    case CLOSED = 'closed';

    public function getLabel(): string
    {
        return match ($this) {
            self::OPEN => 'Ouvert',
            self::IN_PROGRESS => 'En cours',
            self::WAITING => 'En attente',
            self::CLOSED => 'Fermé',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::OPEN => 'success',
            self::IN_PROGRESS => 'warning',
            self::WAITING => 'info',
            self::CLOSED => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::OPEN => 'tabler-ticket',
            self::IN_PROGRESS => 'tabler-clock',
            self::WAITING => 'tabler-hourglass',
            self::CLOSED => 'tabler-check',
        };
    }
}
