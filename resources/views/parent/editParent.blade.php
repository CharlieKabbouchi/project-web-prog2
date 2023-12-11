@extends('layout.admin')
<title>Admin Parents</title>

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.editparent', ['parent' => $wparent->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $wparent->firstName }}" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $wparent->lastName }}" required>
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" class="form-control" id="Gender" name="Gender" value="{{ $wparent->Gender }}" required>
            </div>

        
            <div class="form-group">
                <label for="email">Personal Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $wparent->getProfile->email }}" required>
            </div>

            <div class="form-group">
                <label for="image">Profile Image:</label>
                <input type="file" name="image">
                <img src="{{ asset($wparent->getProfile->image) }}" alt="Teacher Image" width="50">
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $wparent->getProfile->phone }}" required>
            </div>

            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="date" class="form-control" id="DOB" name="DOB" value="{{ $wparent->getProfile->DOB}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Parent</button>
        </form>
    </div>
@endsection('content')
