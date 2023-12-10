@extends('layout.admin')
<title>Admin Courses</title>
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
        <h4 class="page-title">Courses</h4>
    </div>
    <a href='{{ route('admin.addCourse') }}'>Add New Courses</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-color: skyblue;">
                <thead>
                    <tr class="bg-primary">
                        <th>Name</th>
                        <th>Credits</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->credits }}</td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('admin.viewCourse', ['course' => $course->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-primary btn-rounded btn-login" value="View">
                                </form>

                                <form method="get" action="{{ route('admin.editCourse', ['course' => $course->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Edit">
                                </form>

                                <form method="post" action="{{ route('admin.deleteCourse', ['course' => $course->id]) }}">
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
