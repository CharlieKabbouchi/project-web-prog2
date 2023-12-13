@extends('layout.student')

@section('content')

    <h2>Manage Q&A</h2>
    <h5>Questions Asked by {{ $student->firstName }} {{ $student->lastName }}</h1>
    <a href="{{ route('student.addquestion') }}">Add New Question</a>

    @if($student->questions->isNotEmpty())    
    @foreach($student->questions as $question)
        <div class="card">
            <div class="card-body">
                <p>Question Q: {{ $question->description }}</p>
                @if($question->getAnswer->isNotEmpty())
            <ul>
                @foreach($question->getAnswer as $answer)
                    <li>Answer: {{ $answer->answer }}</li>
                @endforeach
            </ul>
                @else
                    <p>No answers available yet.</p>
                 @endif
                @endforeach
    @else
        <p>No questions asked yet.</p>
    @endif
            </div>
        </div>
    @endforeach
@endsection
