<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\MonthlyAttendence;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExcelExport implements FromView
{
    private $returnArr;
    private $returnArrNDays;
    private $returnWorkingHours;
    private $returnLeaveDays;
    private $reportStartDate;
    private $reportEndDate;
    private $officeTimeStart;
    private $officeTimeEnd;
    private $expectedWorkingHours;
    private $docType;
    private $finalRemarks;
    private $actualWorkingDays;
    private $returnWorkFromHome;


    public function __construct($returnArr,$returnArrNDays,$returnWorkFromHome,$returnWorkingHours,$returnLeaveDays,$reportStartDate,$reportEndDate,$officeTimeStart,$officeTimeEnd,$expectedWorkingHours,$docType,$finalRemarks,$actualWorkingDays){

        $this->returnArr = $returnArr;
        $this->returnArrNDays = $returnArrNDays;
        $this->returnWorkingHours = $returnWorkingHours;
        $this->returnLeaveDays = $returnLeaveDays;
        $this->reportStartDate = $reportStartDate;
        $this->reportEndDate = $reportEndDate;
        $this->officeTimeStart = $officeTimeStart;
        $this->officeTimeEnd = $officeTimeEnd;
        $this->expectedWorkingHours = $expectedWorkingHours;
        $this->docType = $docType;
        $this->finalRemarks = $finalRemarks;
        $this->actualWorkingDays = $actualWorkingDays;
        $this->returnWorkFromHome =$returnWorkFromHome;

//        echo '<pre>';
//        print_r($expectedWorkingHours);die();
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
//        echo '<pre>';
//print_r($this->returnArr);die();

        return view('report.viewReport', [

            'returnArr' => $this->returnArr,
            'returnArrNDays' => $this->returnArrNDays,
            'returnWorkingHours' => $this->returnWorkingHours,
            'returnLeaveDays' => $this->returnLeaveDays,
            'reportStartDate' => $this->reportStartDate,
            'reportEndDate' => $this->reportEndDate,
            'officeTimeStart' => $this->officeTimeStart,
            'officeTimeEnd' => $this->officeTimeEnd,
            'expectedWorkingHours' => $this->expectedWorkingHours,
            'docType' => $this->docType,
            'finalRemarks' => $this->finalRemarks,
            'actualWorkingDays' => $this->actualWorkingDays,
            'returnWorkFromHome' => $this->returnWorkFromHome,

        ]);
    }
}
