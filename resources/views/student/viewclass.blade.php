@section('content')
    <div class="row">
        <h4 class="page-title">Class Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Class Information</h5>
            <p>Class Teacher is: {{ $details['teacher'] }}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course name</th>
                        <th>Attendance</th>
                        <th>Average Grade</th>
                        <th>Quiz Grade</th>
                        <th>Project Grade</th>
                        <th>Assignment Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details['classDetails'] as $classDetail)
                        <tr>
                            <td>{{ $details['course'] }}</td>
                            <td>{{ $classDetail->attendence }}</td>
                            <td>{{ $classDetail->averageGrade }}</td>
                            <td>{{ $classDetail->quizGrade }}</td>
                            <td>{{ $classDetail->projectGrade }}</td>
                            <td>{{ $classDetail->assignmentGrade }}</td>

                            {{-- <td class="actions-column">
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
                        </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
