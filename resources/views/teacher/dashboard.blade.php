@extends('layout.layout')
<title>Teacher Dashboard</title>
@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Your Teacher ID: {{ $teacher->id }}</p>
    </div>
@endsection