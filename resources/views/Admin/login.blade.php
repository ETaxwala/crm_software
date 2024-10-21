<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CRM Login</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ url(env('LINK') . 'vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link href="{{ url(env('LINK') . 'assets/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ url(env('LINK') . 'assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ url(env('LINK') . 'assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Costic styles -->
    <link href="{{ url(env('LINK') . 'assets/css/style.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url(env('LINK') . 'favicon.ico') }}">

</head>
<style>
    #background-video { 
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        object-fit: cover;

    }

    .ms-body {
        /* z-index: -1; */
    }


    /* password */
    .password-container {
        display: flex;
        flex-direction: column;
        margin: 20px;
    }

    .toggle-password {
        cursor: pointer;
        color: white;
        margin-top: 5px;
    }

    .show-password {
        color: red;
    }

</style>

<body class="ms-body ms-primary-theme">

    <!-- Preloader -->
    <div id="preloader-wrap">
        <div class="spinner spinner-8">
            <div class="ms-circle1 ms-child"></div>
            <div class="ms-circle2 ms-child"></div>
            <div class="ms-circle3 ms-child"></div>
            <div class="ms-circle4 ms-child"></div>
            <div class="ms-circle5 ms-child"></div>
            <div class="ms-circle6 ms-child"></div>
            <div class="ms-circle7 ms-child"></div>
            <div class="ms-circle8 ms-child"></div>
            <div class="ms-circle9 ms-child"></div>
            <div class="ms-circle10 ms-child"></div>
            <div class="ms-circle11 ms-child"></div>
            <div class="ms-circle12 ms-child"></div>
        </div>
    </div>
    <video id="background-video" autoplay loop muted>
        <!-- Replace 'video.mp4' with the path to your video file -->
        <source src="{{ url(env('LINK') . 'assets/img/bs-video.mp4 ') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="ms-lock-screen-weather">
        <p>38&deg;</p>
        <p>Aurangabad, Maharashtra</p>
    </div>

    <!-- Main Content -->
    <main class="body-content ms-lock-screen">

        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper">
            <img class="ms-user-img ms-img-round ms-lock-screen-user"
                src="https://cdn-icons-png.flaticon.com/512/4366/4366950.png" alt="people">
            <h1>Welcome Back</h1>
            <form method="post" action="{{ route('admin-login') }}">
                @csrf
                <div class="ms-form-group my-0 mb-0 has-icon fs-14">
                    <input type="email" class="ms-form-input" name="user_mail" placeholder="Enter Email"
                        value="" required>
                    <i class="material-icons">email</i>

                </div>
                <br>
                <div class="ms-form-group my-0 mb-0 has-icon fs-14">

                    <input type="password" class="ms-form-input" id="password" name="user_password" placeholder="Enter Password"
                        value="" required>
                    <i class="material-icons">security</i>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">Show Password</span>
                </div>
                {{-- <a href="../../index.html" class="btn btn-success w-100">Unlock</a> --}}
                <input type="submit" class="btn btn-info w-100" value="Sign In">
            </form>
            <br>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>


    </main>
    <div class="ms-lock-screen-privacy">
        <p><a href="https://etaxwala.com/privacy/" target="_blank">Privacy Policy</a> | <a href="https://etaxwala.com/privacy/" target="_blank">Terms & Conditions</a></p>
    </div>
    <div class="ms-lock-screen-time">


        @php
            date_default_timezone_set('Asia/Kolkata');
            $date = Date('l, F j');
            $current_time = date('H:i');
        @endphp
        <p>{{ $current_time }}</p>
        <p>{{ $date }}</p>
    </div>

    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->

    <script src="{{ url(env('LINK') . 'assets/js/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ url(env('LINK') . 'assets/js/popper.min.js') }}"></script>
    <script src="{{ url(env('LINK') . 'assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url(env('LINK') . 'assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ url(env('LINK') . 'assets/js/jquery-ui.min.js') }}"></script>
    <!-- Global Required Scripts End -->

    <!-- Costic core JavaScript -->
    <script src="{{ url(env('LINK') . 'assets/js/framework.js') }}"></script>

    <!-- Settings -->
    <script src="{{ url(env('LINK') . 'assets/js/settings.js') }}"></script>

</body>

</html>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleButton = document.querySelector(".toggle-password");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButton.textContent = "Hide Password";
            toggleButton.classList.add("show-password");
        } else {
            passwordInput.type = "password";
            toggleButton.textContent = "Show Password";
            toggleButton.classList.remove("show-password");
        }
    }
</script>
