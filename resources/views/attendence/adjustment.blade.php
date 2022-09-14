<?php

use App\Models\MonthlyAttendence;

$infoSet = json_decode($data);
  $dateSlice = explode('-',$infoSet->date);
  $finalDateFormat = $dateSlice[2].'-'.date('m', strtotime($dateSlice[1])).'-'.$dateSlice[0];

  $dataSet = MonthlyAttendence::where(['ac_no'=>$infoSet->acc_no,'date'=>$infoSet->date])->first();
//  echo "<pre>";
//  print_r($dataSet);
//  die();

?>
<style>
    .swal2-confirm.swal2-styled:focus{box-shadow:none;}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ url('attendance_adjustment_update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="account_no">Account No</label>
                                            <input type="number" id="account_no_id" class="form-control" name="account_no" value="{{ $infoSet->acc_no }}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="employee_name">Employee Name</label>
                                            <input type="text" class="form-control" name="employee_name" value="{{ $infoSet->name }}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="date">Date</label>
                                            <input id="entryDate" type="date" class="form-control" name="date" value="{{$finalDateFormat}}" readonly>
                                        </div>

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Clock in</label>
                                            <input id="clock_in_adj" type="time" class="form-control" name="clock_in" value="{{($infoSet->clock_in == "00:00") ? null : $infoSet->clock_in}}" >
                                        </div>
                                        <div class="col">
                                            <label for="date">Clock out</label>
                                            <input id="clock_out_adj" type="time" class="form-control" name="clock_out" value="{{($infoSet->clock_out == "00:00") ? null : $infoSet->clock_out}}" >
                                        </div>
                                        <div class="col">
                                            <label for="late">Late</label>
                                            <input id="late_adj" type="text" class="form-control" name="late" value="{{$infoSet->late}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="early">Early</label>
                                            <input id="early_adj" type="text" class="form-control" name="early" value="{{$infoSet->early}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Absent</label>
{{--                                            <input type="text" class="form-control" name="absent" value="{{$infoSet->absent}}">--}}
                                            <select class="form-control" name="absent">
                                                <option value="Yes" {{$infoSet->absent=='Yes'?'selected':''}}>Yes</option>
                                                <option value="No" {{$infoSet->absent=='No'?'selected':''}}>No</option>
                                            </select>
                                        </div>
{{--                                        <div class="col">--}}
{{--                                            <label for="work_time">Work Time</label>--}}
{{--                                            <input type="text" class="form-control" name="work_time" value="{{$infoSet->work_time}}" readonly>--}}
{{--                                        </div>--}}
                                        <div class="col">
                                            <label for="date">NDays</label>
                                            <input type="text" class="form-control" name="n_days" value="{{$infoSet->NDays}}">
                                        </div>
                                        <div class="col">
                                            <label for="date">ATT_Time</label>
                                            <input id="att_time_adj" type="text" class="form-control" name="att_time" value="{{$infoSet->att_time}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Remarks</label>
                                            <textarea class="form-control" name="re_marks" rows="3">{{$infoSet->remarks}}</textarea>
                                        </div>
                                        {{--                                        <div class="col">--}}
                                        {{--                                            <label for="work_time">Work Time</label>--}}
                                        {{--                                            <input type="text" class="form-control" name="work_time" value="{{$infoSet->work_time}}" readonly>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Work From Home / Outstation Work ( WFH/O ) : </label>
                                            <input class="form-control ml-3" type="radio" value="Yes" name="wfh" id="wfh_yes" {{$infoSet->wfh=='Yes'?'checked':''}}>
                                            <label class="form-check-label" for="wfh_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="wfh" id="wfh_no" {{$infoSet->wfh=='No'?'checked':''}}>
                                            <label class="form-check-label" for="wfh_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Weekend Adjustment : </label>
                                            <input class="form-control ml-5" type="radio" value="Yes" name="weekAdj" id="weekAdj_yes" {{$infoSet->weekend_adj=='Yes'?'checked':''}}>
                                            <label class="form-check-label" for="weekAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="weekAdj" id="weekAdj_no" {{$infoSet->weekend_adj=='No'?'checked':''}}>
                                            <label class="form-check-label" for="weekAdj_no">
                                                No
                                            </label>
                                            <span id="weekAdj_date_show_side" class="badge badge-danger ml-3 {{$dataSet->weekend_adjustment_date == '' ? 'd-none' : ''}}">{{"Weekend Adjustment Date : ".$dataSet->weekend_adjustment_date}}</span>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Leave Adjustment : </label>
                                            <input class="form-control" style="margin-left: 4.6rem" type="radio" value="Yes" name="leaveAdj" id="leaveAdj_yes" {{$infoSet->leave_adj=='Yes'?'checked':''}}>
                                            <label class="form-check-label" for="leaveAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="leaveAdj" id="leaveAdj_no" {{$infoSet->leave_adj=='No'?'checked':''}}>
                                            <label class="form-check-label" for="leaveAdj_no">
                                                No
                                            </label>
                                            <span id="weekAdj_date_show_side" class="badge badge-danger ml-3 {{$infoSet->leave_adj=='No'?'d-none':''}}">{{($dataSet->ndays == 0) ? "Leave Adjustment : Full Day" : "Leave Adjustment : Half Day"}}</span>
                                        </div>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $("#clock_in_adj").on('change', function() {
                timeDiffCalculation();
            });
            $("#clock_out_adj").on('change', function() {
                timeDiffCalculation();
            });

            function timeDiffCalculation (){
                let log_in_time = $("#clock_in_adj").val();
                let log_out_time = $("#clock_out_adj").val();
                let office_start_time = null;
                let office_end_time = null;
                $.ajax({
                    url:"/get_office_time",
                    type:"GET",
                    cache: false,
                    async: false,
                    success: function(response) {
                        office_start_time = response[0].value;
                        office_end_time = moment(response[1].value, ["h:mm A"]).format("HH:mm");
                    }
                })

                const [hours_in, minutes_in] = log_in_time.split(":");
                const clock_in_seconds = Number(hours_in) * 60 * 60 + Number(minutes_in) * 60;

                const [hours_out, minutes_out] = log_out_time.split(":");
                const clock_out_seconds = Number(hours_out) * 60 * 60 + Number(minutes_out) * 60;

                const [hours_fx, minutes_fx] = office_start_time.split(" ")[0].split(":");
                const clock_office_time_start_seconds = Number(hours_fx) * 60 * 60 + Number(minutes_fx) * 60;

                const [hours_end, minutes_end] = office_end_time.split(" ")[0].split(":");
                const clock_office_time_end_seconds = Number(hours_end) * 60 * 60 + Number(minutes_end) * 60;

                let secondDiff = clock_office_time_start_seconds - clock_in_seconds;

                let secondDiffEarly = clock_office_time_end_seconds - clock_out_seconds


                if (secondDiff < 0 ){
                    $("#late_adj").val(new Date(Math.abs(secondDiff) * 1000).toISOString().substring(11, 16));
                }
                if (secondDiff > 0 ){
                    $("#late_adj").val(new Date(0).toISOString().substring(11, 16));
                }
                if (secondDiff === 0){
                    $("#late_adj").val(new Date(secondDiff * 1000).toISOString().substring(11, 16));
                }

                if(secondDiffEarly > 0 ){
                    $("#early_adj").val(new Date(Math.abs(secondDiffEarly) * 1000).toISOString().substring(11, 16));
                }
                if(secondDiffEarly < 0 ){
                    $("#early_adj").val(new Date(0).toISOString().substring(11, 16));
                }
                if (secondDiffEarly === 0) {
                    $("#early_adj").val(new Date(secondDiffEarly * 1000).toISOString().substring(11, 16));
                }

                let actual_work_time =  clock_out_seconds - clock_in_seconds
                $("#att_time_adj").val(new Date(actual_work_time * 1000).toISOString().substring(11, 16));



                //console.log(new Date(actual_work_time * 1000).toISOString().substring(11, 16));

            }

            $('#weekAdj_yes').click(function(e) {

                $('input[name=wfh][value="No"]').prop('checked', true);
                $('input[name=leaveAdj][value="No"]').prop('checked', true);
                Swal.fire({
                    title: "Please enter the date",
                    html:'<input type="date" id="weekend_date_adjust" class="form-control" autofocus>',
                    showCancelButton: true,
                    confirmButtonColor: "#17A2B8",
                    confirmButtonText: "Adjust",
                    cancelButtonText: "Cancel",
                    cancelButtonColor: "#DC3545",
                    buttonsStyling: true,
                }).then(function (e){
                    if(e.value === true){

                        let weekend_date_adjust_new = $("#weekend_date_adjust").val();
                        let weekend_date_adjust_employee_acc_no = $("#account_no_id").val();
                        let en_date = $("#entryDate").val();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url:"/weekend_attendance_adjustment",
                            type:"POST",
                            data:{
                                weekend_acc_no:weekend_date_adjust_employee_acc_no,
                                weekend_adj_date_new:weekend_date_adjust_new,
                                entry_date:en_date,
                                _token: CSRF_TOKEN
                            },
                            cache: false,
                                    success: function(response) {
                                        swal.fire({
                                            title: "Success!",
                                            text: "Your Weekend Adjustment has been saved!",
                                            type: "success"
                                        }).then(function() {
                                            window.location = "{{ route('monthly_attendence.index')}}";
                                        });
                                    },
                                    failure: function (response) {
                                        swal.fire(
                                            "Internal Error",
                                            "Oops, your Adjustment was not saved.", // had a missing comma
                                            "error"
                                        )
                                    }
                        })
                    }
                })
            });

            $('#wfh_yes').click(function(e) {
                $('input[name=leaveAdj][value="No"]').prop('checked', true);
                $('input[name=weekAdj][value="No"]').prop('checked', true);
                Swal.fire({
                    title: "Please select an option",
                    html:'' +
                        '<input class="form-control" type="radio" value="fullWfhO" name="wfhOSplitAdj">' +' '+
                        '<label>Full WFH/O</label>' +' '+ '<input class="form-control" style="margin-left: 2rem" type="radio" value="halfWfhO" name="wfhOSplitAdj">' + ' ' +'<label>Half WFH/O</label>',
                    showCancelButton: true,
                    confirmButtonColor: "#17A2B8",
                    confirmButtonText: "Adjust",
                    cancelButtonText: "Cancel",
                    cancelButtonColor: "#DC3545",
                    buttonsStyling: true,
                }).then(function (e){
                    if(e.value === true){

                        let wfhOSplitAdj = $("input[name='wfhOSplitAdj']:checked").val();
                        let wfhO_adjust_employee_acc_no = $("#account_no_id").val();
                        let en_date = $("#entryDate").val();
                        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url:"/wfh_adjustment",
                            type:"POST",
                            data:{
                                wfhOSplitAdj_param:wfhOSplitAdj,
                                wfhO_adjust_employee_acc_no_param:wfhO_adjust_employee_acc_no,
                                entry_date_param:en_date,
                                _token: CSRF_TOKEN
                            },
                            cache: false,
                            success: function(response) {
                                swal.fire({
                                    title: "Success!",
                                    text: "Your WFH/O Adjustment has been saved!",
                                    type: "success"
                                }).then(function() {
                                    window.location = "{{ route('monthly_attendence.index')}}";
                                });
                            },
                            failure: function (response) {
                                swal.fire(
                                    "Internal Error",
                                    "Oops, your Adjustment was not saved.", // had a missing comma
                                    "error"
                                )
                            }
                        })
                    }
                })
            });

            $('#leaveAdj_yes').click(function(e) {
                $('input[name=wfh][value="No"]').prop('checked', true);
                $('input[name=weekAdj][value="No"]').prop('checked', true);
                Swal.fire({
                    title: "Please select an option",
                    html:'' +
                        '<input class="form-control" type="radio" value="fullDay" name="leaveDaySplitAdj">' +' '+
                        '<label>Full Day</label>' +' '+ '<input class="form-control" style="margin-left: 2rem" type="radio" value="halfDay" name="leaveDaySplitAdj">' + ' ' +'<label>Half Day</label>',
                    showCancelButton: true,
                    confirmButtonColor: "#17A2B8",
                    confirmButtonText: "Adjust",
                    cancelButtonText: "Cancel",
                    cancelButtonColor: "#DC3545",
                    buttonsStyling: true,
                }).then(function (e){
                    if(e.value === true){

                        let leaveDaySplitAdj = $("input[name='leaveDaySplitAdj']:checked").val();
                        let weekend_leave_adjust_employee_acc_no = $("#account_no_id").val();
                        let en_date = $("#entryDate").val();
                        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url:"/leave_adjustment",
                            type:"POST",
                            data:{
                                leaveDaySplitAdj_param:leaveDaySplitAdj,
                                weekend_leave_adjust_employee_acc_no_param:weekend_leave_adjust_employee_acc_no,
                                entry_date_param:en_date,
                                _token: CSRF_TOKEN
                            },
                            cache: false,
                            success: function(response) {
                                swal.fire({
                                    title: "Success!",
                                    text: "Your Leave Adjustment has been saved!",
                                    type: "success"
                                }).then(function() {
                                    window.location = "{{ route('monthly_attendence.index')}}";
                                });
                            },
                            failure: function (response) {
                                swal.fire(
                                    "Internal Error",
                                    "Oops, your Adjustment was not saved.", // had a missing comma
                                    "error"
                                )
                            }
                        })
                    }
                })
            });

        </script>
    @endsection
</x-app-layout>
