@extends('layout.teacher')
<title>Add New Resource</title>

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">Add New Resource</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Attach Your Resource Here</h5>

                <form method="post" action="{{ route('teacher.uploadResource',['classt_id'=>$classt_id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="attachment">Upload file</label>
                        
                        <input type="file" class="form-control-file" id="attachment" name="attachment" accept=".jpg, .jpeg, .png, .gif, .csv, .pdf, .doc, .docx, .ppt, .pptx" multiple required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Resource</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')
