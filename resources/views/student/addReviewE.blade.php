@extends('layout.student')
<title>Add Review to Event</title>

@section('content')
    <div class="row">
        <h5>Add Review to Event</h5>

        <p>Event Title: {{ $event->title }}</p>
        <p>Event Description: {{ $event->description }}</p>

        <form method="post" action="{{ route('student.submitReviewE', ['eventId' => $event->id]) }}">
            @csrf
            <label for="description">Review Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="rating">Rating:</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>

            <button type="submit">Submit Review</button>
        </form>
    </div>
@endsection
