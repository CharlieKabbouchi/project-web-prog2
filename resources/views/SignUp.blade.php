<!DOCTYPE html>
<html lang="en">

<head>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Montserrat:100,200,300,400,500,600,700,800,900"]
            },
            custom: {
                "families": ["Flaticon", "LineAwesome"],
                urls: [{
                    {
                        asset('assets/css/fonts.css')
                    }
                }]
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

<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sign Up</h3>
            <form method="POST" action="{{ route('user.signup') }}" enctype="multipart/form-data">
                @csrf
                <div class="login-form">
                    <div class="form-group form-floating-label">
                        <input id="firstName" name="firstName" type="text" class="form-control input-border-bottom"
                            required>
                        <label for="firstName" class="placeholder">First Name</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="lastName" name="lastName" type="text" class="form-control input-border-bottom"
                            required>
                        <label for="lastName" class="placeholder">Last Name</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <label for="DOB">Date Of Birth</label>
                        <input id="DOB" name="DOB" type="Date"
                            class="form-control input-border-bottom"required>

                    </div>
                    <!-- Gender dropdown -->
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="Gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <!-- User Type dropdown -->
                    <div class="form-group">
                        <label for="type">User Type:</label>
                        <select class="form-control" id="type" name="type">
                            <option value="teacher">Teacher</option>
                            <option value="parent">Parent</option>
                            <option value="student">Student</option>
                        </select>
                    </div>

                    <div class="form-group form-floating-label">
                        <input id="email" name="email" type="email" class="form-control input-border-bottom"
                            required>
                        <label for="email" class="placeholder">Email</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="phone" name="phone" type="text" class="form-control input-border-bottom"
                            required>
                        <label for="phone" class="placeholder">Phone Number</label>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" style="width:100%" value="Submit">
                    </div>



                </div>
            </form>
        </div>



    </div>
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ready.js') }}"></script>
</body>

</html>
