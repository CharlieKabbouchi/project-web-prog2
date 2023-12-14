@extends('layout.admin')
<title>Admin Class Details</title>

@section('content')
    <div class="row">
        <form>
            <div class="form-group">
                <label for="courseName">Course Name:</label>
                <input type="text" class="form-control" id="courseName" name="courseName"
                    value="{{ $sclass->getCourse->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="totalCredits">Total Credits:</label>
                <input type="number" class="form-control" id="totalCredits" name="totalCredits"
                    value="{{ $sclass->getCourse->credits }}" disabled>
            </div>
            <div class="form-group">
                <label for="class Time">Class Time:</label>
                <input type="text" class="form-control" id="class time" name="class Time"
                    value="{{ $sclass->DayofWeek }}:{{ $sclass->starttime }}-{{ $sclass->endtime }} " disabled>
            </div>
            <div class="form-group">
                <label for="class Time">Teacher:</label>
                <input type="text" class="form-control" id="class Teacher" name="class Teacher"
                    value="{{ $teacherInfo->firstName }} {{ $teacherInfo->lastName }}" disabled>
            </div>
            <div class="form-group">
                <label for="class Time">Course:</label>
                <input type="text" class="form-control" id="class department" name="class department"
                    value="{{ $sclass->getCourse->name }} " disabled>
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
                                <p class="card-category">Enrolled Students</p>
                                <h4 class="card-title">{{ $students->count() }}</h4>
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
                                <p class="card-category">Average Grade</p>
                                <h4 class="card-title">{{ $averageGrade }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>Students Enrolled this CLass</h4>
        @if ($students->count() > 0)
            <table>
                <tr>
                    <th>Student Id
                    </th>
                    <th>Student First Name
                    </th>
                    <th>Student Last Name
                    </th>
                </tr>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->firstName }}</td>
                        <td>{{ $student->lastName }}</td>
                    </tr>
                @endforeach

            </table>
        @endif
    </div>
@endsection('content')
