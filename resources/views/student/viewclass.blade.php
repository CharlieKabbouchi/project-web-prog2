@extends('layout.student')
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }

    .table-bordered {
        border: 2px solid #00688B; 
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #00688B; 
    }

    .table-bordered thead th {
        background-color: #87CEEB; 
    }
</style>
@section('content')
    <div class="row">
        <h4 class="page-title">Class Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Class Information</h5>
            <!-- Display class information -->
            <p>Class Teacher is: {{ $Details['teacherName'] }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Course name</th>
                        <th>Attendance</th>
                        <th>Average Grade</th>
                        <th>Quiz Grade</th>
                        <th>Project Grade</th>
                        <th>Assignment Grade</th>
                        <th>Submission</th>
                        <th>Assignment</th>
                        <th>Resource</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Details as $detail)
                        <tr>
                            <td>{{ $detail['course']->name }}</td>
                            <td>{{ $detail['attendance'] }}</td>
                            <td>{{ $detail['averageGrade'] }}</td>
                            <td>{{ $detail['quizGrade'] }}</td>
                            <td>{{ $detail['projectGrade'] }}</td>
                            <td>{{ $detail['assignmentGrade'] }}</td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('student.viewsubmission', ['class' => $class->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">View Submission</button>
                                </form>                                
                            </td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('student.viewassignments', ['class' => $class->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">View Assignments</button>
                                </form>                                
                            </td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('student.viewresources', ['class' => $class->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">View Resource</button>
                                </form>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
