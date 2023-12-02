@extends('layout.layout')

@section('content')
    <h2>Edit Class Timetable</h2>

    <form action="{{ route('class_ts.update', $class_t->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="startingDate">Starting Date:</label>
            <input type="date" name="startingDate" class="form-control" value="{{ $class_t->startingDate->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="endingDate">Ending Date:</label>
            <input type="date" name="endingDate" class="form-control" value="{{ $class_t->endingDate->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="course_id">Course:</label>
            <select name="course_id" class="form-control" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $class_t->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="semester_id">Semester:</label>
            <select name="semester_id" class="form-control" required>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $class_t->semester_id == $semester->id ? 'selected' : '' }}>
                        {{ $semester->yearBelongsTo }} - {{ $semester->type }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="teacher_id">Teacher:</label>
            <select name="teacher_id" class="form-control">
                <option value="" {{ $class_t->teacher_id == null ? 'selected' : '' }}>No Assigned Teacher</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $class_t->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->firstName }} {{ $teacher->lastName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="abscence">Abscence:</label>
            <input type="number" name="abscence" class="form-control" value="{{ $class_t->abscence }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Class Timetable</button>
    </form>
    </div>
@endsection
