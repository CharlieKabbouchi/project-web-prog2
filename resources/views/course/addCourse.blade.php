@extends('layout.admin')
<title>Admin Courses</title>

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.storeCourse') }}">
            @csrf

            <div class="form-group">
                <label for="name">Course Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="credits">Credits:</label>
                <input type="number" class="form-control" id="credits" name="credits" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>
    </div>
@endsection('content')
