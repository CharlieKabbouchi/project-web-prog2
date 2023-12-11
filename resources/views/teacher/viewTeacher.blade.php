@extends('layout.admin')
<title>Admin Teacher Details</title>

@section('content')
    <div class="row">
        <form>
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $teacherInfo->firstName }}" disabled>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $teacherInfo->lastName }}" disabled>
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" class="form-control" id="Gender" name="Gender" value="{{ $teacherInfo->Gender }}" disabled>
            </div>

            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="text" class="form-control" id="salary" name="salary" value="{{ $teacherInfo->salary }}" disabled>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $teacherInfo->email }}" disabled>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacherInfo->getProfile->phone }}" disabled>
            </div>

            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="Date" class="form-control" id="DOB" name="DOB" value="{{ $teacherInfo->getProfile->dateOfBirth }}" disabled>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <img src="{{ asset($teacherInfo->getProfile->image) }}" alt="Teacher Image" width="100">
            </div>
        </form>
    </div>

    <div class="row">
        <h4>Classes Taught</h4>
        @if ($teacherInfo->getClassT->count() > 0)
            <table>
                <tr>
                    <th>Class ID</th>
                    <th>Course Name</th>
                    <th>Class Time</th>
                </tr>
                @foreach ($teacherInfo->getClassT as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>{{ $class->getCourse->name }}</td>
                        <td>{{ $class->DayofWeek }}: {{ $class->starttime }} - {{ $class->endtime }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No classes taught by this teacher.</p>
        @endif
    </div>

    <div class="row">
        <h4>Certificates</h4>
        @if ($teacherInfo->getCertificate->count() > 0)
            <table>
                <tr>
                    <th>Certificate ID</th>
                    <th>Certificate Description</th>
                </tr>
                @foreach ($teacherInfo->getCertificate as $certificate)
                    <tr>
                        <td>{{ $certificate->id }}</td>
                        <td>{{ $certificate->description }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No certificates for this teacher.</p>
        @endif
    </div>
@endsection('content')
