@extends('layout.admin')

@section('content')
    <div class="row">
        <h4 class="page-title">Alumni Information</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Alumni Details</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Graduation Year</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                   
                        <tr>
                            <td>{{ $alumni->id }}</td>
                            <td>{{ $alumni->graduationYear }}</td>
                            <td>{{ $alumni->student_id }}</td>
                            <td>{{ $alumni->getStudent->firstName }} {{ $alumni->getStudent->lastName }}</td>
                            <td>{{ $alumni->email }}</td>
                        </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Events</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->type }}</td>
                            <td>{{ $event->time }}</td>
                            <td>{{ $event->startingtime }}</td>
                            <td>{{ $event->endingtime }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
