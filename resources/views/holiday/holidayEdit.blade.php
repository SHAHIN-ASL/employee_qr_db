
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Holiday').' '.'-'.' '.date('Y') }}
                </h2>
            </div>
{{--            <div class="col-md-6">--}}
{{--                <a href="{{route('holiday.manage')}}" style="float: right;text-decoration: none"><i class="fas fa-cog"></i> Manage Holiday</a>--}}
{{--            </div>--}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route('holiday.update') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Holiday name</label>
                                            <input id="entryDate" type="text" class="form-control" name="holiday_name" value="{{$getHolidayDetails[0]->holiday_name}}">
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Holiday Category</label>
                                            <select class="form-control" name="holiday_type">
                                                <option value=""  style="color: #888">Select Category</option>
                                                <option value="govt" {{$getHolidayDetails[0]->holiday_type =='govt'?'selected':''}}>Government</option>
                                                <option value="office" {{$getHolidayDetails[0]->holiday_type =='office'?'selected':''}}>Office Announced</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Holiday Date</label>
                                            <input id="entryDate" type="date" class="form-control" name="holiday_date" value="{{$getHolidayDetails[0]->holiday_date}}">
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
                                    <input type="hidden" name="id" value="{{$getHolidayDetails[0]->id}}">
                                    <a href="{{route('holiday.view')}}" class="float-right"><button type="button" class="btn btn-danger ml-1">Cancel</button></a>
                                    <button type="submit" class="btn btn-success float-right">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @section('scripts')

        <script>

        </script>
    @endsection

</x-app-layout>
