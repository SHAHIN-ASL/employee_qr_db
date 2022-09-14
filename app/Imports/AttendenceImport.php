<?php

namespace App\Imports;

use App\Models\Attendence;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class AttendenceImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //return new Attendence([

            //DB::table('attendences')->insert(
                //[
                    
                   // 'Name' => $row['name'],
                    //'Date' => $row['date'],
                    //'On_duty' =>$row['on_duty'],
                   // 'Off_duty' =>$row['off_duty'],
                    //'Clock_In' =>$row['clock_in'],
                    //'Clock_Out' =>$row['clock_out'],
                    //'Work_Time' =>$row['work_time'],
                   // 'ATT_Time' =>$row['att_time'],
                    //'Time' =>$row['time']
               // ]
            //)
            
        //]);
        try{
            DB::table('attendences')->insert(
                [
                   
                    'employee_Id'=>$row['employee_id'],
                    'Name' => $row['name'],
                    'Date' => $this->formateExcelDate($row['date']),
                    'On_duty' =>$this->formateExcelTime($row['on_duty']),
                    'Off_duty' =>$this->formateExcelTime($row['off_duty']),
                    'Clock_In' =>$this->formateExcelTime($row['clock_in']),
                    'Clock_Out' =>$this->formateExcelTime($row['clock_out']),
                    'Work_Time' =>$this->formateExcelTime($row['work_time']),
                    'ATT_Time' =>$this->formateExcelTime($row['att_time']),
                    'Time' =>$this->formateExcelTime($row['time'])
                ]
                );
       }catch(\Exception $e){
            //echo "Successfully Insert into database";
        }
 
    }

    private function formateExcelDate($value){

        $UNIX_DATE = ($value- 25569) * 86400;

        $returnValue =  gmdate("d-M-Y", $UNIX_DATE);

        return $returnValue;
    }
    private function formateExcelTime($value2){

        $UNIX_DATE = ($value2- 25569) * 86400;

        $returnValue2 =  gmdate("H:i:s", $UNIX_DATE);

        return $returnValue2;
    }




    
}
