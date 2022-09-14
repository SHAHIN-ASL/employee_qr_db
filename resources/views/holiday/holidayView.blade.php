<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('All Holidays').' '.'-'.' '.date('Y') }}
                </h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('holiday.manage')}}" style="float: right;text-decoration: none"><i class="fas fa-cog"></i> Manage Holiday</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped" id="govt-holiday-table" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Holiday Name</th>
                            <th scope="col">Holiday Category</th>
                            <th scope="col">Holiday Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($getAllActiveHolidays))
                            @foreach ($getAllActiveHolidays as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->holiday_name }}</td>
                                    <td>{{ ($item->holiday_type == 'govt')?'Government Announced':'Office Announced'}}</td>
                                    <td>{{ date('M d - D - Y',strtotime($item->holiday_date))}}</td>
                                    <td>
                                        <a href="{{ route('holiday.edit', $item->id) }}" class="mr-1"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('holiday.destroy', $item->id) }}" class="mr-1"><i class="fas fa-trash"></i></a>
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
                $('#govt-holiday-table').DataTable();
            });
            $(".statusButton").click(function () {
                let emp_id = $(this).data('id');
                $("#hiddenAtt_status_id").val(emp_id);
                //console.log(monthly_att_id+' '+remarks)
            });
        </script>
    @endsection

</x-app-layout>
