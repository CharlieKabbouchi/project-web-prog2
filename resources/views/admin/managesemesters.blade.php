@extends('layout.admin')
<title>Admin Semesters</title>
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
</style>

@section('content')
    <div class="row">
        <h4 class="page-title">Semesters</h4>
    </div>
    <a href='{{ route('addSemester') }}'>Add New Semesters</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-color: skyblue;">
                <thead>
                    <tr class="bg-primary">
                        <th>yearBelongsTo</th>
                        <th>startingDate</th>
                        <th>endingDate</th>
                        <th>type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sems as $sem)
                        <tr >
                            <td>{{ $sem->yearBelongsTo }}</td>
                            <td>{{ $sem->startingDate }}</td>
                            <td>{{ $sem->endingDate }}</td>
                            <td>{{ $sem->type}}</td>
                           <td class="actions-column"> 
                           
                          <td> <form  method="get" action="{{route('admin.viewsemester',['id'=>$sem->id])}}" >@csrf<input type='submit'class="btn btn-primary btn-rounded btn-login" value='Detail'></form></td>
                         
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
