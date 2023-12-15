@extends('layout.teacher')
<title>Add New Assignment</title>

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">Add New Assignment</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Attach Your Assignment</h5>

                <form method="post" action="{{ route('teacher.uploadAssignment',['classt_id'=>$classt_id]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Assignment Type</label>
                        <select class="form-control" id="title" name="title" required>
                            <option value="project">Project</option>
                            <option value="quiz">Quiz</option>
                            <option value="assignment">Assignment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="attachment">Upload file</label>
                        <input type="file" class="form-control-file" id="attachment" name="attachment" accept=".jpg, .jpeg, .png, .gif, .csv, .pdf, .doc, .docx, .ppt, .pptx" multiple required>
                    </div>

                    <div class="form-group">
                        <label for="startingDate">Starting Date and Time</label>
                        
                            <input type="datetime-local" class="form-control datetimepicker-input" data-target="#startingDate" name="startingDate" required/>

                    </div>

                    <div class="form-group">
                        <label for="endingDate">Ending Date and Time</label>
                       
                            <input type="datetime-local" class="form-control datetimepicker-input" data-target="#endingDate" name="endingDate" required/>
                    
                    </div>

                    <button type="submit" class="btn btn-primary">Add Resource</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap CSS and JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Include Bootstrap DateTimePicker CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>
    // Initialize datetime pickers
    $(function () {
        $('#startingDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        $('#endingDate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
</script>

@endsection('content')
