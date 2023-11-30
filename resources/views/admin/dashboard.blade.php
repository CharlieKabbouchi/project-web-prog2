@extends('layout.layout')
<title>Admin Dashboard</title>
@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Your Admin ID: {{ $admin->id }}</p>
    </div>
@endsection