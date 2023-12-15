@extends('layout.student')
<title>Add Review to Event</title>

@section('content')
        <div class="row">
            <div class="col-md-12">
                <h5>Add Review to Event</h5>

                <p>Event Title: {{ $event->title }}</p>
                <p>Event Description: {{ $event->description }}</p>

                <form method="post" action="{{ route('student.submitReviewE', ['eventId' => $event->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="description">Review Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <input class="form-control" type="number" name="rating" id="rating" min="1" max="5" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    @endsection
