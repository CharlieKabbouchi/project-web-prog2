@extends('layout.admin')
<title>Admin Students</title>

@section('content')
    <div class="row">
        <form method="post" action="{{ route('admin.updatestudent', ['student' => $wstudent->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstname" value="{{ $wstudent->firstName }}" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastname" value="{{ $wstudent->lastName }}" required>
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" class="form-control" id="Gender" name="Gender" value="{{ $wstudent->Gender }}" required>
            </div>

            <div class="form-group">
                <label for="Parent">Parent:</label>
                <select class="form-control" id="Parent" name="Parent" required value="{{$wstudent->getSParent->firstName}} {{$wstudent->getSParent->lastName}}">
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->firstName }} {{ $parent->lastName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Department">Department:</label>
                <select class="form-control" id="Department" name="Department" required value="{{$wstudent->getDepartment->name}}">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
         
            <div class="form-group">
                <label for="email">Profile Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $wstudent->getProfile->email }}" required>
            </div>

            <div class="form-group">
                <label for="image">Profile Image:</label>
                <input type="file" class="form-control" id="email" name="image" required>
                <img src="{{ asset($wstudent->getProfile->image) }}" alt="Student Image" width="50">
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $wstudent->getProfile->phone }}" required>
            </div>

            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="date" class="form-control" id="DOB" name="DOB" value="{{ $wstudent->getProfile->dateOfBirth}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
@endsection('content')
