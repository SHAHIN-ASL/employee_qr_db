<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="employee_id">Employee Id</label>
                                            <input type="text" class="form-control" name="employee_id">
                                        </div>
                                        <div class="col">
                                            <label for="name">Full Name *</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col">
                                            <label for="dob">Date of Birth *</label>
                                            <input type="date" class="form-control" name="dob">
                                        </div>

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="blood_group">Blood Group *</label>
                                            <input type="text" class="form-control" name="blood_group">
                                        </div>
                                        <div class="form-group col">
                                            <label for="gender">Gender *</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="">--select gender--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <label for="marital_status">Marital Status *</label>
                                            <select class="form-control" id="marital_status" name="marital_status">
                                                <option value="">--select marital status--</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="form-group col">
                                            <label for="company">Company *</label>
                                            <select class="form-control" id="company" name="company_name">
                                                <option value="">--select company--</option>
                                                <option value="ASL Systems Ltd">ASL Systems Ltd</option>
                                                <option value="Aviation Support Ltd">Aviation Support Ltd</option>
                                                <option value="Shinovi Venture">Shinovi Venture</option>
                                                <option value="Aerogon Pte. Ltd">Aerogon Pte. Ltd</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="company">Role *</label>
                                            <select class="form-control" id="company" name="employee_role">
                                                <option value="">--select role--</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="name">Department *</label>
                                            <input type="text" class="form-control" name="department">
                                        </div>
                                        <div class="col">
                                            <label for="name">Designation *</label>
                                            <input type="text" class="form-control" name="designation">
                                        </div>
                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="official_email">Office Email *</label>
                                            <input type="email" class="form-control" name="official_email">
                                        </div>
                                        <div class="col">
                                            <label for="personal_email">Personal Email *</label>
                                            <input type="email" class="form-control" name="personal_email">
                                        </div>
                                        <div class="col">
                                            <label for="official_number">Official Contact Number</label>
                                            <input type="tel" class="form-control" name="official_number">
                                        </div>
                                        <div class="col">
                                            <label for="personal_number">Personal Contact Number *</label>
                                            <input type="tel" class="form-control" name="personal_number">
                                        </div>
                                    </div>

                                    <div class="form-row pb-8">

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="">Password *</label>
                                            <input type="password" class="form-control" name="employee_password">
                                        </div>
                                        <div class="col">
                                            <label for="">Emergency Contact Name</label>
                                            <input type="text" class="form-control" name="ename">
                                        </div>
                                        <div class="col">
                                            <label for="">Emergency Contact Number</label>
                                            <input type="tel" class="form-control" name="ephone">
                                        </div>
                                        <div class="col">
                                            <label for="">Emergency Contact Relation</label>
                                            <input type="text" class="form-control" name="erelation">
                                        </div>
                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="joining_date">Joining Date *</label>
                                            <input type="date" class="form-control" name="joining_date">
                                        </div>
                                        <div class="col">
                                            <label for="joining_date">Expiry Date *</label>
                                            <input type="date" class="form-control" name="expiry_date">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="home_address">Personal Address *</label>
                                            <input type="text" class="form-control" name="home_address">
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="file">Add Employee Image: *</label>
                                                <input type="file" class="form-control-file" id="file" name="file">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="">Employee Status</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="active" name="active">
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                              </div>
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
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')

    @endsection
</x-app-layout>
