<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Attendence Management') }}
                </h2>
            </div>
            <div class="col-md-6">
                <a href="{{ route('attendence.create') }}" style="float: right;text-decoration: none"><i class="fas fa-plus-square"></i> Import XLSX</a>
            </div>
        </div>


    </x-slot>

<!--    --><?php
//        echo '<pre>';
//        print_r($monthly_attendence);die();
//
//
//    ?>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped" id="attendence-table" >
                        <thead>
                          <tr>

                            <th scope="col">Ac_no</th>
                            <th scope="col">Employee_Name</th>
                            <th scope="col">Entry_Date</th>
                            <th scope="col">Clock_In</th>
                            <th scope="col">Clock_Out</th>
                            <th scope="col">Late</th>
                            <th scope="col">Early</th>
                            <th scope="col">Absent</th>
                            <th scope="col">NDays</th>
                            <th scope="col">ATT_Time</th>
                            <th scope="col">WFH</th>
                            <th scope="col">WA</th>
                            <th scope="col">LA</th>
                            <th scope="col">RH</th>
                            <th scope="col">Remarks</th>

                          </tr>
                        </thead>
                        <tbody>
{{--                          @if(!empty($monthly_attendence))--}}
{{--                            @foreach ($monthly_attendence as $item)--}}
{{--                                <tr style="cursor: pointer">--}}

{{--                                    <td class="onTap">{{ $item->ac_no }}</td>--}}
{{--                                    <td class="onTap">{{ $item->name }}</td>--}}
{{--                                    <td class="onTap">{{ $item->date }}</td>--}}
{{--                                    <td class="onTap">{{ $item->clock_in }}</td>--}}
{{--                                    <td class="onTap">{{ $item->clock_out}}</td>--}}
{{--                                    @if($item->late == ' ')--}}
{{--                                         <td class="onTap">{{ date('H:i',strtotime('00:00'))}}</td>--}}
{{--                                    @else--}}
{{--                                         <td class="onTap">{{ $item->late}}</td>--}}
{{--                                    @endif--}}
{{--                                    <td class="onTap">{{ $item->early}}</td>--}}
{{--                                    <?php--}}
{{--                                    $val1=$item->absent;--}}
{{--                                    if($val1==1)--}}
{{--                                    {--}}
{{--                                    echo '<td class="onTap">', "No",'</td>';--}}
{{--                                    }--}}
{{--                                    elseif($val1==0)--}}
{{--                                    {--}}
{{--                                      echo '<td class="onTap" style="background-color:#F24D3F">', "Yes",'</td>';--}}
{{--                                    }--}}
{{--                                    ?>--}}
{{--                                    <td class="onTap">{{ $item->ndays }}</td>--}}
{{--                                    <!-- <td> -->--}}
{{--                                     <?php--}}
{{--                                      $var1=$item->att_time;--}}
{{--                                      $timeArray = explode(":",$var1); //slice ATT time into array from string--}}
{{--                                      $totalMin = ($timeArray[0]*60 + $timeArray[1]); //convert into miniutes--}}
{{--                                      $workDuration = 480; //in miniute--}}
{{--                                      $minWorkDuration = 465; //in miniute--}}
{{--                                      if($totalMin < $workDuration && $totalMin >=$minWorkDuration)--}}
{{--                                      {--}}
{{--                                       echo '<td class="onTap" style="background-color:#FFFF33">',$item->att_time,'</td>';--}}
{{--                                      }--}}
{{--                                      elseif($totalMin < $minWorkDuration)--}}
{{--                                      {--}}
{{--                                       echo '<td class="onTap" style="background-color:#F24D3F">',$item->att_time,'</td>';--}}

{{--                                      }--}}
{{--                                      else{--}}
{{--                                        echo  '<td class="onTap" style="background-color:#7EDC86">',$item->att_time,'</td>';--}}
{{--                                      }--}}
{{--                                     ?>--}}

{{--                                     <?php--}}
{{--                                     $wfh=$item->wfh;--}}
{{--                                     if($wfh==1)--}}
{{--                                     {--}}
{{--                                         echo '<td class="onTap">', "Yes",'</td>';--}}
{{--                                     }--}}
{{--                                     elseif($wfh==0)--}}
{{--                                     {--}}
{{--                                         echo '<td class="onTap">', "No",'</td>';--}}
{{--                                     }--}}
{{--                                     ?>--}}

{{--                                     <?php--}}
{{--                                     $weekend_adjustment=$item->weekend_adjustment;--}}
{{--                                     if($weekend_adjustment==1)--}}
{{--                                     {--}}
{{--                                       echo '<td class="onTap"><span data-toggle="tooltip" data-placement="top" title="'.$item->weekend_adjustment_date.'" class="badge badge-info">Yes</span></td>';--}}
{{--                                         //echo '<td>', "Yes",'</td>';--}}
{{--                                     }--}}
{{--                                     elseif($weekend_adjustment==0)--}}
{{--                                     {--}}
{{--                                         echo '<td class="onTap">', "No",'</td>';--}}
{{--                                     }--}}
{{--                                     ?>--}}
{{--                                     <?php--}}
{{--                                     $leave_adjustment=$item->leave_adjustment;--}}
{{--                                     if($leave_adjustment == 0)--}}
{{--                                     {--}}
{{--                                         echo '<td class="onTap">', "No",'</td>';--}}
{{--                                     }--}}
{{--                                     if(($leave_adjustment) == 1)--}}
{{--                                     {--}}
{{--                                         if ($item->ndays == 0){--}}
{{--                                             echo '<td class="onTap">', "Full",'</td>';--}}
{{--                                         }--}}
{{--                                         elseif ((float)$item->ndays == 0.5){--}}
{{--                                             echo '<td class="onTap">', "Half",'</td>';--}}
{{--                                         }--}}
{{--                                         elseif ($item->ndays == 1){--}}
{{--                                             echo '<td class="onTap">', "No",'</td>';--}}
{{--                                         }--}}

{{--                                     }--}}

{{--                                     ?>--}}
{{--                                    <td style="display: none">{{$item->remarks}}</td>--}}
{{--                                    <td>--}}
{{--                                        <button  type="button" class="remarkAddButton btn btn-dark btn-sm" data-toggle="modal" data-id="{{$item->id}}"  data-item="{{$item->remarks}}" data-target="#exampleModalCenter">--}}
{{--                                            +--}}
{{--                                        </button>--}}
{{--                                        @if($item->remarks != null)--}}
{{--                                            <span data-toggle="tooltip" data-placement="top" title="{{$item->remarks}}"> <i class="far fa-comment-dots fa-lg ml-2"></i></span>--}}
{{--                                        @endif--}}
{{--                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                                            <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-header">--}}
{{--                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Remark</h5>--}}
{{--                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                            <span aria-hidden="true">&times;</span>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                    <form action= "{{ url ('store') }}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        <div class="modal-body">--}}
{{--                                                            <div class="form-group">--}}
{{--                                                                <input id="hiddenAtt_id" type="hidden" name="id" value="">--}}
{{--                                                                <label for="message-text" class="col-form-label">Message:</label>--}}
{{--                                                                <textarea class="form-control" name="remarks" id="message-text" >{{$item->remarks != null ? $item->remarks : "Write your comment here .... "}}</textarea>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
{{--                                                            <button type="submit" class="btn btn-success">Save</button>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                          @endif--}}
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>


    @section('scripts')
        <script>
            $(document).ready( function () {
            let table = $('#attendence-table').DataTable({
                processing:true,
                serverSide:true,
                scrollX:true,
                ajax:'{{ route("attendance.fetch_all") }}',
                columns:[
                    {
                        class:'onTap',
                        data:'ac_no',
                    },
                    {
                        class:'onTap',
                        data:'name',
                    },
                    {
                        class:'onTap',
                        data:'date',
                    },
                    {
                        class:'onTap',
                        data:'clock_in',
                    },
                    {
                        class:'onTap',
                        data:'clock_out',
                    },
                    {
                        class:'onTap',
                        data:'late',
                    },
                    {
                        class:'onTap',
                        data:'early',
                    },
                    {
                        class:'onTap',
                        data:'absent',
                        render: function ( data, type, row, meta ) {
                            if(data >= 1){
                                return '<td class="onTap">No</td>';
                            }else {
                                return '<td class="onTap">Yes</td>'
                            }
                        }
                    },
                    {
                        class:'onTap',
                        data:'ndays',

                    },
                    {
                        class:'onTap',
                        data:'att_time',
                    },

                    {
                        class:'onTap',
                        data:'wfh',
                        render: function ( data, type, row, meta ) {
                            if(data === 1){
                                return '<td class="onTap">Yes</td>';
                            }else {
                                return '<td class="onTap">No</td>'
                            }
                        }
                    },

                    {
                        class:'onTap',
                        data:'weekend_adjustment',
                        render: function ( data, type, row, meta ) {
                            if(data === 1){
                                return '<td class="onTap">Yes</td>';
                            }else {
                                return '<td class="onTap">No</td>'
                            }
                        }
                    },

                    {
                        class:'onTap',
                        data:'leave_adjustment_value',
                        render: function ( data, type, row, meta ) {
                            if(data === 1){
                                return '<td class="onTap">Full</td>';
                            }if (data === 0.5){
                                return '<td class="onTap">Half</td>'
                            }if (data === null){
                                return '<td class="onTap">No</td>'
                            }
                        }
                    },
                    {
                        class:'onTap',
                        data:'remarks',
                        visible: false
                    },

                    {
                        data:'action',
                    }
                ],
                columnDefs: [
                    { "width": "170", "targets": 1 },
                    {
                        targets: 7,
                        createdCell: function (td, cellData, rowData, row, col) {
                            if ( cellData < 1) {
                                $(td).css('background-color', '#F24D3F').css('color', '#FFFFFF')
                            }
                        },
                    },
                    {
                        targets: 9,
                        createdCell: function (td, cellData, rowData, row, col) {
                            let totalMin = Number(cellData.split(":")[0]) * 60 + Number(cellData.split(":")[1]);
                            let workDuration = 480;
                            let minWorkDuration = 465;
                            if(totalMin < workDuration && totalMin >=minWorkDuration)
                            {
                                $(td).css('background-color', '#FFFF33');
                            }
                            else if(totalMin < minWorkDuration)
                            {
                                $(td).css('background-color', '#F24D3F').css('color', '#FFFFFF');
                            }
                            else
                            {
                                $(td).css('background-color', '#7EDC86');
                            }
                        },
                    }

                ],

            })
                $("#attendence-table").on( 'click', 'td.onTap', function () {
                    let data = $("#attendence-table").DataTable().row(this).data();
                    // console.log(data);
                    let newDataSet = {};
                    newDataSet['acc_no']=data.ac_no;
                    newDataSet['name']=data.name;
                    newDataSet['date']=data.date
                    newDataSet['clock_in']=data.clock_in;
                    newDataSet['clock_out']=data.clock_out;
                    newDataSet['late']=data.late;
                    newDataSet['early']=data.early;
                    newDataSet['absent']=data.absent;
                    newDataSet['NDays']=data.ndays;
                    newDataSet['att_time']=data.att_time;
                    newDataSet['wfh']=(data.wfh === 0) ? 'No':'Yes';
                    newDataSet['weekend_adj']=(data.weekend_adjustment === 0) ? 'No':'Yes';
                    newDataSet['leave_adj']=(data.leave_adjustment === 0) ? 'No':'Yes';
                    newDataSet['remarks']=data.remarks;
                   // console.log(newDataSet);
                    window.open("/attendance_adjustment/"+JSON.stringify(newDataSet),'_blank');
                    window.location.href = "/attendance_adjustment/"+JSON.stringify(newDataSet);
                } );

    });

            // function stripHtml(html)
            // {
            //     let tmp = document.createElement("DIV");
            //     tmp.innerHTML = html;
            //     return tmp.textContent || tmp.innerText || "";
            // }

            $(document).on('click', '.remark', function(){
                let monthly_att_id = $(this).data('id');
                let remarks = $(this).data('item');
                $("#hiddenAtt_id").val(monthly_att_id);
                $("#message-text").val(remarks);

            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

        </script>

        <script src="{{asset('js/popper.min.js?v=7.0.5')}}"></script>
    @endsection
</x-app-layout>
