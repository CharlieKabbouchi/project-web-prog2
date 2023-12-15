@extends('layout.teacher')

@section('content')
    <div class="container mt-5">
        <h2>Assignments for Class</h2>

        @if (count($assignments) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Assignment ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Submitted By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->id }}</td>
                            <td>{{ $assignment->title }}</td>
                            <td>{{ $assignment->description }}</td>
                            <td>{{ $assignment->startingDate }}</td>
                            <td>{{ $assignment->endingDate }}</td>
                            <td>
                                @foreach ($assignment->getSubmission as $submission)
                                    {{ $submission->getStudent->firstName }} {{ $submission->getStudent->lastName }} <br>
                                    (Submitted at: {{ $submission->created_at }})
                                    <br>
                                    <a href="{{ $submission->attachmentlink }}" target="_blank" class="btn btn-success">Attachment Link</a>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No assignments available for this class.</p>
        @endif
    </div>
@endsection
