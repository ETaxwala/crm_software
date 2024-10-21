<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Iconic Fonts -->
    <link href="{{ url('public/assets/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/assets/vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/vendors/iconic-fonts/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css') }}">
    <link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('public/assets/css/croppie.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="{{ url('public/assets/img/costic/nourrir_logo.png') }}">
    <script src="{{ url('public/assets/js/jquery-3.5.0.min.js') }}"></script>
    <link href="{{ url('public/assets/css/offer-card-style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.6.0/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Include Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <link rel="stylesheet" href="{{ url('public/assets/css/toastr.min.css') }}">




    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Advancr CRM</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">



    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">





    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<style>
    .sidemenuselected {
        color: #ff0018 !important;
    }

    .form-control {
        shadow: none;
    }
</style>


<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">
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
    <!-- Overlays -->
    <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
    <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity"
        data-toggle="slideRight"></div>
    <!-- Sidebar Navigation Left -->
    <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
        <!-- Logo -->
        <div class="logo-sn ms-d-block-lg">
            <a class="pl-0 ml-0 text-center" href="">
                <img src="{{ url('public/assets/img/logo_black.png') }}" alt="ETaxwala">
            </a>
            <h5 class="pl-0 ml-0 text-center">{{ Session::get('user_name') }}</h5>
        </div>
        <!-- Navigation -->
        <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
            <!-- Dashboard -->


            <li class="menu-item">
                <a href="{{ route('assistant_manager') }}"
                    class="{{ Request::is('operation/assistant/assistant_manager') ? 'active' : '' }}">
                    <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('manage-employee') }}"
                    class="{{ Request::is('operation/assistant/manage-employee') ? 'active' : '' }}">
                    <span><i class="material-icons fs-16">dashboard</i>Manage Employee</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('manage-customer') }}"
                    class="{{ Request::is('operation/assistant/manage-customer') ? 'active' : '' }}">
                    <span><i class="material-icons fs-16">dashboard</i>Manage Customer</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('manage-tasks') }}"
                    class="{{ Request::is('operation/assistant/manage-tasks') ? 'active' : '' }}">
                    <span><i class="material-icons fs-16">dashboard</i>Manage Tasks</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('oa-customer-details-list') }}"
                    class="{{ Request::is('operation/assistant/customer-details-list') ? 'active' : '' }}">
                    <span><i class="material-icons fs-16">dashboard</i>Customers Details</span>
                </a>
            </li>
            <li class="menu-item">
                        <a href="{{ route('get-all-appointment') }}"
                            class="{{ Request::is('get-all-appointment') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Appointments</span>
                        </a>
                    </li>
                    
            <li class="menu-item">
                <a href="#" class="has-chevron collapsed" data-toggle="collapse" data-target="#reports"
                    aria-expanded="false" aria-controls="charts">
                    <span><i class="material-icons fs-16">equalizer</i>Reports</span>
                </a>
                <ul id="reports" class="collapse" aria-labelledby="charts" data-parent="#side-nav-accordion"
                    style="">
                    <li><a href="">Total Calls</a></li>
                    <li><a href="">Total Sales</a></li>
                </ul>
            </li>





        </ul>
    </aside>

    <!-- Main Content -->
    <main class="body-content">
        <!-- Navigation Bar -->
        <nav class="navbar ms-navbar">
            <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft"> <span
                    class="ms-toggler-bar bg-primary"></span>
                <span class="ms-toggler-bar bg-primary"></span>
                <span class="ms-toggler-bar bg-primary"></span>
            </div>
            <h5>{{ Session::get('user_name') }}</h5>
            <div class="logo-sn logo-sm ms-d-block-sm">
                <a class="pl-0 ml-0 text-center navbar-brand mr-0" href=""><img
                        src="{{ url('assets/img/logo_black.png') }}" alt="ETaxwala">
                </a>
            </div>



            <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">

                

                <li class="ms-nav-item dropdown">
                    <a href="#"
                    @php
                        $unreadNotificationsCount = 0;
                    @endphp
                        class="text-disabled {{ $unreadNotificationsCount ? 'ms-has-notification' : '' }}"
                        id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-bell"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                        <li class="dropdown-menu-header">
                            <h6 class="dropdown-header ms-inline m-0">
                                <span class="text-disabled">Notifications</span>
                            </h6>
                            <span class="badge badge-pill badge-info"
                                id="unread-count">{{ $unreadNotificationsCount }} New</span>
                            <span class="badge badge-pill badge-success text-white">
                                <a class="text-white" id="mark-all-read" href="javascript:void(0);">Read All</a>
                            </span>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="ms-scrollable ms-dropdown-list ps" id="notifications-list">
                           
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-menu-footer text-center">
                        </li>
                    </ul>
                </li>


                <li class="ms-nav-item ms-nav-user dropdown">
                    <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="ms-user-img ms-img-round float-right"
                            src="{{ url('public/assets/img/logo_black.png') }}" alt="ETaxwala">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
                        <li class="dropdown-menu-header">
                            <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Welcome,
                                    {{ Session::get('user_name') }}</span></h6>
                        </li>

                        <li class="dropdown-divider"></li>

                        <li class="dropdown-menu-footer">

                            @if (Session::get('user_type') == 0)
                                <a class="media fs-14 p-2" href="{{ url('customer-logout') }}"> <span><i
                                            class="flaticon-shut-down mr-2"></i> Logout</span>
                                </a>
                            @else
                                <a class="media fs-14 p-2" href="{{ url('admin-logout') }}"> <span><i
                                            class="flaticon-shut-down mr-2"></i> Logout</span>
                                </a>
                            @endif

                        </li>
                    </ul>
                </li>
            </ul>
            <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown"
                data-target="#ms-nav-options"> <span class="ms-toggler-bar bg-primary"></span>
                <span class="ms-toggler-bar bg-primary"></span>
                <span class="ms-toggler-bar bg-primary"></span>
            </div>
        </nav>

        <div class="ms-content-wrapper">
