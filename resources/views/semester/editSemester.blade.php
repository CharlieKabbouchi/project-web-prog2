@extends('layout.admin')
<title>Edit Semester</title>

@section('content')
<div class="row">
    <form method="post" action="{{ route('admin.updatesemester', ['semester' => $semester->id]) }}">
        @csrf
        @method('PUT') 

        <div class="form-group">
            <label for="yearBelongsTo">Year Belongs To:</label>
            <input type="text" class="form-control" id="yearBelongsTo" name="yearBelongsTo" value="{{ $semester->yearBelongsTo }}" required>
        </div>

        <div class="form-group">
            <label for="startingDate">Starting Date:</label>
            <input type="date" class="form-control" id="startingDate" name="startingDate" value="{{ $semester->startingDate }}" required>
        </div>

        <div class="form-group">
            <label for="endingDate">Ending Date:</label>
            <input type="date" class="form-control" id="endingDate" name="endingDate" value="{{ $semester->endingDate }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $semester->type }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Semester</button>
    </form>
</div>
@endsection('content')
