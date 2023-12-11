@extends('layout.admin')
<title>Admin Parents</title>
<style>
    .actions-column {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
    .table-bordered {
        border: 2px solid #00688B; /* Darker blue color code */
    }
 
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #00688B; /* Darker blue color code */
    }
 
    .table-bordered thead th {
        background-color: #87CEEB; /* Lighter blue color code for header background */
    }
 
   
</style>
 
@section('content')
    <div class="row">
        <h4 class="page-title">Alumnis</h4>
    </div>
   
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-primary">
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th rowspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnis as $alumni)
                        <tr >
                            <td>{{ $alumni->id }}</td>
                            <td>{{ $alumni->firstName }}</td>
                            <td>{{ $alumni->lastName }}</td>
                            <td>{{ $alumni->email }}</td>
                            <td class="actions-column">
                            <form method="get" action="{{ route('admin.viewalumni', ['alumni' => $alumni->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-rounded btn-login" value="View">
                            </form>
                            </td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        console.log($totalCreditsShouldTaken);
        console.log($totalCredits);
        </script>
@endsection('content')