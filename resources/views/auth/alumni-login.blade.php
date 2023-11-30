@extends('layout.layout')
<title>Alumni Login</title>

@section('content')
    <h2>Alumni Login</h2>

    <form method="POST" action="{{ route('alumni.login') }}">
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
