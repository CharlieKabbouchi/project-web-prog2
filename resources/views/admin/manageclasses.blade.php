@extends('layout.admin')
<title>Admin Classes</title>
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
        <h4 class="page-title">Classes</h4>
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
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $class->getCourse->name }}</td>
                            <td>{{ $class->getSemester->type }} - {{ $class->getSemester->yearBelongsTo }}</td>
                            <td>{{ $class->getTeacher->firstName }} {{ $class->getTeacher->lastName }}</td>
                            <td>{{ $class->DayofWeek }}</td>
                            <td>{{ $class->starttime }} - {{ $class->endtime }}</td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('admin.viewClass', ['class' => $class->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="View">
                                </form>

                                <form method="get" action="{{ route('admin.editClass', ['class' => $class->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="Edit">
                                </form>

                                <form method="post" action="{{ route('admin.deleteClass', ['class' => $class->id]) }}">
                                    @csrf
                                    @method('POST')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-success"href='{{ route('admin.addClass') }}'>Add New Class</a>

        </div>
    </div>
@endsection('content')
