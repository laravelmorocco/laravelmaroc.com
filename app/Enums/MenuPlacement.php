<?php

declare(strict_types=1);

namespace App\Enums;

enum MenuPlacement: string
{
    case HEADER = 'header';
    case FOOTER = 'footer';
    case SIDEBAR = 'sidebar';
    case TOPBAR = 'topbar';
    case MOBILE_HEADER = 'mobile_header';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
