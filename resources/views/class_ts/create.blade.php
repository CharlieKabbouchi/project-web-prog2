@extends('layout.layout')
<title>Create Class Timetables</title>
@section('content')
    <h1>Create Class Timetable</h1>
    <form method="post" action="{{ route('class_ts.store') }}">
        @csrf
        <label for="startingDate">Starting Date:</label>
        <input type="date" id="startingDate" name="startingDate" required>
        <br>

        <label for="endingDate">Ending Date:</label>
        <input type="date" id="endingDate" name="endingDate" required>
        <br>
    
        <div class="form-group">
            <label for="course_id">Select Course:</label>
            <select class="form-control" id="course_id" name="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
    
        <div class="form-group">
            <label for="semester_id">Select Semester:</label>
            <select class="form-control" id="semester_id" name="semester_id">
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->type }} {{ $semester->yearBelongsTo }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="form-group">
            <label for="teacher_id">Select Teacher:</label>
            <select class="form-control" id="teacher_id" name="teacher_id">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->firstName }} {{$teacher->lastName }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <label for="abscence">Max Abscence:</label>
        <input type="number" id="abscence" name="abscence" required>
        <br><br>
        <button type="submit">Create Class Timetable</button>
    </form>
@endsection
