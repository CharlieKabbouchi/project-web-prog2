@extends('layout.admin')
<title>Admin Courses</title>

@section('content')
    <div class="row">
        <form>
            <div class="form-group">
                <label for="name">Course Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="totalCredits">Total Credits:</label>
                <input type="number" class="form-control" id="totalCredits" name="totalCredits" value="{{ $course->credits }}" disabled>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Students</p>
                                <h4 class="card-title">{{ $studentNumbers}}</h4>
                           
                            </div> 
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Teachers</p>
                                <h4 class="card-title">{{ $numberTeachers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Departments</p>
                                <h4 class="card-title">{{ $numberDeps }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>Teachers</h4>
        @if ($teachers->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Teacher Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->firstName }} {{$teacher->lastName}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No teachers found for this course.</p>
        @endif
    </div>

    <div class="row">
        <h4>Departments</h4>
        @if ($departments->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Department Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>This course is not associated with any department.</p>
        @endif
    </div>
    @endsection('content')
