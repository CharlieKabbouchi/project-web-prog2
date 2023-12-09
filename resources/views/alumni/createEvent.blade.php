@extends('layout.alumni')

@section('content')
    <h2>Create New Event</h2>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Event Details</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.storeEvent') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" name="type" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="date" name="time" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="startingtime">Starting Time:</label>
                            <input type="time" name="startingtime" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="endingtime">Ending Time:</label>
                            <input type="time" name="endingtime" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
