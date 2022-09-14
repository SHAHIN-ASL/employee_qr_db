<?php

namespace App\Console\Commands;

use App\Models\Holidays;
use App\Models\Setting;
use Illuminate\Console\Command;
use DateTime;

class WeekendsDateEntry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'date:weekend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively insert every weekend date in holiday table weekly basis.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Dhaka');
        $weekend = date("Y-m-d");
        $first_weekend_name = Setting::where('settings_key','first_weekend_name')->first()->value;
        $second_weekend_name = Setting::where('settings_key','second_weekend_name')->first()->value;
        $weekendDate = new Datetime($weekend);
        ($weekendDate->format("D") == $first_weekend_name)
            ? $weekendVal = 'First Weekend of week-'.$first_weekend_name.'-'.$weekendDate->format("W").'_'.$weekendDate->format("M").'_'.$weekendDate->format("Y")
            : $weekendVal = 'Second Weekend of week-'.$second_weekend_name.'-'.$weekendDate->format("W").'_'.$weekendDate->format("M").'_'.$weekendDate->format("Y");
        $weekendsDataset =[];
        $weekendsDataset[0]=[
            "holiday_name"=>$weekendVal,
            "holiday_date"=>$weekend,
            "holiday_type"=>"weekend",
            "active"=>1
        ];
        $flag = Holidays::insert($weekendsDataset);

        ($flag == 1) ? $this->info('Successfully insert weekend dataset.'):$this->info('Unsuccessful insert weekend dataset.');

        return 0;
    }
}
