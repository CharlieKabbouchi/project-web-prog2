@extends('layout.admin')
<title>Admin Teachers</title>

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.storeteacher', ['teacher' => $wteacher->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $wteacher->firstName }}" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $wteacher->lastName }}" required>
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" class="form-control" id="Gender" name="Gender" value="{{ $wteacher->Gender }}" required>
            </div>

            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" class="form-control" id="salary" name="salary" value="{{ $wteacher->salary }}" required>
            </div>

            <div class="form-group">
                <label for="email">Personal Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $wteacher->email }}" required>
            </div>

            <div class="form-group">
                <label for="image">Profile Image:</label>
                <img src="{{ asset($wteacher->image) }}" alt="Teacher Image" width="50">
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $wteacher->phone }}" required>
            </div>

            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="date" class="form-control" id="DOB" name="DOB" value="{{ $wteacher->DOB}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Register Teacher</button>
        </form>
    </div>
@endsection('content')
