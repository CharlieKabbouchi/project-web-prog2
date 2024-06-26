@extends('layout.teacher')
<title>Add New Class</title>

@section('content')
    <div class="row">
        <h4 class="page-title">Add New Class</h4>
    </div>

    <div class="row">
        <form method="post" action="{{ route('teacher.storeClass') }}">
            @csrf

            <div class="col-md-6">
                <h5>Class Information</h5>

                <div class="form-group">
                    <label for="startingDate">Starting Date:</label>
                    <input type="date" class="form-control" id="startingDate" name="startingDate" required>
                </div>

                <div class="form-group">
                    <label for="endingDate">Ending Date:</label>
                    <input type="date" class="form-control" id="endingDate" name="endingDate" required>
                </div>

                <div class="form-group">
                    <label for="starttime">Start Time:</label>
                    <input type="time" class="form-control" id="starttime" name="starttime" required>
                </div>

                <div class="form-group">
                    <label for="endtime">End Time:</label>
                    <input type="time" class="form-control" id="endtime" name="endtime" required>
                </div>

                <div class="form-group">
                    <label for="DayofWeek">Day of Week:</label>
                    <select class="form-control" id="DayofWeek" name="DayofWeek" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <h5>Associated Information</h5>

                <div class="form-group">
                    <label for="course">Select Course:</label>
                    <select class="form-control" id="course" name="course" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="semester">Select Semester:</label>
                    <select class="form-control" id="semester" name="semester" required>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->type }} - {{ $semester->yearBelongsTo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="teacher">Select Teacher:</label>
                    <select class="form-control" id="teacher" name="teacher" required>
                            <option value="{{ $teacher->id }}">{{ $teacher->firstName }} {{ $teacher->lastName }}</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Class</button>
        </form>
    </div>
@endsection('content')
