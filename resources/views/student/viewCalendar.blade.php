<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>View Event Calendar</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
   <link rel="icon" href="{{asset('storage/images/c.png')}}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Montserrat:100,200,300,400,500,600,700,800,900"]
            },
            custom: {
                "families": ["Flaticon", "LineAwesome"],
                urls: ['{{ asset('assets/css/fonts.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.min.css') }}">

</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header">
                <!--
     Tip 1: You can change the background color of the logo header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
    -->
    <a href="{{route('student.dashboard')}}" class="big-logo">
        <img src="{{asset('storage/images/c.png')}}" alt="logo img" class="logo-img">
    </a>
    

                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
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
                  
                    
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="flaticon-search-1"></i>
                            </a>
                        </li>

                        
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img src="{{ $student->getProfile->image}}"
                                    alt="image profile" width="36" class="img-circle"></a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="{{ $student->getProfile->image }}"
                                                alt="image profile"></div>
                                        <div class="u-text">
                                            <h4>{{ $student->firstName }}</h4>
                                            <form method="post" action="{{ route('student.logout') }}">@csrf<input
                                                    type='submit'class="btn btn-primary btn-rounded btn-login"
                                                    value='Logout'></form>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </li>

                    </ul>

            </nav>
            <!-- End Navbar -->
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <!--
    Tip 1: You can change the background color of the sidebar using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
    Tip 2: you can also add an image using data-image attribute
   -->
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="photo">
                            <img src="{{ $student->getProfile->image }}" alt="image profile">
                        </div>
                        <div class="info">
                            <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    {{ $student->firstName }}
                                    <span class="user-level">Student</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="{{route('student.viewprofile')}}">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('student.editprofile',['id'=>$student->id])}}">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="{{route('student.dashboard')}}">
                                <i class="flaticon-home"></i>
                                <p>Dashboard</p>

                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="la la-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Manage</h4>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.manageclass')}}">
                                <i class="flaticon-home"></i>
                                <p>Classes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.manageevents')}}">
                                <i class="flaticon-home"></i>
                                <p>Events</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('student.manageQ&A')}}">
                                <i class="flaticon-agenda-1"></i>
                                <p>Questions and Answers</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-toggle="collapse" href="{{route('student.viewCalendar')}}">
                                <i class="flaticon-agenda-1"></i>
                                <p>Calendar</p>
                            </a>

                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Calendar</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="quick-sidebar">
            <a href="#" class="close-quick-sidebar">
                <i class="flaticon-cross"></i>
            </a>

        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
    <!-- Moment JS -->
    <script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Bootstrap Toggle -->
    <script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Fullcalendar -->
    <script src="{{ asset('assets/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
    <!-- Ready Pro JS -->
    <script src="{{ asset('assets/js/ready.min.js') }}"></script>
    <!-- Ready Pro DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script>
        $(document).ready(function () {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var className = Array('fc-danger');
    
            var eventsData = {!! json_encode($events->toArray()) !!};
            var events = eventsData.map(function (event) {
                return {
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    className: className[Math.floor(Math.random() * className.length)]
                };
            });
    
            var classData = {!! json_encode($enrolledClasses->toArray()) !!};
            var classNames = {!! json_encode($classNames) !!};
            // console.log(classNames);
    
            var classEvents = classData.map(function (classEvent, index) {
                var endingDate = new Date(classEvent.endingDate);
                endingDate.setDate(endingDate.getDate() + 1);
    
                return {
                    id: classEvent.id,
                    title: `${classEvent.starttime} ${classNames[index % classNames.length]} `,
                    start: classEvent.startingDate,
                    end: endingDate.toISOString().split('T')[0],
                    className: 'fc-primary'
                };
            });
    
            var allEvents = events.concat(classEvents);
    
            $calendar = $('#calendar');
            $calendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                selectable: true,
                selectHelper: true,
                events: allEvents,
            });
        });
    </script>
    
</body>

</html>
