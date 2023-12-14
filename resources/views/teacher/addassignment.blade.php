@extends('layout.teacher')

@section('content')
    <div class="row">
        <h4 class="page-title">Add Assignment</h4>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Assignment Information</h5>

                    <form method="post" action="{{ route('teacher.storeAssignment', ['classt_id' => $classt_id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="startingDate">Starting Date</label>
                            <input type="datetime-local" class="form-control" id="startingDate" name="startingDate" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="endingDate">Ending Date</label>
                            <input type="datetime-local" class="form-control" id="endingDate" name="endingDate" required>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')