@extends('layout.alumni')
<title>Alumni Dashboard</title>
@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Your Alumni ID: {{ $alumni->id }}</p>
    </div>
@endsection