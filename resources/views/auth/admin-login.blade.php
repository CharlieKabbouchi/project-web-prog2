@extends('layout.layout')
<title>Admin Login</title>

@section('content')
    <h2>Admin Login</h2>

    <form method="POST" action="{{ route('admin.verify') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
@endsection
