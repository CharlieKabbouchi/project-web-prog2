@extends('layout.admin')
<title>Admin Student Details</title>

@section('content')
   
        @foreach ($studentData as $data)
        <div class="row">
       <h2> {{ $data['name'] }} </h2>
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
                                    <p class="card-category">Credits</p>
                                    <h4 class="card-title">{{ $data['totalCreditsTaken'] }} / {{ $data['totalCredits'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-analytics"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">GPA</p>
                                    <h4 class="card-title">{{ $data['gpa'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fa fa-book"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Classes Taken</p>
                                    <h4 class="card-title">{{ $data['totalClassesTaken'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    <div class="row">
        <table class="table">
        <tr>
            <th>Class ID</th>
            <th>Course Name</th>
            <th>Class Time</th>
        </tr>
        @foreach($data['classes'] as $class )
        <tr>
                 <td>{{ $class->id }}</td>
                <td>{{ $class->getCourse->name }}</td>
                <td>{{ $class->DayofWeek }}: {{ $class->starttime }} - {{ $class->endtime }}</td>
            </tr>
        @endforeach
        </table>
    </div>
    @endforeach

@endsection('content')
