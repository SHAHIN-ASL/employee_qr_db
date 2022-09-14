
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('holiday.getOwnOfficeHolidayData') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Set Office Holidays : </label>
                                            <div class="field_wrapper">
                                                <div>
                                                    <input style="width: 70%" type="date" name="field_name[]" value=""/> <a href="javascript:void(0);" class="add_button" title="Add field"><i style="color: #28a745" class="fas fa-plus-circle fa-lg"></i></a>
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
                                    <button id="update_button_tab" type="submit" class="btn btn-success">Update</button>
                                </form>
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
                const maxField = 10; //Input fields increment limitation
                const addButton = $('.add_button'); //Add button selector
                const wrapper = $('.field_wrapper'); //Input field wrapper
                const fieldHTML = '<div><input type="date" style="width: 70%;margin-top: 1rem" name="field_name[]" value=""/><a style="text-decoration: none" href="javascript:void(0);" class="remove_button"> <i style="color: #ff4500" class="fas fa-minus-circle fa-lg"></i></a></div>'; //New input field html
                let x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function(){
                    //Check maximum number of input fields
                    if(x < maxField){
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
    @endsection

</x-app-layout>
