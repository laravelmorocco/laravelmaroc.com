<?php

declare(strict_types=1);

namespace App\Enums;

enum PageType: string
{
    case HOME = 'home';
    case ABOUT = 'about';
    case BLOG = 'blog';
    case TUTORIAL = 'tutorial';
    case DEVELOPER = 'developer';
    case PROJECT = 'project';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
