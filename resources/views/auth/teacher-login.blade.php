@extends('layout.layout')
<title>Teacher Login</title>

@section('content')
    <h2>Teacher Login</h2>

    <form method="POST" action="{{ route('teacher.login') }}">
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
