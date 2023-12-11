@extends('layout.admin')
<title>Add New Class</title>

@section('content')
    <div class="row">
        <h4 class="page-title">Add New Class</h4>
    </div>

    <div class="row">
        <form method="post" action="{{ route('admin.storeClass') }}">
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
                    <label for="Day">Day of Week:</label>
                    <input type="text" class="form-control" id="Day" name="Day" required>
                </div>
                <div class="form-group">
                    <label for="abscence">Permitted Abscences:</label>
                    <input type="number" min="3" class="form-control" id="abscence" name="abscence" required>
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
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->firstName }} {{ $teacher->lastName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Class</button>
        </form>
    </div>
@endsection('content')
