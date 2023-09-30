@extends('layout.layout')
<title> Website </title>


@section('content')
    <h1>Welcome to the homepage</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('user'))
        <h1>Welcome {{ Session::get('user')->name }}</h1>
    @endif
@endsection
