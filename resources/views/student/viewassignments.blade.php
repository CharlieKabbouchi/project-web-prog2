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
        <h4 class="page-title">Assignment Lists</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignmentDetails as $assignment)
                        <tr>
                            <td>{{ $assignment['assignmentType'] }}</td>
                            <td>{{ $assignment['startingDate'] }}</td>
                            <td>{{ $assignment['endingDate'] }}</td>
                            <td class="actions-column">
                                @if (!$assignment['isSubmitted'] && $assignment['isWithinDeadline'])
                                    <form method="get"
                                        action="{{ route('student.addsubmission', ['assignment' => $assignment['assignmentId']]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Sumbit</button>
                                    </form>
                                @elseif ($assignment['isSubmitted'])
                                    <p class="btn btn-success disabled" style="color: black">Submitted</p>
                                @elseif (!$assignment['isWithinDeadline'])
                                    <p>Passed Deadline</p>
                                @endif                          
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
