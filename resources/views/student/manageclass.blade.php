@extends('layout.student')
<title>Your Classes</title>
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
        <h4 class="page-title">Classes Taken</h4>
    </div>
    

    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="bg-primary">
                        <th>Course</th>
                        <th>Semester</th>
                        <th>Teacher</th>
                        <th>Day of the Week</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classesDetail as $class)
                        <tr>
                            <td>{{ $class['CourseName'] }}</td>
                            <td>{{ $class['Semester']}}</td>
                            <td>{{ $class['teacher']}} </td>
                            <td>{{ $class['Day'] }}</td>
                            <td>{{$class['startingTime'] }} - {{$class['endingTime'] }} </td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('student.viewclass', ['id' => $class['classId']]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">View Class</button>
                                </form>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a class="btn btn-success"href="{{ route('student.enrollClass') }}">Enroll New Class</a>
    </div>
@endsection('content')
