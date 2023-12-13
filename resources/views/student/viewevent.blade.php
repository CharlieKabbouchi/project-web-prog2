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
            <table class="table">
                <thead>
                    <tr>
                        <th>Alumni</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Starting Time</th>
                        <th>Ending Time</th>
                        <th>Date</th>
                        <th>Your Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $alumniName }}</td>
                        <td>{{ $eventDetails['title'] }}</td>
                        <td>{{ $eventDetails['description'] }}</td>
                        <td>{{ $eventDetails['type'] }}</td>
                        <td>{{ $eventDetails['startingTime'] }}</td>
                        <td>{{ $eventDetails['endingTime'] }}</td>
                        <td>{{ $eventDetails['time'] }}</td>

                        <td>
                            @php
                                $eventReview = $event->getReviewE->where('student_id', $student->id)->first();
                            @endphp
                        
                            @if ($eventReview)
                                {{ $eventReview->rating }}
                            @else
                                <a href="{{ route('student.addReviewE', ['eventId' => $event->id]) }}" class='btn btn-primary'>Add review to the event</a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
