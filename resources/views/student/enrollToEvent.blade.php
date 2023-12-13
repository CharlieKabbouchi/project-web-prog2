@extends('layout.student')
<title>All Events</title>
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
        <h4 class="page-title">All Events</h4>
    </div>

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
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allEvents as $event)
                        <tr>
                            <td>{{ $event['title']}}</td>
                            <td>{{ $event['description']}}</td>
                            <td>{{ $event['type'] }}</td>
                            <td>{{ $event['startingtime'] }}</td>
                            <td>{{ $event['endingtime'] }}</td>
                            <td>{{ $event['time'] }}</td>
                            <td class="actions-column">
                                <form method="post" action="{{ route('student.enrollToEvent', ['eventId' => $event['id']]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Enroll</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
