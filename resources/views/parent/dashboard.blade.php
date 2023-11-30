@extends('layout.layout')
<title>Parent Dashboard</title>
@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Your Parent ID: {{ $parentId }}</p>
    </div>
@endsection