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
        <h4 class="page-title">Adding Submitting</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('submit.assignment') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                <input type="hidden" name="classt_id" value="{{ $assignment->classt_id }}">
                <div class="form-group">
                    <label for="attachment">Attachment:</label>
                    <input type="file" class="form-control" id="attachment" name="attachment" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection('content')