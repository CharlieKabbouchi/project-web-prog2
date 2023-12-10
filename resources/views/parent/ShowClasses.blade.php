@extends('layout.parent')

@section('content')
    @foreach ($students as $student)
        <h3>Classes for Student: {{ $student->firstName }} {{ $student->lastName }}</h3>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">List of Classes</div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Average Grade</th>
                                    <th>Quiz Grade</th>
                                    <th>Project Grade</th>
                                    <th>Assignment Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes[$student->id] as $class)
                                <tr>
                                    <td>{{ $class->getCourse->name }}</td>
                                    <td>{{ $class->startingDate }}</td>
                                    <td>{{ $class->endingDate }}</td>
                                    <td>{{ $class->starttime }}</td>
                                    <td>{{ $class->endtime }}</td>
                                    <td>{{ $class->pivot->averageGrade }}</td>
                                    <td>{{ $class->pivot->quizGrade }}</td>
                                    <td>{{ $class->pivot->projectGrade }}</td>
                                    <td>{{ $class->pivot->assignmentGrade }}</td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
