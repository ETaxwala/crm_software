<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Customer Login</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link href="{{ url('public/assets/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ url('public/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Costic styles -->
    <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/favicon.ico') }}">

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
        <source src="{{ url('public/assets/img/bs-video.mp4 ') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="ms-lock-screen-weather">
        <p>38&deg;</p>
        <p>Aurangabad, Maharashtra</p>
    </div>

    {{-- <ul class="ms-lock-screen-nav">
    <li class="ms-nav-item dropdown">
      <a href="#" class="text-disabled ms-has-notification" id="mailDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">email</i></a>
      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="mailDropdown">
        <li class="dropdown-menu-header">
          <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Mail</span></h6><span class="badge badge-pill badge-success">3 New</span>
        </li>
        <li class="dropdown-divider"></li>
        <li class="ms-scrollable ms-dropdown-list">
          <a class="media p-2" href="#">
            <div class="ms-chat-status ms-status-offline ms-chat-img mr-2 align-self-center">
              <img src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
            </div>
            <div class="media-body">
              <span>Hey man, looking forward to your new project.</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 30 seconds ago</p>
            </div>
          </a>
          <a class="media p-2" href="#">
            <div class="ms-chat-status ms-status-online ms-chat-img mr-2 align-self-center">
              <img src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
            </div>
            <div class="media-body">
              <span>Dear John, I was told you bought Costic! Send me your feedback</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 28 minutes ago</p>
            </div>
          </a>
          <a class="media p-2" href="#">
            <div class="ms-chat-status ms-status-offline ms-chat-img mr-2 align-self-center">
              <img src="https://via.placeholder.com/270x270" class="ms-img-round" alt="people">
            </div>
            <div class="media-body">
              <span>How many people are we inviting to the dashboard?</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 6 hours ago</p>
            </div>
          </a>
        <li class="dropdown-divider"></li>
        <li class="dropdown-menu-footer text-center">
          <a href="pages/apps/email.html">Go to Inbox</a>
        </li>
      </ul>
    </li>
    <li class="ms-nav-item dropdown">
      <a href="#" class="text-disabled ms-has-notification" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">notifications</i></a>
      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
        <li class="dropdown-menu-header">
          <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Notifications</span></h6><span class="badge badge-pill badge-info">4 New</span>
        </li>
        <li class="dropdown-divider"></li>
        <li class="ms-scrollable ms-dropdown-list">
          <a class="media p-2" href="#">
            <div class="media-body">
              <span>12 ways to improve your crypto dashboard</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 30 seconds ago</p>
            </div>
          </a>
          <a class="media p-2" href="#">
            <div class="media-body">
              <span>You have newly registered users</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 45 minutes ago</p>
            </div>
          </a>
          <a class="media p-2" href="#">
            <div class="media-body">
              <span>Your account was logged in from an unauthorized IP</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 2 hours ago</p>
            </div>
          </a>
          <a class="media p-2" href="#">
            <div class="media-body">
              <span>An application form has been submitted</span>
              <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 1 day ago</p>
            </div>
          </a>
        <li class="dropdown-divider"></li>
        <li class="dropdown-menu-footer text-center">
          <a href="#">View all Notifications</a>
        </li>
      </ul>
    </li>
  </ul> --}}

    <!-- Main Content -->
    <main class="body-content ms-lock-screen">

        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper">
            <img class="ms-user-img ms-img-round ms-lock-screen-user"
                src="https://cdn-icons-png.flaticon.com/512/4366/4366950.png" alt="people">
            <h1>Welcome Back</h1>
            <form method="post" action="{{ route('customer-login') }}">
                @csrf
                <div class="ms-form-group my-0 mb-0 has-icon fs-14">
                    <input type="email" class="ms-form-input" name="user_name" placeholder="Enter Email"
                        value="" required>
                    <i class="material-icons">email</i>

                </div>
                <br>
                <div class="ms-form-group my-0 mb-0 has-icon fs-14">

                    <input type="password" class="ms-form-input" name="user_pass" placeholder="Enter Password"
                        value="" required>
                    <i class="material-icons">security</i>
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

    <script src="{{ url('public/assets/js/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ url('public/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('public/assets/js/jquery-ui.min.js') }}"></script>
    <!-- Global Required Scripts End -->

    <!-- Costic core JavaScript -->
    <script src="{{ url('public/assets/js/framework.js') }}"></script>

    <!-- Settings -->
    <script src="{{ url('public/assets/js/settings.js') }}"></script>

</body>

</html>
