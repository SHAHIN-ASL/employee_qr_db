<?php

namespace App\Console;

use App\Models\Setting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\WeekendsDateEntry::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $first_weekend_cron_val = Setting::where('settings_key','first_weekend_cron_value')->first()->value;
        $second_weekend_cron_val = Setting::where('settings_key','second_weekend_cron_value')->first()->value;
        $schedule->command('date:weekend')->timezone('Asia/Dhaka')->cron('30 1 * * '.(int)$first_weekend_cron_val.','.(int)$second_weekend_cron_val);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
