@extends('layout.student')

@section('content')

    <h2>Manage Q&A</h2>
    <h5>Questions Asked by {{ $student->firstName }} {{ $student->lastName }}</h5>


    @if($questions->isNotEmpty())    
        @foreach($questions as $question)
            <div class="card">
                <div class="card-body">
                    <p>Question: {{ $question->description }}</p>
                    
                    @php
                        $answer = $question->getAnswer->first();
                    @endphp

                    @if ($answer)
                        <p><strong>Answer:</strong> {{ $answer->answer }}</p>
                    @else
                        <p>No answers available yet.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>No questions asked yet.</p>
    @endif
    <a href="{{ route('student.addquestion') }}" class="btn btn-success">Add New Question</a>
@endsection
