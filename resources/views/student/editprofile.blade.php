@extends('layout.student')

@section('content')
    <div class="row">
        <h4 class="page-title">Edit Profile</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('student.updateprofile', ['id' => $student->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $student->email }}">
                </div>

                <div class="form-group">
                    <label for="image">Profile Image:</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="dateOfBirth">Date of Birth:</label>
                    <input type="date" name="dateOfBirth" class="form-control" value="{{ $student->dateOfBirth }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
@endsection