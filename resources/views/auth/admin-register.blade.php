@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register Admin</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control" name="firstName" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control" name="lastName" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                                <div class="col-md-6">
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">Salary</label>
                                <div class="col-md-6">
                                    <input id="salary" type="number" class="form-control" name="salary" required>
                                </div>
                            </div>

                            {{-- <div class="form-email row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" required autofocus>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">password</label>
                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="password" required autofocus>
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
