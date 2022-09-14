<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Employee') }} 
                </h2>
            </div>
        </div>
        
        
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-7">
                                <img src="{{ asset('storage/'.$employee->image) }}" alt="" style="height: 200px;">
                            </div>
                            <div class="col-md-6 col-sm-12">
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
                                        <td style="font-weight: 700">Designation</td>
                                        <td>{{ $employee->designation }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Department</td>
                                        <td>{{ $employee->department }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Company</td>
                                        <td>{{ $employee->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Email</td>
                                        <td>{{ $employee->official_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Contact Number</td>
                                        <td>{{ $employee->official_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Joining Date</td>
                                        <td>{{ $employee->joining_date }}</td>
                                    </tr>
                                
                                    <tr>
                                        <td style="font-weight: 700">Status</td>
                                        <td>@if($employee->active) Active @else Inactive @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</x-app-layout>
