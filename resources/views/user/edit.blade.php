<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('user.update', $user->id) }}" method="POST" onSubmit = "return checkPassword(this)">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="email">email</label>
                                            <input type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
                                        </div>

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="password">Type Your Password</label>
                                            <input type="password" class="form-control" name="password">
                                            <span style="color: #F24D3F !important;" id="passwordError"></span>
                                        </div>
                                        <div class="col">
                                            <label for="password">Confirm Your Password</label>
                                            <input type="password" class="form-control" name="confirmPassword">
                                            <span style="color: #F24D3F !important;" id="confirmPasswordError"></span>
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
        <script>

            function checkPassword(form) {
                let password = form.password.value;
                let confirmPassword = form.confirmPassword.value;
                if (password === ''){
                    $("#confirmPasswordError").html("");
                    $("#passwordError").html("Please enter the Password !");
                    return false;
                }
                else if (confirmPassword === ''){
                    $("#passwordError").html("");
                    $("#confirmPasswordError").html("Please enter the Confirm Password !");
                    return false;
                }
                else if (password !== confirmPassword) {
                    $("#confirmPasswordError").html("Password did not match, please try again !");
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>
    @endsection
</x-app-layout>
