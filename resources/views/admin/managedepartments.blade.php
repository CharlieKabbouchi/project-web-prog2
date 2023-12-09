@extends('layout.admin')
<title>Admin Departments</title>

@section('content')
    <div class="row">
        <h4 class="page-title">Departments</h4>
    </div>
    <a href='{{ route('addDepartment') }}'>Add New Department</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-primary">
                        <th>Name</th>
                        <th>Location</th>
                        <th>Total Credits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deps as $dep)
                        <tr >
                            <td>{{ $dep->name }}</td>
                            <td>{{ $dep->location }}</td>
                            <td>{{ $dep->totalCredits }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
