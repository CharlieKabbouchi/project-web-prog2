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


    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="bg-primary">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Starting Time</th>
                        <th>Ending Time</th>
                        <th>Date</th>
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
                                <form method="get" action="{{ route('student.viewEvent', ['id' => $event['id']]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">View Event</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('student.showAllEvents') }}" class="btn btn-success">Enroll to new event</a>
        </div>
    </div>
@endsection('content')
