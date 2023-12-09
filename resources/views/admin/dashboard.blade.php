@extends('layout.admin')
<title>Admin Dashboard</title>

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
												<p class="card-category">Departments</p>
												<h4 class="card-title">{{$departmentCount}}</h4>
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
												<p class="card-category">Teachers</p>
												<h4 class="card-title">{{$teacherCount}}</h4>
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
												<p class="card-category">Students</p>
												<h4 class="card-title">{{$studentCount}}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Graduates</p>
												<h4 class="card-title">{{$alumniCount}}</h4>
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
										<div class="card-title">Students Statistics</div>
										
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
									<canvas id=studentChart width="100" height="50"></canvas>
									</div>
									<div id="myChartLegend"></div>
								</div>
							</div>



						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Departments Distribution</h4>
									<p class="card-category">
									Students Distribution Per Departmanets</p>
								</div>
								<div class="card-body">
									<div class="chart-container">
								<canvas id="StudentsPerDep"></canvas>
									
								</div>
								</div>
							</div>
						</div>
						</div>


						<script>
        var labels = {!! json_encode($labels) !!};
        var values = {!! json_encode($values) !!};

        var ctx = document.getElementById('studentChart').getContext('2d');

        var studentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.map(label => label.toString()),
                datasets: [{
                    label: 'Number of Students',
                    data: values,
                    backgroundColor: ['Purple'],
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
                            text: 'Number of Students'
                        }
                    }
                }
            }
        });
    </script>
					
						
						<script>
    var deps = {!! json_encode($deps) !!};
    var stds = {!! json_encode($stdnumber) !!};

    var ctx = document.getElementById('StudentsPerDep').getContext('2d');

    var studentsPerDepChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: deps,
            datasets: [{
                label: 'Number of Students',
                data: stds,
                backgroundColor: ['#22591f','#9AD5F8'],
            }]
        }, options: {
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue / total * 100).toFixed(1));
                        return `${deps[tooltipItem.index]}: ${currentValue} (${percentage}%)`;
                    }
                }
            }
        }
    });
</script>

					</div>
					
			@endsection('content')

			