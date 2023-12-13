@extends('layout.student')

@section('content')
    <div class="row">
        <h4 class="page-title">Error</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>{{ $errorMessage }}</p>
        </div>
    </div>
@endsection('content')
