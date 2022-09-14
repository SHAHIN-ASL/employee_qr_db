<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $table="attendences";

    protected $fillable=['Name','Date','On_duty','Off_duty','Clock_In','Clock_Out','Work_Time','ATT_Time','Time'];

    public static function getEmployeeattendence()
    {
      $records=DB::table('attendences')->select('Employee id','Name','Date','On_duty','Off_duty','Clock_In','Clock_Out','Work_Time','ATT_Time','Time');
      return $records;
    }
}
