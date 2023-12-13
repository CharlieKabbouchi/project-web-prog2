@extends('layout.student')

@section('content')
    <h2>Add New Question</h2>
    <form action="{{ route('student.storequestion') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Question Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Q</button>
    </form>
@endsection
