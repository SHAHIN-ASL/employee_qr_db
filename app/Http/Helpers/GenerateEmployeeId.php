<?php

namespace App\Http\Helpers;

use Carbon\Carbon;
use App\Models\Employee;


class GenerateEmployeeId {
    public static function generate($joining_date)
    {
        $count = Employee::count();
        $count++;
        
        $myDate = $joining_date;

        $date = Carbon::createFromFormat('Y-m-d', $joining_date)->format('ym');

        return "$date" . "$count";
    }
}