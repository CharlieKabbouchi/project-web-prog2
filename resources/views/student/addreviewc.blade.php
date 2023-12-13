@extends('layout.student')
<title>Add Review to Class</title>

@section('content')
    <div class="row">
        <h5>Add Review to this Class</h5>
            <div class="col-md-12">
                <form method="post" action="{{ route('student.storereviewc', ['classId' => $classId]) }}">
                    @csrf
                    <label for="description">Review Description:</label>
                    <textarea name="description" id="description" rows="4" required></textarea>
    
                    <label for="rating">Rating:</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" required>
    
                    <button type="submit">Submit Review</button>
                </form>
            </div>
    </div>
@endsection