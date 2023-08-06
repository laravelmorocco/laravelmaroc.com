<?php

declare(strict_types=1);

namespace App\Enums;

enum PageType: string
{
    case HOME = 'home';
    case ABOUT = 'about';
    case TEAM = 'team';
    case BLOG = 'blog';
    case SERVICE = 'service';
    case PORTFOLIO = 'portfolio';
    case PROJECT = 'project';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
