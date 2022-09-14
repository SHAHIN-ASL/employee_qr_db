<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Employee;
use App\Models\MonthlyAttendence;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class UserAttendenceExport implements FromView
{
    private $employee_id;

    public function __construct(int $employee_id){
        $this->employee_id = $employee_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        $employee = Employee::find($this->employee_id);
        $query=MonthlyAttendence::where('ac_no',$employee->employee_id)->get();
        $max_late_min = Setting::where('settings_key','max_late_min')->first()->value;
        $max_early_min = Setting::where('settings_key','max_early_min')->first()->value;
        return view('employee.excel', [
            'query' => $query,
            'employee' => $employee,
            'max_late_min' => (string)$max_late_min,
            'max_early_min' => (string) $max_early_min
        ]);
    }
    // public function collection()
    // {
        // $employee = Employee::find($this->employee_id);
        // $query=MonthlyAttendence::where('ac_no',$employee->employee_id)->get(); 
    //     $data = [];
    //     foreach($query as $item){
    //         $tempArray = [];
    //         $tempArray['date']  = $item->date;
    //         $tempArray['clock_in'] = $item->clock_in;
    //         $tempArray['clock_out'] = $item->clock_out;
    //         $tempArray['late'] = $item->late;
    //         $tempArray['early'] = $item->early;
    //         $isAbsent = $item->absent;
    //          if($isAbsent){
    //              $item['absent'] = "Yes";
    //          }else{
    //             $item['absent'] = "No";
    //          }
    //         $tempArray['work_time'] = $item->work_time;
    //         $tempArray['ndays'] = $item->ndays;
    //         $tempArray['att_time'] = $item->att_time;
    //         $tempArray['remarks'] = $item->remarks;
    //         array_push($data,$tempArray);
    //     }
    //     return collect($data);
    // }
}
