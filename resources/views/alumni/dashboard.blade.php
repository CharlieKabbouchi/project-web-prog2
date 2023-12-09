@extends('layout.alumni')
<title>Alumni Dashboard</title>
@section('content')
    <h4 class="page-title">Dashboard</h4>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Department</p>
                                <h4 class="card-title"> {{ $departmentName }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-info card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-interface-6"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Graduation Year</p>
                                <h4 class="card-title"> {{ $graduationYear }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-success card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-graph"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Events Made</p>
                                <h4 class="card-title"> {{ $eventsCount }} </h4>
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
                        <div class="card-title">Event Statistics</div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id=eventChart width="50" height="40"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var eventsCount = {!! json_encode($eventsCount) !!};
        var nonEventsCount = {!! json_encode($nonEventsCount) !!};
    
        var ctx = document.getElementById('eventChart').getContext('2d');
    
        var studentChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Events Made', 'Non-Events'],
                datasets: [{
                    label: 'Number of Events',
                    data: [eventsCount, nonEventsCount],
                    backgroundColor: ['Purple', 'Blue'],
                }]
            },
            options: {
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Year'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Number of Events'
                        }
                    }
                }
            }
        });
    </script>
@endsection
