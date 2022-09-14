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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
