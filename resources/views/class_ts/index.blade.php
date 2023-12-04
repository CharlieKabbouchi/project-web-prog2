@extends('layout.layout')
<title>INDEX PAGE FOR ADMIN TO EDIT</title>
@section('content')
    <h2>Class Timetables</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Teacher</th>
                <th>Max Available Abscence</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
                <tr>
                    <td>{{ $class->startingDate }}</td>
                    <td>{{ $class->endingDate }}</td>
                    <td>{{ $class->getCourse->name }}</td>
                    <td>{{ optional($class->getSemester)->yearBelongsTo }} - {{ optional($class->getSemester)->type }}</td>

                    <td>{{ $class->getTeacher ? $class->getTeacher->firstName : 'No Assigned Teacher' }}</td>
                    <td>{{ $class->abscence }}</td>
                    <td>
                        <a href="{{ route('class_ts.edit', $class->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('class_ts.destroy', $class->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this class timetable?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('class_ts.create') }}" class="btn btn-success">Create Class Timetable</a>
@endsection
