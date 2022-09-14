<?php

namespace App\Http\Controllers;

use App\Http\Helpers\RoleCheck;
use App\Models\Employee;
use App\Models\Setting;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\MonthlyAttendence;
use App\Models\Attendence;
use Excel;
use App\Imports\MonthlyAttendenceImport;

use DataTables;
use Illuminate\Support\Facades\DB;


class MonthlyAttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
//        $monthly_attendence = MonthlyAttendence::orderBy(DB::raw('str_to_date(date, "%d-%M-%Y")'),'desc')->get();
//        echo '<pre>';
//        print_r($monthly_attendence);
//        die();

        return view('attendence.index');
    }

    public function fetchAllAttendance(Request $request)
    {
        if($request->ajax())
        {
//            $data = MonthlyAttendence::all();
            $data = MonthlyAttendence::orderBy(DB::raw('str_to_date(date, "%d-%M-%Y")'),'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $modal = '<button data-toggle="modal" type="button" class="btn btn-secondary btn-sm remark" data-id="'.$row->id.'" data-item="'.$row->remarks.'" data-target="#exampleModalCenter">+</button>';
                    if ($row->remarks != null){
                        $modal .=   '<span data-toggle="tooltip" data-placement="top" title="'.$row->remarks.'"> <i class="far fa-comment-dots fa-lg ml-2"></i></span>';
                    }
                    $modal .=   '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Remark</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action= "'.url ('store').'" method="POST">';
                                                    $modal .= csrf_field();
                                                    $modal .= '<div class="modal-body">
                                                            <div class="form-group">
                                                                <input id="hiddenAtt_id" type="hidden" name="id" value="">
                                                                <label for="message-text" class="col-form-label">Message:</label>';
                                                                $modal .= '<textarea class="form-control" name="remarks" id="message-text" ></textarea>';
                                                            $modal .= '</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                    return $modal;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('attendence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @throws \Exception
     */
    public function import(Request $request)
    {
        $employee_id = RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id());
        $dt = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
        $dt->setTimestamp(time());
        $fileName = $employee_id.'_'.$dt->format('d-m-Y').'_'.$dt->format('h:i:s').'.'.$request->file->extension();
        $request->file('file')->storeAs('public/importedExcelFiles',$fileName);
        Excel::import(new MonthlyAttendenceImport,$request->file);
        return redirect()->route("monthly_attendence.index");
    }

    public function attendanceAdjustment($data)
    {
        //
        //$monthly_attendence = MonthlyAttendence::all();

        return view('attendence.adjustment', compact('data'));
    }

    public function weekendAttendanceAdjustment(Request $request)
    {
        $dateSlice = explode('-',$request->entry_date);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        $flag = MonthlyAttendence::where(['ac_no'=>$request->weekend_acc_no,'date'=>$finalDateFormat])->first()->update(['weekend_adjustment_date'=>$request->weekend_adj_date_new,'weekend_adjustment'=> 1,'wfh'=>0]);
        if ($flag == 1){
            return true;
        }else{
            return false;
        }
    }
    public function leaveDayAdjustment(Request $request)
    {

        $dateSlice = explode('-',$request->entry_date_param);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        ($request->leaveDaySplitAdj_param == 'fullDay') ? $leaveCount = 0 : $leaveCount = 0.5;
        $flag = MonthlyAttendence::where(['ac_no'=>$request->weekend_leave_adjust_employee_acc_no_param,'date'=>$finalDateFormat])->first()->update(['leave_adjustment'=>1,'leave_adjustment_value'=>($request->leaveDaySplitAdj_param == 'fullDay') ?  1 : 0.5,'ndays'=>$leaveCount]);
        if ($flag == 1){
            return true;
        }else{
            return false;
        }
    }
    public function wfhAdjustment(Request $request)
    {
        $dateSlice = explode('-',$request->entry_date_param);
        $monthNum  = explode('-',$request->entry_date_param)[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        ($request->wfhOSplitAdj_param == 'fullWfhO') ? $leaveCount = 0 : $leaveCount = 0.5;
        $flag = MonthlyAttendence::where(['ac_no'=>$request->wfhO_adjust_employee_acc_no_param,'date'=>$finalDateFormat])->first()->update(['wfh'=>1,'wfho_adjustment_value'=>($request->wfhOSplitAdj_param == 'fullDay') ?  1 : 0.5,'ndays'=>$leaveCount]);
        if ($flag == 1){
            return true;
        }else{
            return false;
        }
    }
    public function attendanceAdjustmentUpdate(Request $request)
    {
        $dateSlice = explode('-',$request->date);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
//        print_r($request->n_days);
//        die();
//        $flag = MonthlyAttendence::where(['ac_no'=>$request->account_no,'date'=>$finalDateFormat])->first()->update(['clock_in'=>$request->clock_in,'clock_out'=>$request->clock_out,'early'=>$request->early,'late'=>$request->late,'att_time'=>$request->att_time,'ndays'=>($request->leaveAdj == "No") ? 0 : $request->n_days,'absent'=>($request->absent == "Yes")? 0 : 1,'weekend_adjustment'=> ($request->weekAdj == "Yes" )? 1 : 0,'wfh'=> ($request->wfh == "Yes" )? 1 : 0,'leave_adjustment'=> ($request->leaveAdj == "Yes" )? 1 : 0,'remarks'=>$request->re_marks]);
        MonthlyAttendence::where(['ac_no'=>$request->account_no,'date'=>$finalDateFormat])->first()->update
        ([
            'clock_in'=>($request->clock_in == null) ? '00:00' : $request->clock_in,
            'clock_out'=>($request->clock_out == null) ? '00:00' : $request->clock_out,
            'early'=>($request->clock_out == null) ? '00:00' : $request->early,
            'late'=>($request->clock_in == null) ? '00:00' : $request->late,
            'att_time'=>($request->clock_in == null && $request->clock_out == null) ? '00:00' : $request->att_time,
            'ndays'=>$request->n_days,
            'absent'=>($request->absent == "Yes")? 0 : 1,
            'wfh'=> ($request->wfh == "Yes" )? 1 : 0,
            'weekend_adjustment'=> ($request->weekAdj == "Yes" )? 1 : 0,
            'leave_adjustment'=> ($request->leaveAdj == "Yes" )? 1 : 0,
            'remarks'=>$request->re_marks
        ]);
        return redirect()->route("monthly_attendence.index");

    }
    public function attendanceAdjustmentTabInitial()
    {
        $todayDate = date('Y-m-d');
        $empNameList = Employee::select('name','employee_id')->where(['active'=> 1, 'primary_account' => 1])->get()->toArray();
//        echo '<pre>';
//        print_r($empNameList);
//        die();
//        $empNameFinalList = [];
//        foreach ($empNameList as $empName){
//            array_push($empNameFinalList,$empName['name']);
//        }
        return view('attendence.attendanceAdjustmentTab', compact('empNameList','todayDate'));

    }

    public function getAttendanceAdjustmentTabDataField(Request $request)
    {

        $dateSlice = explode('-',$request->entryDateTabFormParam);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        $dataListEmpTab = MonthlyAttendence::where('ac_no', 'like', '%' . $request->employeeIdTabFormParam . '%')->where('date',$finalDateFormat)->first()->toArray();
        return $dataListEmpTab;
    }

    public function getOfficeTimeData()
    {
        $officeTimeStart = Setting::select(['value'])->where(['settings_key'=>'office_time_start','id'=>3])->first();
        $officeTimeEnd = Setting::select(['value'])->where(['settings_key'=>'office_time_end','id'=>4])->first();
        return [$officeTimeStart,$officeTimeEnd];
    }


}
