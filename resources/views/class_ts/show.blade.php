@extends('layout.layout')
<title>Student Class Timetables</title>
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
                   
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
