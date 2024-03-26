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
        // $schedule->command('inspire')->hourly();
        #$schedule->command('sitemap:generate')->daily();
        $schedule->command('app:update-prices')->everyTwoMinutes();
        $schedule->command('export:prices')->dailyAt('23:58')->timezone('CET');
        $schedule->command('export:products-prices')->dailyAt('23:58')->timezone('CET');
        $schedule->command('app:empty-prices')->dailyAt('23:59')->timezone('CET');
        $schedule->command('app:clean-price-percent-changes')->weeklyOn(0, '00:00')->timezone('CET');
        $schedule->call('App\Http\Controllers\Backend\NotificationController@sendNotificationForPricePercentageChanges')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
