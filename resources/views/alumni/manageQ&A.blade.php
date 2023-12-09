@extends('layout.alumni')

@section('content')

    <h2>Manage Q&A</h2>

    @foreach($questions as $question)
        <div class="card">
            <div class="card-header">
                <p>by {{ $question->getStudent->firstName }} {{ $question->getStudent->lastName }}</p>
            </div>

            <div class="card-body">
                <p>Q: {{ $question->description }}</p>

                @php
                    $answer = $question->getAnswer->first();
                @endphp

                @if ($answer)
                    <p><strong>Answer:</strong> {{ $answer->answer }}</p>
                @else
                    <form action="{{ route('alumni.submitAnswer', $question->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="answer">Your Answer:</label>
                            <input type="text" name="answer" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Answer</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

@endsection
