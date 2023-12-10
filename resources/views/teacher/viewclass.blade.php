@extends('layout.teacher')

@section('content')
    <div class="row">
        <h4 class="page-title">Class Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Class Information</h5>
            <!-- Display class information -->

            <h5>Enrolled Students</h5>
            <p>Number of Enrolled Students: {{ $numEnrolledStudents }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Attendance</th>
                        <th>Average Grade</th>
                        <th>Quiz Grade</th>
                        <th>Project Grade</th>
                        <th>Assignment Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gradeDetails as $detail)
                        <tr>
                            <td>{{ $detail['student']->firstName }} {{ $detail['student']->lastName }}</td>
                            <td>{{ $detail['attendance'] }}</td>
                            <td>{{ $detail['averageGrade'] }}</td>
                            <td>{{ $detail['quizGrade'] }}</td>
                            <td>{{ $detail['projectGrade'] }}</td>
                            <td>{{ $detail['assignmentGrade'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
