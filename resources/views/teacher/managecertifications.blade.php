@extends('layout.teacher')
<title>Certificates</title>
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
        <h4 class="page-title">Certificates</h4>
    </div>
    <a href='{{ route('teacher.createCertificate') }}'>Add New Certificate</a>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="border-color: skyblue;">
                <thead>
                    <tr class="bg-primary">
                        <th>ID</th>
                        <th>Certificate Image</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $certificate)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>
                                @if ($certificate->graduationCertificateImage)
                                    <img src="{{ asset('storage/' . $certificate->graduationCertificateImage) }}" alt="Certificate Image" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $certificate->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')