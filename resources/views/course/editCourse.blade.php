@extends('layout.admin')
<title>Admin Courses</title>

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.updateCourse', ['course' => $course->id]) }}">
            @csrf
            @method('PUT') 

            <div class="form-group">
                <label for="name">Course Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}" required>
            </div>

            <div class="form-group">
                <label for="credits">Credits:</label>
                <input type="number" class="form-control" id="credits" name="credits" value="{{ $course->credits }}" required>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control" id="department" name="department">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $course->getDepartment->contains($department->id) ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <select class="form-control" id="semester" name="semester">
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ $course->getSemester->contains($semester->id) ? 'selected' : '' }}>
                            {{ $semester->type }} - {{ $semester->yearBelongsTo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection('content')
