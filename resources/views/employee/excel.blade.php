<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Attendence PDF</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 
</head>

<style>
     table{
       border-collapse: collapse;
       windows: 100%;

     }

     th{
       text-align:center;
       /* padding:8px; */
       border:3px;
      

     }
     /* td{
      text-align:left;
       padding:8px;
       border:3px;
      

     } */
     th{
        background-color:#229954;
        color:white;

     }
  
       

</style>


 

              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
           
                <div class="p-6 bg-white border-b border-gray-200">
                        <h4 style="background-color:#229954; text-align:center; color:#fff; width:300px; margin:auto;">{{ $employee->name }}</h4>
                 <table class="table table-striped" id="attendence-table" style="width:100%">
                    
                        <thead>
                            <!-- <th>{{ $employee->name }}</th> -->
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Clock In</th>
                            <th scope="col">Clock Out</th>
                            <th scope="col">Late In</th>
                            <th scope="col">Early Out</th>
                            <th scope="col">Absent</th>
                            <th scope="col">Work_Time</th>
                            <th scope="col">NDays</th>
                            <th scope="col">ATT_Time</th>
                            <th scope="col">Remarks</th>

                          </tr>
                        </thead>


                     <tbody>
                              @php 
                                  $i=1;
                              @endphp
                             @foreach ($query as $item)
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
                                    echo '<td style="background-color:#43EB8D">', "Yes",'</td>';
                                    }
                                    elseif($val1==0)
                                    {
                                      echo '<td>', "No",'</td>'; 
                                    }
                                    ?>
                                    <td>{{ $item->work_time }}</td>
                                    <td>{{ $item->ndays }}</td>
                                    <!-- <td> -->
                                     <?php 
                                      $var1=$item->att_time;
                                      $timeArray = explode(":",$var1); //slice ATT time into array from string
                                      $totalMin = ($timeArray[0]*60 + $timeArray[1]); //convert into miniutes
                                      $workDuration = 480; //in miniute
                                      $minWorkDuration = 475; //in miniute
                                      if($totalMin < $workDuration && $totalMin >=$minWorkDuration)
                                      {
                                       echo '<td style="background-color:#F2A150">',$item->att_time,'</td>';
                                      }
                                      elseif($totalMin < $minWorkDuration)
                                      {
                                       echo '<td style="background-color:#F24D3F">',$item->att_time,'</td>';
                                      
                                      }
                                      else{
                                        echo  '<td style="background-color:#7EDC86">',$item->att_time,'</td>';
                                      }
                                     ?>
                                        
                                         
                                       
                                  
                                     <td style="width:300px;">{{$item->remarks}}</td>


                                    </tr>
                                @endforeach
                       
                     </tbody>
                        
                 </table>