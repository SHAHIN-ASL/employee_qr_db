<html lang="">
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 2px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        /*tr:nth-child(even) {*/
        /*    background-color: #dddddd;*/
        /*}*/
    </style>
</head>
<body>
<table>
    <tr>
        <th style="padding: 20px" colspan="11">
            <p style="font-size: large">Attendance Sheet ( {{$reportStartDate.' '.'to'.' '.$reportEndDate }} ) </p>
{{--            <p>Total Working Days : --}}
{{--                {{array_sum($returnLeaveDays[$mainKey]['leave_adjustment'])+--}}
{{--                array_sum($returnArrNDays[$mainKey]['N_Days'])+--}}
{{--                count(array_filter($returnArr[$mainKey]['weekend_adjustment'], function ($x) {return !empty($x) ?? null;}))+--}}
{{--                count(array_filter($returnArr[$mainKey]['work_from_home'], function ($x) {return !empty($x) ?? null;}))}}--}}
{{--            </p>--}}
            <p>Total Working Days : {{$actualWorkingDays}}</p>
            <span>Total Executive: {{count($returnArr)}}</span><span>, Office Hour : {{$officeTimeStart->value.' '.'To'.' '.$officeTimeEnd->value}}</span>
        </th>
    </tr>
    <tr>
        <th>SL.NO.</th>
        <th>Name</th>
        <th>Physical Office</th>
        <th>WFH/O</th>
        <th>Weekend Adjustment</th>
        <th>Leave</th>
        <th>Total No. Of Days</th>
        <th>Total Hours</th>
        <th>Average Hours</th>
        <th>Expected Working Hours</th>
        <th>Difference</th>
        @php
            if ($docType == 'Excel'){
                echo '<th>Remarks</th>';
            }
        @endphp
    </tr>
    @php
        $sl = 1;
    @endphp
    @foreach($returnArr as $mainKey => $arr)
        <tr>
            <td>{{$sl}}</td>
            <td width="100%" style="text-align: left">{{$mainKey}}</td>
            <td>{{array_sum($returnArrNDays[$mainKey]['N_Days'])}}</td>
            <td>{{array_sum($returnWorkFromHome[$mainKey]['work_from_home'])}}</td>
            @foreach($arr as $arn)
                <td>{{count(array_filter($arn, function($x) { return !empty($x); }))}}</td>
            @endforeach
            <td>{{array_sum($returnLeaveDays[$mainKey]['leave_adjustment'])}}</td>
            <td>{{array_sum($returnLeaveDays[$mainKey]['leave_adjustment'])+array_sum($returnArrNDays[$mainKey]['N_Days'])+count(array_filter($returnArr[$mainKey]['weekend_adjustment'], function ($x) {return !empty($x) ?? null;}))+array_sum($returnWorkFromHome[$mainKey]['work_from_home'])}}</td>
            @php
                $total = $returnWorkingHours[$mainKey]['Total_Working_Hours'];
                $days =null;
                $time_in_secs = array_map(function ($v) { return strtotime($v) - strtotime('00:00'); }, $total);
                $total_time = array_sum($time_in_secs);
                $hours = floor($total_time / 3600);
                $minutes = floor(($total_time % 3600) / 60);
                $seconds = $total_time % 60;
                $finalTime = str_pad($hours, 2, '0', STR_PAD_LEFT)
                    . ":" . str_pad($minutes, 2, '0', STR_PAD_LEFT)
                    . ":" . str_pad($seconds, 2, '0', STR_PAD_LEFT);
                echo '<td>'.$finalTime.'</td>';
                if (array_sum($returnArrNDays[$mainKey]['N_Days'])!= '0'){
                            $days = (float)array_sum($returnArrNDays[$mainKey]['N_Days']);
                            date_default_timezone_set ("UTC");
                            $actualTime_N_Days = date('H:i:s', $total_time/$days);
                    echo '<td>'.$actualTime_N_Days.'</td>';
                }
                else{
                    $dt = new DateTime;
                    $dt->setTime(0, 0);
                    echo '<td>'.$dt->format('H:i:s').'</td>';
                }
                    $dt = new DateTime;
                    $dt->setTime(8, 0);
                echo '<td>'.$expectedWorkingHours->value.'</td>';
                if (array_sum($returnArrNDays[$mainKey]['N_Days'])!= '0'){
                $expectedTime = $dt->format('H:i:s');
                $actualTime = date('H:i:s', $total_time/$days);
                $start_t = new DateTime($actualTime);
                $current_t = new DateTime($expectedTime);
                $difference = $start_t ->diff($current_t );
                $return_time = $difference ->format('%H:%I:%S');
                    if ($actualTime > $expectedTime){
                        echo '<td style ="background-color: #b5e7a0">'.$return_time.'</td>';
                    }
                    if($actualTime < $expectedTime){
                        echo '<td style ="background-color: coral">'.'-'.$return_time.'</td>';
                    }
                    if($return_time == "00:00:00"){
                        echo '<td style ="background-color: #ffffcc">'.$return_time.'</td>';
                    }
                }else{
                    $dt = new DateTime;
                    $dt->setTime(0, 0);
                    echo '<td>'.$dt->format('H:i:s').'</td>';
                }
            if ($docType == 'Excel'){
                echo '<td>'.implode('<br>',$finalRemarks[$mainKey]['remarks']).'</td>';
            }
            @endphp
        </tr>
        @php
            $sl+=1;
        @endphp
    @endforeach
</table>

</body>
</html>
