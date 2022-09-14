
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
                                <form action="{{ url('attendance_adjustment_update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Weekend One</label>
                                            <select id="weekendOneSelect" class="form-control" name="weekendOne">
                                                <option value="">Select An Option</option>
                                                <option name="Saturday" value="Sat">Saturday</option>
                                                <option name="Sunday" value="Sun">Sunday</option>
                                                <option name="Monday" value="Mon">Monday</option>
                                                <option name="Tuesday" value="Tue">Tuesday</option>
                                                <option name="Wednesday" value="Wed">Wednesday</option>
                                                <option name="Thursday" value="Thu">Thursday</option>
                                                <option name="Friday" value="Fri">Friday</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Weekend Two</label>
                                            <select id="weekendTwoSelect" class="form-control" name="weekendTwo">
                                                <option value="">Select An Option</option>
                                                <option name="Saturday" value="Sat">Saturday</option>
                                                <option name="Sunday" value="Sun">Sunday</option>
                                                <option name="Monday" value="Mon">Monday</option>
                                                <option name="Tuesday" value="Tue">Tuesday</option>
                                                <option name="Wednesday" value="Wed">Wednesday</option>
                                                <option name="Thursday" value="Thu">Thursday</option>
                                                <option name="Friday" value="Fri">Friday</option>
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
                                    <button id="update_button_tab" type="submit" class="btn btn-success d-none">Update</button>
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

        </script>
    @endsection

</x-app-layout>
