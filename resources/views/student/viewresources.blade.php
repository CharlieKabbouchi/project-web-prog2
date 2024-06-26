@extends('layout.student')
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }

    .table-bordered {
        border: 2px solid #00688B; 
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #00688B; 
    }

    .table-bordered thead th {
        background-color: #87CEEB; 
    }
</style>
@section('content')
    <div class="row">
        <h4 class="page-title">Resources Are</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Attachment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resourceDetails as $resource)
                        <tr>
                        <td>{{ $resource['teacherName'] }}</td>
                         <td><a href="{{$resource['attachment']}}" target="_blank" class="btn btn-primary">Download File</a></td>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
