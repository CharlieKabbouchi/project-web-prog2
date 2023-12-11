@extends('layout.student')
<title>Your Events</title>
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }

    .table-bordered {
        border: 2px solid #00688B; 
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #00688B; 
    }

    .table-bordered thead th {
        background-color: #87CEEB; 
    }
</style>

@section('content')
    <div class="row">
        <h4 class="page-title">Event applied To</h4>
    </div>
    <a href="{{ route('student.enrollToEvent') }}">Enroll to new event</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-color: skyblue;">
                <thead>
                    <tr class="bg-primary">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Starting Time</th>
                        <th>Ending Time</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventDetails as $event)
                        <tr>
                            <td>{{ $event['title']}}</td>
                            <td>{{ $event['description']}}</td>
                            <td>{{ $event['type'] }}</td>
                            <td>{{ $event['startingTime'] }}</td>
                            <td>{{ $event['endingTime'] }}</td>
                            <td>{{ $event['time'] }}</td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('student.viewevent', ['event' => $event->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">View Event</button>
                                </form>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
