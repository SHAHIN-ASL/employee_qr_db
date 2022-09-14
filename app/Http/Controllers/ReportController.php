<?php

namespace App\Http\Controllers;

use App\Exports\ReportExcelExport;
use App\Exports\UserAttendenceExport;
use App\Models\Employee;
use App\Models\Holidays;
use App\Models\MonthlyAttendence;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }
    public function generateEmployeesReport(Request $request)
    {

//        $total = array('1:00','2:20','4:00','5:10');
//
//        $sum = strtotime('00:00:00');
//        $sum2=0;
//        foreach ($total as $v){
//
//            $sum1=strtotime($v)-$sum;
//
//            $sum2 = $sum2+$sum1;
//        }
//
//        $sum3=$sum+$sum2;
//
//        echo date("H:i:s",$sum3);
        $reportStartDate = $request->emp_startDateParam;
        $reportEndDate = $request->emp_endDateParam;

        $getEmployeeList = Employee::where(['active'=>1])->get();
        $empIdList = [];
        foreach ($getEmployeeList as $key => $emp){
            $empIdList[$key] = $emp->employee_id;

        }

        $dataSetByDateRange = MonthlyAttendence::where(DB::raw('str_to_date(date, "%d-%M-%Y")'),'>=',$reportStartDate)->where(DB::raw('str_to_date(date, "%d-%M-%Y")'),'<=',$reportEndDate)->whereIn('ac_no', $empIdList)->get()->groupBy('name')->toArray();
        $returnArr = [];
        $returnArrNDays = [];
        $returnWorkFromHome = [];
        $returnWorkingHours = [];
        $returnLeaveDays = [];
        $returnRemarks = [];

//                        echo '<pre>';
//                print_r($dataSetByDateRange);
//        die();

        foreach ($dataSetByDateRange as $nameKey => $result) {
            foreach ($result as $key => $val){
                //$returnArr[$nameKey]['physical_office'][$key] = ($val['absent'] == '0');
                $returnWorkFromHome[$nameKey]['work_from_home'][$key] = $val['wfho_adjustment_value'];
//                $returnArr[$nameKey]['weekend_adjustment'][$key] = $val['wfho_adjustment_value'];
                $returnArr[$nameKey]['weekend_adjustment'][$key] = ($val['weekend_adjustment'] == 1);
//                $returnLeaveDays[$nameKey]['leave_adjustment'][$key] = $val['leave_adjustment'] == 1 ? (((float)$val['ndays'] == 0.5 ) ? $val['leave_adjustment'] = 0.5 : 0): 0;
                $returnLeaveDays[$nameKey]['leave_adjustment'][$key] = $val['leave_adjustment_value'];
                $returnArrNDays[$nameKey]['N_Days'][$key] = $val['ndays'];
                $returnWorkingHours[$nameKey]['Total_Working_Hours'][$key] = $val['att_time'] ;
                $returnRemarks[$nameKey]['remarks'][$key] = ($val['remarks'] != null) ? date("d/M/Y", strtotime($val['date'])).' '.'-'.' '.$val['remarks'] : '';
//                echo '<pre>';
//                print_r($val['absent'].$nameKey);
            }
//                            echo '<pre>';
//                print_r($result);

        }
//        foreach($returnArr as $mainKey => $arr){
//            echo '<pre>';
//            print_r($arr);
//        }
        //die();

//        echo '<pre>';
//        print_r($returnLeaveDays);die();

       //foreach ($returnArr as $arr){
//            $total = $arr['Total_Working_Hours'];
//
//            $sum = strtotime('00:00:00');
//            $sum2=0;
//            foreach ($total as $v){
//
//                $sum1=strtotime($v)-$sum;
//
//                $sum2 = $sum2+$sum1;
//            }
//
//            $sum3=$sum+$sum2;
//
//
//
//            echo '<pre>';
//            print_r(date("H:i:s",$sum3));


//            foreach ($arr as $dd => $arn){
//                echo '<pre>';
//
//
//                print_r(count(array_filter($arn, function($x) { return !empty($x); })).$dd);
//            }
           // if ($arr['N_Days'])

                       //echo '<pre>';
            //print_r(array_sum($arr['N_Days']));
//
        //}

//die();

        //echo '<pre>';
       // print_r($returnArr);die();

//        $newArr = [];
//
////        foreach ($arr as $dd => $arn){
////            if (isset($nameKey[$keyNew])) {
////                $nameKey[$keyNew][$dd] = count(array_filter($arn, function ($x) {
////                    return !empty($x);
////                }));
////            }
////        }
//
//        foreach($returnArr as  $keyNew => $arr){
//
////                foreach ($arr as $dd => $arn){
////
//                        $nameKey[$keyNew][$dd] = count(array_filter($arn, function ($x) {return !empty($x) ?? null;}));
////                    }
//            echo '<pre>';
//            print_r($arr);
//
//
//        }
//
//        $finalRemarks = [];
//
//        foreach ($returnRemarks as $empNameKey => $remark){
//           // echo '<pre>';
//            $finalRemarks[$empNameKey] = implode('<br>',$remark['remarks']);
//            //print_r();
//        }
//        echo '<pre>';
//        foreach($returnArr as $mainKey => $arr) {
//            echo '<br>';
//            print_r(array_sum($returnLeaveDays[$mainKey]['leave_adjustment']) + array_sum($returnArrNDays[$mainKey]['N_Days']) + count(array_filter($returnArr[$mainKey]['weekend_adjustment'], function ($x) {
//                    return !empty($x) ?? null;
//                })) + count(array_filter($returnArr[$mainKey]['work_from_home'], function ($x) {
//                    return !empty($x) ?? null;
//                })));
//        }
//        die();
        $holidayCount = Holidays::where(['active'=>1])->whereBetween('holiday_date',[$reportStartDate,$reportEndDate])->distinct()->count('holiday_date');
        $dateDiff = strtotime($reportEndDate) - strtotime($reportStartDate);
        $workingDays = round($dateDiff / (60 * 60 * 24))+1;
        $actualWorkingDays = $workingDays - $holidayCount;
        $officeTimeStart = Setting::select(['value'])->where(['settings_key'=>'office_time_start','id'=>3])->first();
        $officeTimeEnd = Setting::select(['value'])->where(['settings_key'=>'office_time_end','id'=>4])->first();
        $expectedWorkingHours = Setting::select(['value'])->where(['settings_key'=>'expected_working_hours','id'=>5])->first();

        $docType ='';
        if ($request->doc_typeParam == "PDF"){
            $docType .= "PDF";
            $pdf = PDF::loadView('report.viewReport', compact('actualWorkingDays','returnArr','returnArrNDays','returnWorkFromHome','returnWorkingHours','returnLeaveDays','reportStartDate','reportEndDate','officeTimeStart','officeTimeEnd','expectedWorkingHours','docType'))->setPaper('a4', 'landscape');
            $path = public_path('reportPdf');
            $fileName =  time().'.'.'pdf' ;
            $pdf->save($path . '/' . $fileName);
            return public_path('reportPdf/'.$fileName);
        }elseif ($request->doc_typeParam == "Excel"){
              $docType .= "Excel";
              $excelFileName = 'Excel_Report'.time().'.'.'xlsx' ;
              Excel::store(new ReportExcelExport($returnArr,$returnArrNDays,$returnWorkFromHome,$returnWorkingHours,$returnLeaveDays,$reportStartDate,$reportEndDate,$officeTimeStart,$officeTimeEnd,$expectedWorkingHours,$docType,$returnRemarks,$actualWorkingDays), 'public/reportExcel/'.$excelFileName);
              echo Storage::url('reportExcel/'.$excelFileName);
        }

    }
}
