@extends('layout.admin')
<title>Admin Teachers</title>

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.updateteacher', ['teacher' => $teacher->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $teacher->firstName }}" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $teacher->lastName }}" required>
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" class="form-control" id="Gender" name="Gender" value="{{ $teacher->Gender }}" required>
            </div>

            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" class="form-control" id="salary" name="salary" value="{{ $teacher->salary }}" required>
            </div>

            <div class="form-group">
                <label for="email"> Profile Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->getProfile->email }}" required>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="{{ asset($teacher->image) }}" alt="Teacher Image" width="50">
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacher->getProfile->phone }}" required>
            </div>
           
           
            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="date" class="form-control" id="DOB" name="DOB" value="{{ $teacher->getProfile->dateOfBirth }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Teacher</button>
        </form>
    </div>
@endsection('content')
