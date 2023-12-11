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
        <h4 class="page-title">Assignment Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Assignment Information</h5>
            <!-- Display class information -->
            <p>Assignment of this courses are:</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Teacher</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignmentDetails as $assignment)
                        <tr>
                        <td>{{ $teacher->firstName }} {{ $teacher->lastName }}</td>
                        <td>{{ $assignment['assignmentType'] }}</td>
                        <td>{{ $assignment['startingDate'] }}</td>
                        <td>{{ $assignment['endingDate'] }}</td>
                            <td class="actions-column">
                                <form method="get" action="{{ route('student.addsubmission', ['assignment' => $assignment->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Sumbit</button>
                                </form>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
