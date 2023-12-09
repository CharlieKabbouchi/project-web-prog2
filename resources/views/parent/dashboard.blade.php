@extends('layout.parent')
<title>Parent Dashboard</title>
@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Your Parent ID: {{ $parent->id }}</p>
    </div>
@endsection