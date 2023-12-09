@extends('layout.alumni')
    
@section('content')
    <h2>Edit Event</h2>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Event Details</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.updateEvent', $event->id) }}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" rows="3" required>{{ $event->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" name="type" class="form-control" value="{{ $event->type }}" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="date" name="time" class="form-control" value="{{ date('Y-m-d', strtotime($event->time)) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="startingtime">Starting Time:</label>
                            <input type="time" name="startingtime" class="form-control" value="{{ date('H:i', strtotime($event->startingtime)) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="endingtime">Ending Time:</label>
                            <input type="time" name="endingtime" class="form-control" value="{{ date('H:i', strtotime($event->endingtime)) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alumniName">Alumni Name:</label>
                            <input type="text" name="alumniName" class="form-control" value="{{ $alumniFirstName }} {{ $alumniLastName }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection