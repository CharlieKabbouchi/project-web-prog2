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
        <form>
            <div class="form-group">
                <label for="name">Department Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $department->location }}" disabled>
            </div>

            <div class="form-group">
                <label for="totalCredits">Total Credits:</label>
                <input type="number" class="form-control" id="totalCredits" name="totalCredits" value="{{ $department->totalCredits }}" disabled>
            </div>
        </form>
    </div>


    <div class="row">
       
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Teachers Number</p>
                                <h4 class="card-title">{{$TeacherCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Students Number</p>
                                <h4 class="card-title">{{$StudentCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Courses Number</p>
                                <h4 class="card-title">{{$CourseCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="border-color: skyblue;">
                    <thead>
                        <tr class="bg-primary">
                            <th>Name</th>
                            <th>Number of Credits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($department->getCourse as $course)
                            <tr >
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->credits }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    </div>
                   
@endsection('content')
