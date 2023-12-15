@extends('layout.teacher')

@section('content')
    <div class="container mt-5">
        <h2>Resources for Class</h2>

        @if(count($resources) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Resources ID</th>
                        <th>Attachment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resources as $resource)
                    <tr>
                            <td>{{ $resource->id }}</td>
                            <td><a href="{{ $resource->attachement }}" target="_blank" class="btn btn-success">Download Attachment</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No resources available for this class.</p>
        @endif
    </div>
@endsection
