@extends('layout.teacher')

@section('content')
    <div class="row">
        <h4 class="page-title">Upload Resource</h4>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resource Information</h5>

                    <form method="post" action="{{ route('teacher.storeResource', ['classt_id' => $classt_id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="startingDate">Upload Resource</label>
                            <input type="file" class="form-control" id="file" name="file" >
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