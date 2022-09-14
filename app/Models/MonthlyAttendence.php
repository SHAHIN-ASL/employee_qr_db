<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyAttendence extends Model
{
    use HasFactory;
    protected $table="monthly_attendences";

    protected $fillable=['emp_no','ac_no','no','name','auto_assign','date','wfh','wfho_adjustment_value','weekend_adjustment','weekend_adjustment_date','leave_adjustment','leave_adjustment_value','timetable','on_duty','off_duty','clock_in','clock_out','normal','real_time','late','early','absent','ot_time','work_time','exception','must_cin','must_cout','department','ndays','weekend','holiday','att_time','ndays_ot','weekend_ot','holidays_ot','remarks'];
    public $timestamps = false;

    public static function getMonthlyattendence()
    {
      $monthly_records=DB::table('monthly_attendences')->select('Emp_No','Ac-No','No','Name','Auto-Assign','Date','Timetable','On_duty','Off_duty','Clock_In','Clock_Out','Normal','Real_Time','Late','Early','Absent','OT_Time','Work_Time','Exception','Must_C/In','Must_C/Out','Department','NDays','Weekend','Holiday','ATT_Time','NDays_OT','Weekend_OT','Holidays_OT','remarks');

      return $monthly_records;
    }

}
