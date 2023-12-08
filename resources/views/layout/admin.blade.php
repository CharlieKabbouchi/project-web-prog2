<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('assets/img/favicon.ico')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Montserrat:100,200,300,400,500,600,700,800,900"]},
			custom: {"families":["Flaticon", "LineAwesome"], urls: ["{{asset('assets/css/fonts.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/ready.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header">
				<!--
					Tip 1: You can change the background color of the logo header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
				-->
				<a href="{{route('admin.dashboard')}}" class="big-logo">
					<img src="{{asset('assets/img/logoresponsive.png')}}" alt="logo img" class="logo-img">
				</a>
				
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="la la-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue">
				<!--
					Tip 1: You can change the background color of the navbar header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
				-->
				<div class="container-fluid">
					<div class="navbar-minimize">
						<button class="btn btn-minimize btn-rounded">
							<i class="la la-navicon"></i>
						</button>
					</div>
					
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="flaticon-search-1"></i>
							</a>
						</li>
						
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flaticon-alarm"></i>
								<span class="notification">3</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													New user registered
												</span>
												<span class="time">5 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
											<div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-img"> 
												<img src="{{asset('assets/img/profile2.jpg')}}" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
											<div class="notif-content">
												<span class="block">
													Farrah liked Admin
												</span>
												<span class="time">17 minutes ago</span> 
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="la la-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{asset('assets/img/profile.jpg')}}" alt="image profile" width="36" class="img-circle"></a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="{{asset('assets/img/profile.jpg')}}" alt="image profile"></div>
										<div class="u-text">
											<h4>$admin->firstname</h4>
										</div>
									</div>
								</li>
								
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">
			<!--
				Tip 1: You can change the background color of the sidebar using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
				Tip 2: you can also add an image using data-image attribute
			-->
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="photo">
							<img src="{{asset('assets/img/profile.jpg')}}" alt="image profile">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									$admin->firstName
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="{{route('viewprofile',['id'=>1])}}">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="{{route('editprofile',['id'=>1])}}">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="{{route('admin.dashboard')}}">
								<i class="flaticon-home"></i>
								<p>Dashboard</p>
								<span class="badge badge-count">5</span>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="la la-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Manage Assets</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageDepartments')}}">
								<i class="flaticon-layers"></i>
								<p>Departments</p>
                                <span class="caret"></span>
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageSemesters')}}">
								<i class="flaticon-layers"></i>
								<p>Semesters</p>
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageCourses')}}">
								<i class="flaticon-layers"></i>
								<p>Courses</p>
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageClasses')}}">
								<i class="flaticon-layers"></i>
								<p>Classes</p>
							</a>
						</li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="la la-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Manage Users</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageTeachers')}}">
								<i class="flaticon-agenda-1"></i>
								<p>Teachers</p>
								
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageStudents')}}">
								<i class="flaticon-agenda-1"></i>
								<p>Students</p>
								
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageAlumnis')}}">
								<i class="flaticon-agenda-1"></i>
								<p>Alumnis</p>
								
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageParents')}}">
								<i class="flaticon-agenda-1"></i>
								<p>Parents</p>
								
							</a>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="{{route('admin.manageAdmins')}}">
								<i class="flaticon-agenda-1"></i>
								<p>Admins</p>
								
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="{{route('logout')}}">
								<i class="flaticon-agenda-1"></i>
								<p>Logout</p>
							</a>
						</li>
					

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                @yield('content')
				<!-- <div class="container-fluid">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4>
						<div class="btn-group btn-group-page-header ml-auto">
							<button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-ellipsis-h"></i>
							</button>
							<div class="dropdown-menu">
								<div class="arrow"></div>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Separated link</a>
							</div>
						</div>
					</div>
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
												<p class="card-category">Visitors</p>
												<h4 class="card-title">1,294</h4>
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
												<p class="card-category">Subscribers</p>
												<h4 class="card-title">1303</h4>
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
												<p class="card-category">Sales</p>
												<h4 class="card-title">$ 1,345</h4>
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
												<p class="card-category">Order</p>
												<h4 class="card-title">576</h4>
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
										<div class="card-title">Users Statistics</div>
										<div class="card-tools">
											<a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
												<span class="btn-label">
													<i class="la la-pencil"></i>
												</span>
												Export
											</a>
											<a href="#" class="btn btn-info btn-border btn-round btn-sm">
												<span class="btn-label">
													<i class="la la-print"></i>
												</span>
												Print
											</a>
										</div>
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
					<div class="row row-card-no-pd">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<h4 class="card-title">Users Geolocation</h4>
										<div class="card-tools">
											<a href="#" class="btn btn-primary btn-icon-only"><span class="icon flaticon-down-arrow"></span></a>
											<a href="#" class="btn btn-primary btn-icon-only"><span class="icon flaticon-repeat"></span></a>
											<a href="#" class="btn btn-primary btn-icon-only"><span class="icon flaticon-cross"></span></a>
										</div>
									</div>
									<p class="card-category">
									Map of the distribution of users around the world</p>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="table-responsive table-hover table-sales">
												<table class="table">
													<tbody>
														<tr>
															<td>
																<div class="flag">
																	<img src="../assets/img/flags/id.png" alt="indonesia">
																</div>
															</td>
															<td>Indonesia</td>
															<td class="text-right">
																2.320
															</td>
															<td class="text-right">
																42.18%
															</td>
														</tr>
														<tr>
															<td>
																<div class="flag">
																	<img src="../assets/img/flags/us.png" alt="united states">
																</div>
															</td>
															<td>USA</td>
															<td class="text-right">
																240
															</td>
															<td class="text-right">
																4.36%
															</td>
														</tr>
														<tr>
															<td>
																<div class="flag">
																	<img src="../assets/img/flags/au.png" alt="australia">
																</div>
															</td>
															<td>Australia</td>
															<td class="text-right">
																119
															</td>
															<td class="text-right">
																2.16%
															</td>
														</tr>
														<tr>
															<td>
																<div class="flag">
																	<img src="../assets/img/flags/ru.png" alt="russia">
																</div>
															</td>
															<td>Russia</td>
															<td class="text-right">
																1.081
															</td>
															<td class="text-right">
																19.65%
															</td>
														</tr>
														<tr>
															<td>
																<div class="flag">
																	<img src="../assets/img/flags/cn.png" alt="china">
																</div>
															</td>
															<td>China</td>
															<td class="text-right">
																1.100
															</td>
															<td class="text-right">
																20%
															</td>
														</tr>
														<tr>
															<td>
																<div class="flag">
																	<img src="../assets/img/flags/br.png" alt="brazil">
																</div>
															</td>
															<td>Brasil</td>
															<td class="text-right">
																640
															</td>
															<td class="text-right">
																11.63%
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-md-6">
											<div class="mapcontainer">
												<div id="map-example" class="vmap"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row row-card-no-pd">
						<div class="col-md-4 mt-3 mb-3">
							<div class="card">
								<div class="card-body">
									<p class="fw-mediumbold mt-1">My Balance</p>
									<h4 class="text-primary"><b>$ 3,018</b></h4>
									<a href="#" class="btn btn-primary btn-full text-left mt-3 mb-3"><i class="la la-plus"></i> Add Balance</a>
								</div>
								<div class="card-footer mt-auto">
									<ul class="nav">
										<li class="nav-item"><a class="btn btn-default btn-link" href="#"><i class="la la-history"></i> History</a></li>
										<li class="nav-item ml-auto"><a class="btn btn-default btn-link" href="#"><i class="la la-refresh"></i> Refresh</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-5 mt-3 mb-3">
							<div class="card">
								<div class="card-body">
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted">Profit</span>
											<span class="text-muted fw-bold"> $3K</span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-success" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="78%"></div>
										</div>
									</div>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted">Orders</span>
											<span class="text-muted fw-bold"> 576</span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="65%"></div>
										</div>
									</div>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted">Tasks Complete</span>
											<span class="text-muted fw-bold"> 70%</span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="70%"></div>
										</div>
									</div>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted">Open Rate</span>
											<span class="text-muted fw-bold"> 60%</span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="60%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 mt-3 mb-3">
							<div class="card card-stats">
								<div class="card-body">
									<p class="fw-mediumbold mt-1">Statistic</p>
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center icon-warning">
												<i class="la la-pie-chart text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Number</p>
												<h4 class="card-title">150GB</h4>
											</div>
										</div>
									</div>
									<hr/>
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-heart-o text-primary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Followers</p>
												<h4 class="card-title">+45K</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="card card-tasks">
								<div class="card-header ">
									<div class="card-head-row">
										<h4 class="card-title">Tasks</h4>
										<div class="card-tools">
											<ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="pills-home" data-toggle="pill" href="#pills-home" role="tab" aria-selected="true">Today</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="pills-profile" data-toggle="pill" href="#pills-profile" role="tab" aria-selected="false">Week</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="pills-contact" data-toggle="pill" href="#pills-contact" role="tab" aria-selected="false">Month</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body ">
									<div class="table-full-width">
										<table class="table">
											<thead>
												<tr>
													<th>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input  select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</th>
													<th>Task</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input task-select" type="checkbox">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</td>
													<td>Planning new project structure</td>
													<td class="td-actions text-center">
														<div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link btn-primary">
																<i class="la la-edit"></i>
															</button>
															<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger">
																<i class="la la-times"></i>
															</button>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input task-select" type="checkbox">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</td>
													<td>Update Fonts</td>
													<td class="td-actions text-center">
														<div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link btn-primary">
																<i class="la la-edit"></i>
															</button>
															<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger">
																<i class="la la-times"></i>
															</button>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input task-select" type="checkbox">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</td>
													<td>Add new Post
													</td>
													<td class="td-actions text-center">
														<div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link btn-primary">
																<i class="la la-edit"></i>
															</button>
															<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger">
																<i class="la la-times"></i>
															</button>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check">
															<label class="form-check-label">
																<input class="form-check-input task-select" type="checkbox">
																<span class="form-check-sign"></span>
															</label>
														</div>
													</td>
													<td>Finalise the design proposal</td>
													<td class="td-actions text-center">
														<div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link btn-primary">
																<i class="la la-edit"></i>
															</button>
															<button type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger">
																<i class="la la-times"></i>
															</button>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer ">
									<div class="stats">
										<i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Task Progress</h4>
								</div>
								<div class="card-body">
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
								</div>
								<div class="card-footer">
									<div class="legend"><i class="la la-circle text-primary"></i> Completed</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-round">
								<div class="card-body">
									<div class="card-title">Suggested People</div>
									<div class="card-list">
										<div class="item-list">
											<img src="../assets/img/jm_denis.jpg" alt="denis" class="small-pic">
											<div class="info-user ml-3">
												<div class="username">Jimmy Denis</div>
												<div class="status">Graphic Designer</div>
											</div>
											<a href="#" class="btn btn-add">
												<i class="la la-plus"></i>
											</a>
										</div>
										<div class="item-list">
											<img src="../assets/img/chadengle.jpg" alt="chad" class="small-pic">
											<div class="info-user ml-3">
												<div class="username">Chad</div>
												<div class="status">CEO Zeleaf</div>
											</div>
											<a href="#" class="btn btn-add">
												<i class="la la-plus"></i>
											</a>
										</div>
										<div class="item-list">
											<img src="../assets/img/mlane.jpg" alt="john doe" class="small-pic">
											<div class="info-user ml-3">
												<div class="username">Jhon doe</div>
												<div class="status">Content Writer</div>
											</div>
											<a href="#" class="btn btn-add">
												<i class="la la-plus"></i>
											</a>
										</div>
										<div class="item-list">
											<img src="../assets/img/talha.jpg" alt="talha" class="small-pic">
											<div class="info-user ml-3">
												<div class="username">Talha</div>
												<div class="status">Front End Designer</div>
											</div>
											<a href="#" class="btn btn-add">
												<i class="la la-plus"></i>
											</a>
										</div>
										<div class="item-list">
											<img src="../assets/img/sauro.jpg" alt="sauro" class="small-pic">
											<div class="info-user ml-3">
												<div class="username">Sauro</div>
												<div class="status">Back End Developer</div>
											</div>
											<a href="#" class="btn btn-add">
												<i class="la la-plus"></i>
											</a>
										</div>
										<div class="item-list">
											<img src="../assets/img/arashmil.jpg" alt="arash mil" class="small-pic">
											<div class="info-user ml-3">
												<div class="username">Arash Mil</div>
												<div class="status">Content Writer</div>
											</div>
											<a href="#" class="btn btn-add">
												<i class="la la-plus"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
					</div>
					</div>
				</div>
    -->
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" >
									Instituation Name
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2023, made with <i class="la la-heart heart text-danger"></i> by Instituation Name
					</div>				
				</div>
			</footer>
		</div>
		
	
		
		
	</div>
	<!--   Core JS Files   -->
	<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

	<!-- Moment JS -->
	<script src="{{asset('assets/js/plugin/moment/moment.min.js')}}"></script>

	<!-- Chart JS -->
	<script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

	<!-- Bootstrap Toggle -->
	<script src="{{asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{asset('assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Google Maps Plugin -->
	<script src="{{asset('assets/js/plugin/gmaps/gmaps.js')}}"></script>

	<!-- Dropzone -->
	<script src="{{asset('assets/js/plugin/dropzone/dropzone.min.js')}}"></script>

	<!-- Fullcalendar -->
	<script src="{{asset('assets/js/plugin/fullcalendar/fullcalendar.min.js')}}"></script>

	<!-- DateTimePicker -->
	<script src="{{asset('assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- Bootstrap Tagsinput -->
	<script src="{{asset('assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

	<!-- Bootstrap Wizard -->
	<script src="{{asset('assets/js/plugin/bootstrap-wizard/bootstrapwizard.js')}}"></script>

	<!-- jQuery Validation -->
	<script src="{{asset('assets/js/plugin/jquery.validate/jquery.validate.min.js')}}"></script>

	<!-- Summernote -->
	<script src="{{asset('assets/js/plugin/summernote/summernote-bs4.min.js')}}"></script>

	<!-- Select2 -->
	<script src="{{asset('assets/js/plugin/select2/select2.full.min.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

	<!-- Ready Pro JS -->
	<script src="{{asset('assets/js/ready.min.js')}}"></script>

	<!-- Ready Pro DEMO methods, don't include it in your project! -->
	<script src="{{asset('assets/js/setting-demo.js')}}"></script>
	<script src="{{asset('assets/js/demo.js')}}"></script>
</body>
</html>