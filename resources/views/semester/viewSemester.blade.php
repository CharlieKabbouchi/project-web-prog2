@extends('layout.admin')
<title>Admin Semesters</title>

@section('content')
    <div class="row">
        
        <form>
            <div class="form-group">
                <label for="yearBelongsTo">Year Belongs To:</label>
                <input type="text" class="form-control" id="yearBelongsTo" name="yearBelongsTo" value="{{ $semester->yearBelongsTo }}" disabled>
            </div>

            <div class="form-group">
                <label for="startingDate">Starting Date:</label>
                <input type="text" class="form-control" id="startingDate" name="startingDate" value="{{ $semester->startingDate }}" disabled>
            </div>

            <div class="form-group">
                <label for="endingDate">Ending Date:</label>
                <input type="text" class="form-control" id="endingDate" name="endingDate" value="{{ $semester->endingDate }}" disabled>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $semester->type }}" disabled>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Students</p>
                                <h4 class="card-title">{{ $studentNumbers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Classes</p>
                                <h4 class="card-title">{{ $classNumbers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Courses</p>
                                <h4 class="card-title">{{ $courseNumbers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
    </div>
@endsection('content')
