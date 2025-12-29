<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule($schedule): void
    {
        $schedule->command('trl:sla-check')->everyThirtyMinutes();
        $schedule->command('trl:overdue-check')->dailyAt('08:10');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
