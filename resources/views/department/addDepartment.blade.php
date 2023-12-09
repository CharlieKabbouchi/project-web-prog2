
@extends('layout.admin')
<title>Admin Departments</title>

@section('content')
<div class="row">
    <form method="post" action="{{ route('admin.storedepartment') }}">
        @csrf
       

        <div class="form-group">
            <label for="name">Department Name:</label>
            <input type="text" class="form-control" id="name" name="name"  required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location"  required>
        </div>

        <div class="form-group">
            <label for="totalCredits">Total Credits:</label>
            <input type="number" class="form-control" id="totalCredits" name="totalCredits"  required>
        </div>

        <button type="submit" class="btn btn-primary">Create Department</button>
    </form>
</div>
@endsection('content')