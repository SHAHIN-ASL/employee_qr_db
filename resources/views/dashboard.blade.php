<x-app-layout>
    <style>
        #myChart1{

            /*width:200px !important;*/
            height:400px !important;

        }
        .verticalLine {
            border-left: 2px solid rgba(0,0,0,0.1);
        }
        .dropbtn {
            background-color: #20c997;
            color: white;
            padding: 7px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #20c997;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 4;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: #ddd;}

        .show {display: block;}
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Clock In
                                                <hr>
                                                <span style="font-size: small;text-align: left">{{$cardsArr['date']}}</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{($cardsArr['clock_in'] != '00:00') ? date('h:i A' ,strtotime($cardsArr['clock_in'])):"00:00" }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Clock Out
                                                <hr>
                                                <span style="font-size: small;text-align: left">{{$cardsArr['date']}}</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{($cardsArr['clock_out'] != '00:00') ? date('h:i A' ,strtotime($cardsArr['clock_out'])):"00:00" }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Work Time
                                                <hr>
                                                <span style="font-size: small;text-align: left">{{$cardsArr['date']}}</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{$cardsArr['working_hours'].' '.'H'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Late
                                                <hr>
                                                <span style="font-size: small;text-align: left">{{$cardsArr['date']}}</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{$cardsArr['late'].' '.'H'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row pb-2">
                                    <div class="col">
                                        <h4 style="font-size: x-large" class="mt-2"><b>Upcoming Holiday : </b>{{ $upcomingHolidayInfo[0].' '.'['.' '.date('M d - D - Y',strtotime($upcomingHolidayInfo[1])).' '.']'}} </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-row pb-8">
                                    <div class="col">
                                        @php
                                            $userQrCode = \App\Http\Helpers\RoleCheck::getLoggedInUserQrCode(auth()->id());
                                        @endphp
                                        <img class="mt-2" height="300px" width="300px" style="margin-left: 6rem" src="{{asset('storage/'.$userQrCode)}}">
                                        <a href="{{ route('qrdownload', auth()->id()) }}" class="btn btn-success mt-2" style="margin-left: 12.5rem">Download</a>

                                    </div>
                                    <div class="verticalLine mt-4"></div>
                                    <div class="col">
                                        <canvas id="pieChart" class="mt-1"></canvas>
                                    </div>

                                    {{--                                        <div class="dropdown">--}}
                                    {{--                                          <button onclick="myFunction()" class="dropbtn">Select Range <i class="fas fa-ellipsis-h"></i></button>--}}
                                    {{--                                          <div id="myDropdown" class="dropdown-content mt-1">--}}
                                    {{--                                            <a href="">1 Month</a>--}}
                                    {{--                                            <a href="">3 Months</a>--}}
                                    {{--                                            <a href="">6 Months</a>--}}
                                    {{--                                            <a href="">1 Year</a>--}}
                                    {{--                                          </div>--}}
                                    {{--                                        </div>--}}

                                </div>
                                <hr>
                                <div class="form-row pb-8">
                                    {{--                                    <div class="dropdown ml-auto">--}}
                                    {{--                                        <button onclick="myFunctionBar()" class="dropbtn">Select Range <i class="fas fa-ellipsis-h"></i></button>--}}
                                    {{--                                        <div id="myDropdownBar" class="dropdown-content mt-1">--}}
                                    {{--                                            <a href="">1 Month</a>--}}
                                    {{--                                            <a href="">3 Months</a>--}}
                                    {{--                                            <a href="">6 Months</a>--}}
                                    {{--                                            <a href="">1 Year</a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="col">
                                        <canvas id="barChart"  height="150" class="mt-5"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            /* When the user clicks on the button,
            toggle between hiding and showing the dropdown content */
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }
            function myFunctionBar() {
                document.getElementById("myDropdownBar").classList.toggle("show");
            }

            // Close the dropdown if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script src="{{asset('js/dashboardPieChart.js?v=7.0.5')}}"></script>
        <script src="{{asset('js/dashboardBarChart.js?v=7.0.5')}}"></script>

    @endsection
</x-app-layout>
