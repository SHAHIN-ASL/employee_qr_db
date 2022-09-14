<?php

namespace App\Imports;

use App\Models\MonthlyAttendence;
use App\Models\Setting;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use function PHPUnit\Framework\isEmpty;

class MonthlyAttendenceImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    *@return \Illuminate\Database\Eloquent\Model|null
    */

        public function model(array $row)
        {
            try{
                $existingDataSet = MonthlyAttendence::where(['ac_no'=>$row['ac_no'],'date'=>$this->formateExcelDate($row['date'])])->first();
                if ($existingDataSet){
                    if ($existingDataSet->ac_no == isset($row['ac_no']) && $existingDataSet->date == $this->formateExcelDate($row['date'])){
                        MonthlyAttendence::where(['ac_no'=>$row['ac_no'],'date'=>$this->formateExcelDate($row['date'])])->first()->update([
                            'emp_no'=>$row['emp_no'],
                            'ac_no'=>$row['ac_no'],
                            'no'=>$row['no'],
                            'name' => $row['name'],
                            'auto_assign' => $row['auto_assign'],
                            'date' =>$this->formateExcelDate($row['date']),
                            'timetable' =>$row['timetable'],
                            'on_duty' =>$this->formateExcelTime($row['on_duty']),
                            'off_duty' =>$this->formateExcelTime($row['off_duty']),
                            'clock_in' =>$this->formateExcelTime($row['clock_in']),
                            'clock_out' =>$this->formateExcelTime($row['clock_out']),
                            'normal' =>$row['normal'],
                            'real_time' =>$row['real_time'],
                            'late' =>$this->lateTimeCalculation($this->formateExcelTime($row['clock_in'])),
                            'early' =>$this->earlyTimeCalculation($this->formateExcelTime($row['clock_out'])),
                            'absent' =>$this->absentInsert($row['absent']),
                            'ot_time' =>$this->formateExcelTime($row['ot_time']),
                            'work_time' =>$this->formateExcelTime($row['work_time']),
                            'exception' =>$row['exception'],
                            'must_cin' =>$row['must_cin'],
                            'must_cout' =>$row['must_cout'],
                            'department' =>$row['department'],
                            'ndays' =>($row['ndays'] == null) ? 0 : $row['ndays'],
                            'weekend' =>$row['weekend'],
                            'holiday' =>$row['holiday'],
                            'att_time' =>$this->attTimeCalculation($this->formateExcelTime($row['clock_in']),$this->formateExcelTime($row['clock_out'])),
                            'ndays_ot' =>$this->formateExcelTime($row['ndays_ot']),
                            'weekend_ot' =>$row['weekend_ot'],
                            'holiday_ot' =>$row['holiday_ot'],
                        ]);
                    }else{
                        DB::table('monthly_attendences')->insert(
                            [
                                'emp_no'=>$row['emp_no'],
                                'ac_no'=>$row['ac_no'],
                                'no'=>$row['no'],
                                'name' => $row['name'],
                                'auto_assign' => $row['auto_assign'],
                                'date' =>$this->formateExcelDate($row['date']),
                                'timetable' =>$row['timetable'],
                                'on_duty' =>$this->formateExcelTime($row['on_duty']),
                                'off_duty' =>$this->formateExcelTime($row['off_duty']),
                                'clock_in' =>$this->formateExcelTime($row['clock_in']),
                                'clock_out' =>$this->formateExcelTime($row['clock_out']),
                                'normal' =>$row['normal'],
                                'real_time' =>$row['real_time'],
                                'late' =>$this->lateTimeCalculation($this->formateExcelTime($row['clock_in'])),
                                'early' =>$this->earlyTimeCalculation($this->formateExcelTime($row['clock_out'])),
                                'absent' =>$this->absentInsert($row['absent']),
                                'ot_time' =>$this->formateExcelTime($row['ot_time']),
                                'work_time' =>$this->formateExcelTime($row['work_time']),
                                'exception' =>$row['exception'],
                                'must_cin' =>$row['must_cin'],
                                'must_cout' =>$row['must_cout'],
                                'department' =>$row['department'],
                                'ndays' =>($row['ndays'] == null) ? 0 : $row['ndays'],
                                'weekend' =>$row['weekend'],
                                'holiday' =>$row['holiday'],
                                'att_time' =>$this->attTimeCalculation($this->formateExcelTime($row['clock_in']),$this->formateExcelTime($row['clock_out'])),
                                'ndays_ot' =>$this->formateExcelTime($row['ndays_ot']),
                                'weekend_ot' =>$row['weekend_ot'],
                                'holiday_ot' =>$row['holiday_ot'],
                            ]);
                    }
                }else{
                    DB::table('monthly_attendences')->insert(
                        [
                            'emp_no'=>$row['emp_no'],
                            'ac_no'=>$row['ac_no'],
                            'no'=>$row['no'],
                            'name' => $row['name'],
                            'auto_assign' => $row['auto_assign'],
                            'date' =>$this->formateExcelDate($row['date']),
                            'timetable' =>$row['timetable'],
                            'on_duty' =>$this->formateExcelTime($row['on_duty']),
                            'off_duty' =>$this->formateExcelTime($row['off_duty']),
                            'clock_in' =>$this->formateExcelTime($row['clock_in']),
                            'clock_out' =>$this->formateExcelTime($row['clock_out']),
                            'normal' =>$row['normal'],
                            'real_time' =>$row['real_time'],
                            'late' =>$this->lateTimeCalculation($this->formateExcelTime($row['clock_in'])),
                            'early' =>$this->earlyTimeCalculation($this->formateExcelTime($row['clock_out'])),
                            'absent' =>$this->absentInsert($row['absent']),
                            'ot_time' =>$this->formateExcelTime($row['ot_time']),
                            'work_time' =>$this->formateExcelTime($row['work_time']),
                            'exception' =>$row['exception'],
                            'must_cin' =>$row['must_cin'],
                            'must_cout' =>$row['must_cout'],
                            'department' =>$row['department'],
                            'ndays' =>($row['ndays'] == null) ? 0 : $row['ndays'],
                            'weekend' =>$row['weekend'],
                            'holiday' =>$row['holiday'],
                            'att_time' =>$this->attTimeCalculation($this->formateExcelTime($row['clock_in']),$this->formateExcelTime($row['clock_out'])),
                            'ndays_ot' =>$this->formateExcelTime($row['ndays_ot']),
                            'weekend_ot' =>$row['weekend_ot'],
                            'holiday_ot' =>$row['holiday_ot'],
                        ]);
                }

           }catch(\Exception $e){
                echo $e;
                exit;
            }
        }


    private function formateExcelTime($value2){

        $UNIX_DATE = ($value2- 25569) * 86400;

        $returnValue2 =  gmdate("H:i", $UNIX_DATE);

        return $returnValue2;
    }
    private function formateExcelDate($value){

        $UNIX_DATE = ($value- 25569) * 86400;

        $returnValue =  gmdate("d-M-Y", $UNIX_DATE);

        return $returnValue;
    }

    private function absentInsert($temp1)
    {

        if($temp1=="TRUE")
          {
           return 0;
          }

          elseif($temp1==null)
          {
            return 1;
          }

    }
    private function attTimeCalculation($clockIn,$clockOut)
    {
        return date('H:i',abs(strtotime($clockIn)-strtotime($clockOut)));

    }
    private function lateTimeCalculation($clockIn): string
    {
        $late = "00:00";
        if ($clockIn != "00:00"){
            $officeTimeStart = Setting::select(['value'])->where(['settings_key'=>'office_time_start','id'=>3])->first()->value;
            $clockInTime = strtotime($clockIn);
            $timeDifferenceLate = $clockInTime - strtotime(explode(' ',$officeTimeStart)[0]);
            if ($timeDifferenceLate > 0){
                $late = date('H:i',$timeDifferenceLate);
            }
        }
        return $late;
    }
    private function earlyTimeCalculation($clockOut): string
    {
        $early = "00:00";
        if ($clockOut != "00:00"){
            $officeTimeEnd = Setting::select(['value'])->where(['settings_key'=>'office_time_end','id'=>4])->first()->value;
            $clockOutTime = strtotime($clockOut);
            $timeDifferenceEarly = strtotime(date("H:i", strtotime($officeTimeEnd))) - $clockOutTime;
            if ($timeDifferenceEarly > 0){
                $early = date('H:i',$timeDifferenceEarly);
            }
        }
        return $early;
    }

}
