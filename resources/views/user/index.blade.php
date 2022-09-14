<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('User') }} 
                </h2>
            </div>
            <div class="col-md-6">
                <a href="{{ route("user.create") }}" style="float: right;"><i class="fas fa-plus"></i> Add New</a>
            </div>
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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($users))
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        {{-- <a href="{{ route('employee.show', $item->id) }}" class="mr-1"><i class="fas fa-eye"></i></a> --}}
                                        <a href="{{ route('user.edit', $item->id) }}" class="mr-1"><i class="fas fa-edit"></i></a>
                                        
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none, background:transparent, padding: 0px;display:inline-block" ><i class="fas fa-trash"></i></button>
                                        </form>

                                        
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
        </script>
    @endsection
</x-app-layout>
