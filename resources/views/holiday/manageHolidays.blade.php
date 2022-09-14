<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Manage Holiday') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Holiday</a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Manage Weekends</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="container mt-5">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="{{ route('holiday.getOwnOfficeHolidayData') }}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="form-row pb-8">
                                                                    <div class="col">
                                                                        <label for="date">Set Office Holidays ( Max 10 Lines ) : </label>
                                                                        <div class="field_wrapper">
                                                                            <div>
                                                                                <input style="width: 42%" type="text" name="holiday_name[]" placeholder="Enter Holiday Name"/><input style="width: 25%;margin-left: 1rem" type="date" name="holiday_date[]" value=""/>
                                                                                <select style="width: 25%;margin-left: .8rem" name="holiday_type[]">
                                                                                    <option value=""  style="color: #888">Select Type</option>
                                                                                    <option value="govt">Government</option>
                                                                                    <option value="office">Office Announced</option>
                                                                                </select>
                                                                            </div>
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
                                                                <a href="javascript:void(0);" class="add_button float-left"><button type="button" class="btn btn-dark">Add New line</button></a>
                                                                <hr class="mt-5">
                                                                <a href="{{route('holiday.view')}}" class="float-right"><button type="button" class="btn btn-danger mt-2 ml-1">Cancel</button></a>
                                                                <button id="update_button_tab" type="submit" class="btn btn-success float-right mt-2">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                <div class="container mt-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form action="{{ route('holiday.weekendsData') }}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="form-row pb-8">
                                                                    <div class="col">
                                                                        <label for="absent">First Weekend : </label>
                                                                        <select class="form-control" name="weekendOne">
                                                                            <option value=""  style="color: #888">Select an option</option>
                                                                            <option value="Sat" {{$weekendTab['weekendOne']=='Sat'?'selected':''}}>Saturday</option>
                                                                            <option value="Sun" {{$weekendTab['weekendOne']=='Sun'?'selected':''}}>Sunday</option>
                                                                            <option value="Mon" {{$weekendTab['weekendOne']=='Mon'?'selected':''}}>Monday</option>
                                                                            <option value="Tue" {{$weekendTab['weekendOne']=='Tue'?'selected':''}}>Tuesday</option>
                                                                            <option value="Wed" {{$weekendTab['weekendOne']=='Wed'?'selected':''}}>Wednesday</option>
                                                                            <option value="Thu" {{$weekendTab['weekendOne']=='Thu'?'selected':''}}>Thursday</option>
                                                                            <option value="Fri" {{$weekendTab['weekendOne']=='Fri'?'selected':''}}>Friday</option>
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                <div class="form-row pb-8">
                                                                    <div class="col">
                                                                        <label for="absent">Second Weekend : </label>
                                                                        <select class="form-control" name="weekendTwo">
                                                                            <option value="" style="color: #888"> Select an option</option>
                                                                            <option value="Sat" {{$weekendTab['weekendTwo']=='Sat'?'selected':''}}>Saturday</option>
                                                                            <option value="Sun" {{$weekendTab['weekendTwo']=='Sun'?'selected':''}}>Sunday</option>
                                                                            <option value="Mon" {{$weekendTab['weekendTwo']=='Mon'?'selected':''}}>Monday</option>
                                                                            <option value="Tue" {{$weekendTab['weekendTwo']=='Tue'?'selected':''}}>Tuesday</option>
                                                                            <option value="Wed" {{$weekendTab['weekendTwo']=='Wed'?'selected':''}}>Wednesday</option>
                                                                            <option value="Thu" {{$weekendTab['weekendTwo']=='Thu'?'selected':''}}>Thursday</option>
                                                                            <option value="Fri" {{$weekendTab['weekendTwo']=='Fri'?'selected':''}}>Friday</option>
                                                                        </select>
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
                                                                <a href="{{route('holiday.view')}}" class="float-right"><button type="button" class="btn btn-danger ml-1">Cancel</button></a>
                                                                <button id="update_button_tab" type="submit" class="btn btn-success float-right">Update</button>
                                                            </form>
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
            </div>
        </div>
    </div>

    @section('scripts')

        <script type="text/javascript">
            $(document).ready(function(){
                const maxField = 10;
                const addButton = $('.add_button');
                const wrapper = $('.field_wrapper');
                const fieldHTML = '<div>' +
                    '<input style="width: 42%" type="text" name="holiday_name[]" placeholder="Enter Holiday Name"/>' +
                    '<input type="date" style="width: 25%;margin-left: 1rem;margin-top: 1rem" name="holiday_date[]" value=""/>' +
                        '<select style="width: 25%;margin-left: 1rem" name="holiday_type[]">'+
                            '<option value=""  style="color: #888">Select Type</option>'+
                            '<option value="govt">Government</option>'+
                            '<option value="office">Office Announced</option>'+
                        '</select>' +
                    '<a style="text-decoration: none" href="javascript:void(0);" class="remove_button"> <i style="color: #ff4500" class="fas fa-minus-circle fa-lg"></i></a>'+
                    '</div>'; //New input field html
                let x = 1;
                $(addButton).click(function(){
                    if(x < maxField){
                        x++;
                        $(wrapper).append(fieldHTML);
                    }
                });
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
            });
        </script>
    @endsection

</x-app-layout>
