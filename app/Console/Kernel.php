<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\Cleanup\DeleteOldUnverifiedUsers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

final class Kernel extends ConsoleKernel
{
    protected $commands = [
        DeleteOldUnverifiedUsers::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('lma:delete-old-unverified-users')->daily();

        if (app()->environment('production')) {
            $schedule->command('lma:post-article-to-twitter')->everyFourHours();
            $schedule->command('lma:post-article-to-telegram')->everyFourHours();
            $schedule->command('lma:send-unverified-mails')->weeklyOn(1, '8:00');
            $schedule->command('sitemap:generate')->daily();
        }
    }

    protected function commands(): void
    {
        $this->load([__DIR__.'/Commands']);
        // $this->load([__DIR__.'/Commands',__DIR__.'/packages/laravel-subscriptions/src/Console/Commands']);


    }
}
