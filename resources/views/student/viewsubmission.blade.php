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
        <h4 class="page-title">Submission Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Submission aleardy sent</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>File Type</th>
                        <th>Grade</th>
                        <th>Time Of Submission</th>
                        <th>attachment Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissionDetails as $submission)
                        <tr>
                        <td>{{ $submission['fileType'] }}</td>
                        <td>{{ $submission['grade'] }}</td>
                        <td>{{ $submission['timeOfSubmission'] }}</td>
                        <td><a href="{{$submission['attachmentLink']}}" class="btn btn-primary">Download File</a></td>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
