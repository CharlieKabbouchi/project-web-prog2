@extends('layout.admin')
<title>Admin Departments</title>
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
</style>

@section('content')
    <div class="row">
        <h4 class="page-title">Departments</h4>
    </div>
    <a href='{{ route('addDepartment') }}'>Add New Department</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-color: skyblue;">
                <thead>
                    <tr class="bg-primary">
                        <th>Name</th>
                        <th>Location</th>
                        <th>Total Credits</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deps as $dep)
                        <tr >
                            <td>{{ $dep->name }}</td>
                            <td>{{ $dep->location }}</td>
                            <td>{{ $dep->totalCredits }}</td>
                           <td class="actions-column"> 
                            <form  method="get" action="{{route('admin.editdepartment',['id'=>$dep->id])}}" >@csrf<input type='submit'class="btn btn-primary btn-rounded btn-login" value='Edit'></form>
                            <form  method="get" action="{{route('admin.viewdepartment',['id'=>$dep->id])}}" >@csrf<input type='submit'class="btn btn-primary btn-rounded btn-login" value='Detail'></form></td>
                         
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
