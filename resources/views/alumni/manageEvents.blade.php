@extends('layout.alumni')

@section('content')
    <h2>Manage Events</h2>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">List of Events</div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Time</th>
                                <th>Starting Time</th>
                                <th>Ending Time</th>
                                <th>Alumni Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->type }}</td>
                                    <td>{{ $event->time }}</td>
                                    <td>{{ date('h:i A', strtotime($event->startingtime)) }}</td>
                                    <td>{{ date('h:i A', strtotime($event->endingtime)) }}</td>
                                    <td>{{ $alumniFirstName }} {{ $alumniLastName }}</td>
                                    <td>
                                        <a href="{{ route('alumni.editEvent', $event->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('alumni.deleteEvent', $event->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('alumni.createEvent') }}" class="btn btn-success">Create New Event</a>
                </div>
            </div>
        </div>
    </div>
@endsection
