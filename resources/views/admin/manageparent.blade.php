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
        <h4 class="page-title">Parents</h4>
      
    </div>
   
    <div class="row">
        <div class="table-responsive">
            <table class="table">
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
                    @foreach ($parents as $parent)
                        <tr >
                            <td>{{ $parent->id }}</td>
                            <td>{{ $parent->firstName }}</td>
                            <td>{{ $parent->lastName }}</td>
                            <td>{{ $parent->email }}</td>
                            <td class="actions-column">
                            <form method="get" action="{{ route('admin.editParent', ['parent' => $parent->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="Edit">
                            </form>
                            <form method="post" action="{{ route('admin.deleteParent',$parent->id) }}">
                                @csrf
                                 @method('POST')
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                            </td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($pparentsn>0)
            <a class="btn btn-success" href='{{route('viewpendparents')}}'>Register Pending Parents</a>
          @endif
        </div>
    </div>
@endsection('content')