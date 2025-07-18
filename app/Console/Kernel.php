<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Jalankan presensi:mark-alpha setiap hari pukul 13:00 WIB
        $schedule->command('presensi:mark-alpha')
                 ->dailyAt('13:00')
                 ->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
