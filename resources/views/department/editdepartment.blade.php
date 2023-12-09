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
        <h4 class="page-title">{{$department->name}} Department</h4>
    </div>
   
    <div class="row">
        <form method="post" action="{{ route('department.update', ['department' => $department->id]) }}">
            @csrf
            @method('PUT') 
    
            <div class="form-group">
                <label for="name">Department Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
            </div>
    
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $department->location }}" required>
            </div>
    
            <div class="form-group">
                <label for="totalCredits">Total Credits:</label>
                <input type="number" class="form-control" id="totalCredits" name="totalCredits" value="{{ $department->totalCredits }}" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Update Department</button>
        </form>
    </div>

   
    </div>
                   
@endsection('content')
