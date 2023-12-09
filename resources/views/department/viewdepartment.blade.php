@extends('layout.admin')
<title>Admin Departments</title>

@section('content')
    <div class="row">

        <form>
            <div class="form-group">
                <label for="name">Department Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}"
                    disabled>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ $department->location }}" disabled>
            </div>

            <div class="form-group">
                <label for="totalCredits">Total Credits:</label>
                <input type="number" class="form-control" id="totalCredits" name="totalCredits"
                    value="{{ $department->totalCredits }}" disabled>
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
                                <p class="card-category">Students</p>
                                <h4 class="card-title">{{ $studentNumbers }}</h4>
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
                                <p class="card-category">Teachers</p>
                                <h4 class="card-title">{{ $teacherNumbers }}</h4>
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
                                <p class="card-category">Courses</p>
                                <h4 class="card-title">{{ $courseNumbers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        @if ($department->getCourse->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Credits</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($department->getCourse as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->credits }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No courses available in this department.</p>
    @endif
    </div>
@endsection('content')
