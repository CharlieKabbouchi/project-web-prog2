@extends('layout.teacher')
<title>Add New Certificate</title>

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">Add New Certificate</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Certificate Information</h5>

                <form method="post" action="{{ route('teacher.storeCertificate') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="certificateImage">Upload Image</label>
                        <input type="file" class="form-control-file" id="certificateImage" name="certificateImage">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Certificate</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')
