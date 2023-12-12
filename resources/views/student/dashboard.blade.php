@extends('layout.student')
<title>Student Dashboard</title>

@section('content')
    <h4 class="page-title">Student Dashboard</h4>

    @foreach ($studentData as $data)
        <h2>{{ $data['name'] }}</h2>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Credits</p>
                                    <h4 class="card-title">{{ $data['totalCreditsTaken'] }} / {{ $data['totalCredits'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-analytics"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">GPA</p>
                                    <h4 class="card-title">{{ $data['overallGPA'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fa fa-book"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Classes Taken</p>
                                    <h4 class="card-title">{{ $data['totalClassesTaken'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Student GPA over Semesters</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="studentChart" width="100" height="50"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>

            <script>
                var labels = {!! json_encode(array_keys($data['semesterlyGPA'])) !!};
                var values = {!! json_encode(
                    array_map(function ($semesterData) {
                        return $semesterData['gpa'];
                    }, $data['semesterlyGPA']),
                ) !!};

                console.log(labels);
                console.log(values);

                var ctx = document.getElementById('studentChart').getContext('2d');

                var studentChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels.map(label => label.toString()),
                        datasets: [{
                            label: 'GPA of Student',
                            data: values,
                            backgroundColor: 'Purple',
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Semester'
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'GPA'
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    @endforeach
@endsection
