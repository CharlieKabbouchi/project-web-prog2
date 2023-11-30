@extends('layout.layout')
<title>Parent Login</title>

@section('content')
<h2>Parent Login</h2>

<form method="POST" action="{{ route('parent.login') }}">
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
