
@extends('layout.admin')
<title>Admin Semesters</title>

@section('content')
<div class="row">
    <form method="post" action="{{ route('admin.storesemester') }}">
        @csrf

        <div class="form-group">
            <label for="yearBelongsTo">Year Belongs To:</label>
            <input type="text" class="form-control" id="yearBelongsTo" name="yearBelongsTo" required>
        </div>

        <div class="form-group">
            <label for="startingDate">Starting Date:</label>
            <input type="date" class="form-control" id="startingDate" name="startingDate" required>
        </div>

        <div class="form-group">
            <label for="endingDate">Ending Date:</label>
            <input type="date" class="form-control" id="endingDate" name="endingDate" required>
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Semester</button>
    </form>
</div>
@endsection('content')
