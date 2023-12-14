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
        <h4 class="page-title">Teachers</h4>
        
    </div>
   
    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="bg-primary">
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th rowspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr >
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->firstName }}</td>
                            <td>{{ $teacher->lastName }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td class="actions-column"><form method="get" action="{{ route('admin.viewTeacher', ['teacher' => $teacher->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="View">
                            </form>
                           
                            <form method="get" action="{{ route('admin.editTeacher', ['teacher' => $teacher->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="Edit">
                            </form>
                            <form method="post" action="{{ route('admin.deleteTeacher',$teacher->id) }}">
                                @csrf
                                 @method('POST')
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                            </td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($pteachersn>0)
        <a class="btn btn-success" href='{{route('viewpendteacher')}}'>Register Pending Teachers</a>
      @endif
    </div>
@endsection('content')