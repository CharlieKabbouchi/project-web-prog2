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
        <h4 class="page-title">Pending Users</h4>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                  
                    <tr class="bg-primary">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th rowspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pusers as $puser)
                        <tr >
                            <td>{{ $puser->firstName }}</td>
                            <td>{{ $puser->lastName }}</td>
                            <td>{{ $puser->email }}</td>
                            <td>{{ $puser->phone}}</td>
                            <td class="actions-column">
                               @if($puser->type=='teacher')
                            <form method="get" action="{{ route('admin.addTeacher', ['wteacher' => $puser->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Register">
                            </form>
                            @elseif ($puser->type=='student')
                            <form method="get" action="{{ route('admin.addStudent', ['wstudent' => $puser->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Register">
                            </form>
                            @elseif ($puser->type=='parent')
                            <form method="get" action="{{ route('admin.addParent', ['wparent' => $puser->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Register">
                            </form>
                            @endif
                            <form method="post" action="{{ route('admin.deletePUser',['pending'=>$puser->id]) }}">
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