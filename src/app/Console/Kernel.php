<?php

namespace App\Console;

use App\Classes\WeatherService;
use App\Jobs\UpdateWeather;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // call job for update weather
        $schedule->job(new UpdateWeather(env('WEATHER_API_KEY')))->daily();
        // need call in terminal php artisan queue:work
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
