@extends('layout.student')
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
        <h4 class="page-title">Event Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Event Information</h5>
            <a href="{{ route('student.addreviewc') }}">Add review to the event</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Alumni</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Starting Time</th>
                        <th>Ending Time</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ $detail['alumniName'] }}</td>
                            <td>{{ $detail['title'] }}</td>
                            <td>{{ $detail['description'] }}</td>
                            <td>{{ $detail['type'] }}</td>
                            <td>{{ $detail['startingTime'] }}</td>
                            <td>{{ $detail['endingTime'] }}</td>
                            <td>{{ $detail['time'] }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
