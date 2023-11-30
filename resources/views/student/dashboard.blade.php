@extends('layout.layout')
<title>Student Dashboard</title>
@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Your Student ID: {{ $student->id }}</p>
    </div>
@endsection