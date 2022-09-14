<x-app-layout>
    <x-slot name="header">

        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Employee') }}
                </h2>
            </div>
            @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
            <div class="col-md-6">
                <a href="{{ route("employee.create") }}" style="float: right;"><i class="fas fa-plus"></i> Add New</a>
            </div>
            @endif
        </div>


    </x-slot>

{{--    @php--}}
{{--    print_r(asset('storage/'.$employee->image));die()--}}
{{--    @endphp--}}




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                <div class="marig" style="padding-bottom: 17px;">
                  <h1 style="font-weight:700;">Employee Details</h1>
                 </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('storage/'.$employee->image) }}" alt="" style="height: 200px;">
                            </div>
                            <div class="col-md-6">
                                <table border="0" style="width: 100%">
                                    <tr>
                                        <td style="font-weight: 700">Employee ID</td>
                                        <td>{{ $employee->employee_id }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Name</td>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Date of Birth</td>
                                        <td>{{ $employee->dob }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Blood Group</td>
                                        <td>{{ $employee->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Marital Status</td>
                                        <td>{{ $employee->marital_status }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Company</td>
                                        <td>{{ $employee->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Department</td>
                                        <td>{{ $employee->department }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Designation</td>
                                        <td>{{ $employee->designation }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Personal Email</td>
                                        <td>{{ $employee->personal_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Official Email</td>
                                        <td>{{ $employee->official_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Personal Number</td>
                                        <td>{{ $employee->personal_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Official Number</td>
                                        <td>{{ $employee->official_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Home Address</td>
                                        <td>{{ $employee->home_address }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Joining Date</td>
                                        <td>{{ $employee->joining_date }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Expiry Date</td>
                                        <td>{{ $employee->expiry_date }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Status</td>
                                        <td>@if($employee->active) Active @else Inactive @endif</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: 700">Emergency Contact Name</td>
                                        <td>{{ $employee->ename }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Emergency Contact Number</td>
                                        <td>{{ $employee->ephone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Emergency Contact Relation</td>
                                        <td>{{ $employee->erelation }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3 text-center">
                                <img src="{{ asset('storage/'. $employee->qrimage) }}" alt="" style="height: 200px;margin-left: auto; margin-right: auto">
                                <button type="button" class="btn btn-success mt-2"><a href="{{ route('qrdownload', $employee->id) }}">Download</a></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mt-5">
                                @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
                                    <button type="button" class="btn btn-warning"><a href="{{ route('employee.edit', $employee->employee_id) }}">Edit</a></button>
                                @endif
                                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
@if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
 <section>
     <hr>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="marig" style="padding-bottom: 17px;">
            <h1 style="font-weight:700;">Attendence Details</h1>
           </div>

           <div class="container pd_right" style="" >
           <a href='/exportpdf/{{$employee->id}}' class="btn btn-success" style="float:right;margin-left: 7px;">Export to PDF</a>
         </div>

         <div class="container" style="top: 50px;"  >
           <a href='/exportexcel/{{$employee->id}}' class="btn btn-success" style="float:right;">Export to Excel</a>
         </div>

    <form >
      <div>
          <label for="month"></label>
          @if(!is_null($month))
          <input id="month" type="month" name="month" required value="{{$month}}">
          @else
          <input id="month" type="month" name="month" required value="{{date('Y-m')}}">
          @endif
         <span class="validity"></span>



         <button type="submit" class="btn btn-info">
             <i class="fa fa-search"></i> Search
         </button>



      </div>

    </form>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table table-striped" id="attendence-table" style="width:100%">
                        <thead>

                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Clock In</th>
                            <th scope="col">Clock Out</th>
                            <th scope="col">Late In</th>
                            <th scope="col">Early Out</th>
                            <th scope="col">Absent</th>
                            <th scope="col">NDays</th>
                            <th scope="col">ATT_Time</th>
                            @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
                            <th scope="col">Remarks</th>
                            @endif

                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                        @foreach ($monthly_attendence as $item)
                                <tr>
                                    <td width="20%">{{ $item->date }}</td>
                                    <td>{{ $item->clock_in }}</td>
                                    <td>{{ $item->clock_out}}</td>

                                    <?php
                                       $temp1=$item->late;
                                       $timeArray = explode(":",$temp1);
                                       $totalMin = ($timeArray[0]*60 + $timeArray[1]);
                                       $workDuration = 480; //in miniute


                                       if($totalMin < $workDuration && $totalMin >=$max_late_min)
                                       {
                                        echo '<td style="background-color:#EDFC02">',$item->late,'</td>';

                                       }
                                       else
                                       {
                                           echo '<td>',$item->late,'</td>';
                                       }
                                    ?>

                                      <?php
                                       $temp2=$item->early;
                                       $timeArray = explode(":",$temp2);
                                       $totalMin = ($timeArray[0]*60 + $timeArray[1]);
                                       $workDuration = 480; //in miniute


                                       if($totalMin < $workDuration && $totalMin >=$max_early_min)
                                       {
                                        echo '<td style="background-color:#EDFC02">',$item->early,'</td>';

                                       }
                                       else
                                       {
                                           echo '<td>',$item->early,'</td>';
                                       }
                                    ?>


                                    <?php
                                    $val1=$item->absent;
                                    if($val1==1)
                                    {
                                    echo '<td>', "No",'</td>';
                                    }
                                    elseif($val1==0)
                                    {
                                      echo '<td style="background-color:#F24D3F">', "Yes",'</td>';
                                    }
                                    ?>

                                    <td>{{ $item->ndays }}</td>
                                    <!-- <td> -->
                                     <?php
                                      $var1=$item->att_time;
                                      $timeArray = explode(":",$var1); //slice ATT time into array from string
                                      $totalMin = ($timeArray[0]*60 + $timeArray[1]); //convert into miniutes
                                      $workDuration = 480; //in miniute
                                      $avgworkduration1=475;
                                      $avgworkduration1=478;
                                      $minWorkDuration = 475; //in miniute
                                      if($totalMin < $workDuration && $totalMin >=$minWorkDuration)
                                      {
                                       echo '<td style="background-color:#FFFF33">',$item->att_time,'</td>';
                                      }
                                      elseif($totalMin < $minWorkDuration)
                                      {
                                       echo '<td style="background-color:#F24D3F">',$item->att_time,'</td>';

                                      }
                                      else{
                                        echo  '<td style="background-color:#7EDC86 " >',$item->att_time,'</td>';
                                      }
                                     ?>

                                    @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
                                     <td>
                                         <button  type="button" class="remarkAddButton btn btn-dark" data-toggle="modal" data-id="{{$item->id}}"  data-item="{{$item->remarks}}" data-target="#exampleModalCenter">
                                             +
                                         </button>
                                         @if($item->remarks != null)
                                             <span data-toggle="tooltip" data-placement="top" title="{{$item->remarks}}"> <i class="far fa-comment-dots fa-lg ml-2"></i></span>
                                         @endif
                                         <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <h5 class="modal-title" id="exampleModalLongTitle">Add Remark</h5>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                             <span aria-hidden="true">&times;</span>
                                                         </button>
                                                     </div>
                                                     <form action= "{{ url ('store') }}" method="POST">
                                                         @csrf
                                                         <div class="modal-body">
                                                             <div class="form-group">
                                                                 <input id="hiddenAtt_id" type="hidden" name="id" value="">
                                                                 <label for="message-text" class="col-form-label">Message:</label>
                                                                 <textarea class="form-control" name="remarks" id="message-text" >{{$item->remarks != null ? $item->remarks : "Write your comment here .... "}}</textarea>
                                                             </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                             <button type="submit" class="btn btn-success">Save</button>
                                                         </div>
                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                    </td>
                                    @endif
                                </tr>
                        @endforeach

                     </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

 </section>
@endif
</div>

  </div>
</div>
    @section('scripts')
        <script>
            $(".remarkAddButton").click(function () {
                let monthly_att_id = $(this).data('id');
                let remarks = $(this).data('item');
                $("#hiddenAtt_id").val(monthly_att_id);
                $("#message-text").val(remarks);
                //console.log(monthly_att_id+' '+remarks)
            });
        </script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <script src="{{asset('js/popper.min.js?v=7.0.5')}}"></script>
    @endsection

</x-app-layout>


