@extends('layout.teacher')

@section('content')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Class Information</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <p><strong>Class ID:</strong> {{ $classInfo['id'] }}</p>
                    <p><strong>Teacher:</strong> {{ $teacher->firstName }} {{ $teacher->lastName }}</p>
                    <p><strong>Course:</strong> {{ $course->name }}</p>
                    <p><strong>Semester:</strong> {{ $semester->yearBelongsTo }} {{ $semester->type }}</p>
                    <p><strong>Start Time:</strong> {{ $class['starttime']  }}</p>
                    <p><strong>End Time:</strong> {{ $class['endtime'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mb-4">Students Enrolled</h2>
        @if(count($students) > 0)
            <table class="table table-bordered table-striped" style="border-color: skyblue;">
                <thead>
                    <tr class="bg-primary">
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Attendance</th>
                        <th>Average Grade</th>
                        <th>Quiz Grade</th>
                        <th>Project Grade</th>
                        <th>Assignment Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student['id'] }}</td>
                            <td>{{ $student['firstName'] }}</td>
                            <td>{{ $student['lastName'] }}</td>
                            <td>{{ $student['pivot']['attendence'] }}</td>
                            <td>{{ $student['pivot']['averageGrade'] }}</td>
                            <td>{{ $student['pivot']['quizGrade'] }}</td>
                            <td>{{ $student['pivot']['projectGrade'] }}</td>
                            <td>{{ $student['pivot']['assignmentGrade'] }}</td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('editStudentGrades', ['class' => $class['id'], 'student' => $student['id']]) }} ">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Edit</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No students enrolled in this class.</p>
        @endif
    </div>
@endsection('content')
