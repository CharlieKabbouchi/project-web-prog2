@extends('layout.student')

@section('content')
    <div class="row">
        <h4 class="page-title">Class Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Class Information</h5>
            <p>Class Teacher is: {{ $details['teacher'] }}</p>
            <p>Class Time : {{ $details['Time'] }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Course name</th>
                        <th>Attendance</th>
                        <th>Average Grade</th>
                        <th>Quiz Grade</th>
                        <th>Project Grade</th>
                        <th>Assignment Grade</th>
                        <th>Review</th>
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
                            <td>
                                @php
                                    $studentReview = $classReviews->where('student_id', $student->id)->first();
                                @endphp
                            
                                @if ($studentReview)
                                    {{ $studentReview->rating }}
                                @else
                                    <a href="{{ route('student.addReviewcForm', ['classId' => $classDetail->classt_id]) }}" class="btn btn-primary">Add Review for this class</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h5>Classes Materials:</h5>

            <form method="get" action="{{ route('student.viewsubmissions', ['class' => $classDetail->classt_id]) }}"
                style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary">View Submission</button>
            </form>

            <form method="get" action="{{ route('student.viewassignments', ['class' => $classDetail->classt_id]) }}"
                style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary">View Assignments</button>
            </form>

            <form method="get" action="{{ route('student.viewresources', ['class' => $classDetail->classt_id]) }}"
                style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary ">View Resource</button>
            </form>
        </div>
    </div>
@endsection
