@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alumni Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('alumni.create') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="student_id" class="col-md-4 col-form-label text-md-right">Select Student</label>
                                <div class="col-md-6">
                                    <select name="student_id" class="form-control" required>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->firstName }} {{ $student->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
