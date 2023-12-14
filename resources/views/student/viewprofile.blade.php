@extends('layout.student')
<title>View Profile</title>
@section('content')
    <div class="container-fluid">
        <h4 class="page-title">User Profile</h4>
        <div class="row">
            <div class="card card-profile card-secondary">
                <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                    <div class="profile-picture">
                        <img src="{{ $student->getProfile->image }}" alt="Profile Picture">
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name">{{ $student->firstName }} {{ $student->lastName }}</div>
                        <div class="job">Student</div>
                    </div>
                </div>

            </div>
            <div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>First Name</label>
                                <p type="text" class="form-control">{{ $student->firstName }}</p>
                            </div>
                            <div class="form-group form-group-default">
                                <label>Last Name</label>
                                <p type="text" class="form-control">{{ $student->lastName }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <p type="text" class="form-control">{{ $student->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group form-group-default">
                                <label>Birth Date</label>
                                <p type="text" class="form-control">{{ $student->getProfile->dateOfBirth}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-default">
                                <label>Gender</label>
                                <p type="text" class="form-control">{{ $student->Gender }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-default">
                                <label>Phone</label>
                                <p type="text" class="form-control">{{ $student->getProfile->phone }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection