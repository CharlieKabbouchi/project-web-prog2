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
												<h4 class="card-title">5(query)</h4>
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
												<h4 class="card-title">150(query)</h4>
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
												<h4 class="card-title">200(query)</h4>
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
												<h4 class="card-title">200(query)</h4>
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
										<canvas id="statisticsChart"></canvas>
									</div>
									<div id="myChartLegend"></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Users Percentage</h4>
									<p class="card-category">
									Users percentage this month</p>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="usersChart"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					
			@endsection('content')

			