@extends('layout.admin')
<title>Edit Class</title>

@section('content')
    <div class="row">
        <h4 class="page-title">Edit Class</h4>
    </div>

    <div class="row">
        <form method="post" action="{{ route('admin.updateClass', ['class' => $class->id]) }}">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <h5>Class Information</h5>

                <div class="form-group">
                    <label for="startingDate">Starting Date:</label>
                    <input type="date" class="form-control" id="startingDate" name="startingDate" value="{{ $class->startingDate }}" required>
                </div>

                <div class="form-group">
                    <label for="endingDate">Ending Date:</label>
                    <input type="date" class="form-control" id="endingDate" name="endingDate" value="{{ $class->endingDate }}" required>
                </div>

                <div class="form-group">
                    <label for="starttime">Start Time:</label>
                    <input type="time" class="form-control" id="starttime" name="starttime" value="{{ $class->starttime }}" required>
                </div>

                <div class="form-group">
                    <label for="endtime">End Time:</label>
                    <input type="time" class="form-control" id="endtime" name="endtime" value="{{ $class->endtime }}" required>
                </div>

                <div class="form-group">
                    <label for="DayofWeek">Day of Week:</label>
                    <input type="text" class="form-control" id="DayofWeek" name="DayofWeek" value="{{ $class->DayofWeek }}" required>
                </div>

              
            </div>

            <div class="col-md-6">
                <h5>Associated Information</h5>

                <div class="form-group">
                    <label for="course">Select Course:</label>
                    <select class="form-control" id="course" name="course" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ $class->course_id === $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="semester">Select Semester:</label>
                    <select class="form-control" id="semester" name="semester" required>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $class->semester_id === $semester->id ? 'selected' : '' }}>
                                {{ $semester->type }} - {{ $semester->yearBelongsTo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="teacher">Select Teacher:</label>
                    <select class="form-control" id="teacher" name="teacher" required>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $class->teacher_id === $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Class</button>
        </form>
    </div>
@endsection('content')
