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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped" id="employee-table" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Office Email</th>
                            <th scope="col">Office Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($employees))
                            @foreach ($employees as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->employee_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->official_email }}</td>
                                    <td>{{ $item->official_number }}</td>
                                    <td>@if($item->active) Active @else Inactive @endif</td>
                                    <td>
                                        <a href="{{ route('employee.show', $item->employee_id) }}" class="mr-1"><i class="fas fa-eye"></i></a>
                                        @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == 'admin')

                                            <a href="{{ route('employee.edit', $item->employee_id) }}" class="mr-1"><i class="fas fa-edit"></i></a>

{{--                                            <form action="{{ route('employee.destroy', $item->employee_id) }}" method="POST" style="display:inline-block">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="submit" style="border:none; background:transparent; padding: 0px;display:inline-block" ><i class="fas fa-trash"></i></button>--}}
{{--                                            </form>--}}
                                            <button class="statusButton" type="button"  data-toggle="modal" data-id="{{$item->employee_id}}" data-target="#employeeIndexModal">
                                                <i class="fas @if($item->active) fa-lock-open @else fa-lock @endif"></i>
                                            </button>
                                            <div class="modal fade" id="employeeIndexModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">User Status</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action= "{{ url ('status') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group" align="center">
                                                                    <input id="hiddenAtt_status_id" type="hidden" name="id" value="">
                                                                    <label for="message-text" class="col-form-label">Active:</label>
                                                                    <input class="form-control ml-1" type="radio" value="1" name="status" {{$item->active == 1 ? 'checked' : ''}}>
                                                                    <label for="message-text" class="col-form-label ml-4">Inactive:</label>
                                                                    <input class="form-control ml-1" type="radio" value="0" name="status" {{$item->active == 0 ? 'checked' : ''}}>
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

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready( function () {
                $('#employee-table').DataTable();
            });
            $(".statusButton").click(function () {
                let emp_id = $(this).data('id');
                $("#hiddenAtt_status_id").val(emp_id);
                //console.log(monthly_att_id+' '+remarks)
            });
        </script>
    @endsection
</x-app-layout>
