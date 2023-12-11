@extends('layout.admin')
<title>Admin Alumni</title>
<style>
    /* Your custom styles here */
</style>

@section('content')
    <div class="row">
        <h4 class="page-title">Alumni Details</h4>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Alumni Information</h4>
                </div>
                <div class="card-body">
                    <p><strong>First Name:</strong> {{ $alumni->getStudent->firstName }}</p>
                    <p><strong>Last Name:</strong> {{ $alumni->getStudent->lastName }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Alumni Events</h4>
                </div>
                <div class="card-body">
                    @if ($events->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Starting Time</th>
                                    <th>Ending Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
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
                    @else
                        <p>No events found for this alumni.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
