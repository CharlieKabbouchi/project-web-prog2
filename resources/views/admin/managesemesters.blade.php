@extends('layout.admin')
<title>Admin Departments</title>
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
    .table-bordered {
        border: 2px solid #00688B; /* Darker blue color code */
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #00688B; /* Darker blue color code */
    }

    .table-bordered thead th {
        background-color: #87CEEB; /* Lighter blue color code for header background */
    }

   
</style>

@section('content')
    <div class="row">
        <h4 class="page-title">Semesters</h4>
    </div>
    <a href='{{ route('admin.addSemesters') }}'>Add New Semester</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-primary">

                        <th>Academic Year</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Term</th>
                        <th rowspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sems as $sem)
                        <tr >
                            <td>{{ $sem->yearBelongsTo }}</td>
                            <td>{{ $sem->startingDate }}</td>
                            <td>{{ $sem->endingDate }}</td>
                            <td>{{ $sem->type}}</td>
                            <td class="actions-column"><form method="get" action="{{ route('admin.viewSemester', ['semester' => $sem->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="View">
                            </form>
                            
                            <form method="get" action="{{ route('admin.editSemester', ['semester' => $sem->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Edit">
                            </form>
                            <form method="post" action="{{ route('admin.deleteSemester',$sem->id) }}">
                                @csrf
                                 @method('POST')
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Delete">
                            </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
