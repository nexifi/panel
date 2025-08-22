<?php

namespace App\Enums;

enum TicketPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case URGENT = 'urgent';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Faible',
            self::MEDIUM => 'Moyenne',
            self::HIGH => 'Élevée',
            self::URGENT => 'Urgente',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::LOW => 'success',
            self::MEDIUM => 'info',
            self::HIGH => 'warning',
            self::URGENT => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::LOW => 'tabler-arrow-down',
            self::MEDIUM => 'tabler-minus',
            self::HIGH => 'tabler-arrow-up',
            self::URGENT => 'tabler-exclamation',
        };
    }
}
