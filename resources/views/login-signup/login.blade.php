@extends('layout.layout')
<title> Login </title>
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Login124</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label"> Email </label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"> Password </label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary"> Log in </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-grid">
                                <a href="/home" class="btn btn-primary">Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
