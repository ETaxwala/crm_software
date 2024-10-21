<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Iconic Fonts -->
    <link href="{{ url(env('LINK') . 'assets/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url(env('LINK') . 'assets/vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url(env('LINK') . 'assets/vendors/iconic-fonts/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" href="{{ url(env('LINK') . 'assets/vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css') }}">
    <link href="{{ url(env('LINK') . 'assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url(env('LINK') . 'assets/css/croppie.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="{{ url(env('LINK') . 'assets/img/costic/nourrir_logo.png') }}">
    <script src="{{ url(env('LINK') . 'assets/js/jquery-3.5.0.min.js') }}"></script>
    <link href="{{ url(env('LINK') . 'assets/css/offer-card-style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.6.0/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Include Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <link rel="stylesheet" href="{{ url(env('LINK') . 'assets/css/toastr.min.css') }}">




    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Advance CRM</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">



    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">





    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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
                <img src="{{ url(env('LINK') . 'assets/img/logo_black.png') }}" alt="ETaxwala">
            </a>
            <h5 class="pl-0 ml-0 text-center">{{ Session::get('user_name') }}</h5>
        </div>
        <!-- Navigation -->
        <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
            <!-- Dashboard -->







            @switch(Session::get('user_type'))
                @case(0)
                    <li class="menu-item">
                        <a href="{{ route('customer-dashboard') }}"
                            class="{{ Request::is('customer-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('customer-my-services') }}"
                            class="{{ Request::is('customer-my-services') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>My Services</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('customer-all-services') }}"
                            class="{{ Request::is('customer-all-services') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>All Services</span>
                        </a>
                    </li>
                @break

                @case(1)
                    <li class="menu-item">
                        <a href="{{ route('super-admin-dashboard') }}"
                            class="{{ Request::is('super-admin-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('super-admin-manage-admin') }}"
                            class="{{ Request::is('super-admin-manage-admin') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Admin</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('super-admin-manage-manager') }}"
                            class="{{ Request::is('super-admin-manage-manager') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Manager</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('super-admin-manage-employee') }}"
                            class="{{ Request::is('super-admin-manage-employee') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Employee</span>
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
                @break

                @case(2)
                    <li class="menu-item">
                        <a href="{{ route('admin-dashboard') }}"
                            class="{{ Request::is('admin-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin-manage-manager') }}"
                            class="{{ Request::is('admin-manage-manager') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Manager</span>
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="{{ route('admin-manage-employee') }}"
                            class="{{ Request::is('admin-manage-employee') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Employee</span>
                        </a>
                    </li> --}}
                    <li class="menu-item">
                        <a href="{{ route('admin-manage-category') }}"
                            class="{{ Request::is('admin-manage-category') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Category</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin-manage-service') }}"
                            class="{{ Request::is('admin-manage-service') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Services</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin-manage-packages') }}"
                            class="{{ Request::is('admin-manage-packages') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Packages</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('manage-resumes') }}"
                            class="{{ Request::is('manage-resumes') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Resume</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('user-activity') }}"
                            class="{{ Request::is('user-activity') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>User Activities</span>
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
                @break

                @case(3)
                    <li class="menu-item">
                        <a href="{{ route('sales-manager-dashboard') }}"
                            class="{{ Request::is('sales-manager-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('sales-manage-employee') }}"
                            class="{{ Request::is('sales-manage-employee') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Employee</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('sales-manage-partners') }}"
                            class="{{ Request::is('sales-manage-partners') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Partners</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('sales-manage-customers') }}"
                            class="{{ Request::is('sales-manage-customers') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Customers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="has-chevron collapsed" data-toggle="collapse" data-target="#Mleads"
                            aria-expanded="false" aria-controls="Mleads">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Leads</span>
                        </a>
                        <ul id="Mleads" class="collapse" aria-labelledby="Mleads" data-parent="#side-nav-accordion"
                            style="">
                            <li><a href="{{ route('sales-manage-leads') }}"
                                    class="{{ Request::is('sales-manage-leads') ? 'active' : '' }}">Lead List</a></li>
                            <li><a href="{{ route('sales-manage-leads-details') }}"
                                    class="{{ Request::is('sales-manage-leads-details') ? 'active' : '' }}">Leads Details</a>
                            </li>
                            <li><a href="{{ route('sales-manage-customer-inqury') }}"
                                class="{{ Request::is('sales-manage-customer-inqury') ? 'active' : '' }}">Customer Inquries</a>
                        </li>
                        </ul>
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
                @break

                @case(4)
                    <li class="menu-item">
                        <a href="{{ route('operation-manager-dashboard') }}"
                            class="{{ Request::is('operation-manager-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operation-manage-employee') }}"
                            class="{{ Request::is('operation-manage-employee') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Employee</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operation-manage-customer') }}"
                            class="{{ Request::is('operation-manage-customer') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Customer</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operation-manage-tasks') }}"
                            class="{{ Request::is('operation-manage-tasks') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Tasks</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('customer-details-list') }}"
                            class="{{ Request::is('customer-details-list') ? 'active' : '' }}">
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
                @break

                @case(5)
                    <li class="menu-item">
                        <a href="{{ route('franchise-manager-dashboard') }}"
                            class="{{ Request::is('franchise-manager-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-manage-employee') }}"
                            class="{{ Request::is('franchise-manage-employee') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Employee</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-client-list') }}"
                            class="{{ Request::is('franchise-client-list') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Client List</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-manage-traning-videos') }}"
                            class="{{ Request::is('franchise-manage-traning-videos') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Traning Videos</span>
                        </a>
                    </li>
                @break

                @case(6)
                    <li class="menu-item">
                        <a href="{{ route('sales-employee-dashboard') }}"
                            class="{{ Request::is('sales-employee-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('sales-employee-manage-leads') }}"
                            class="{{ Request::is('sales-employee-manage-leads') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Leads</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="has-chevron collapsed" data-toggle="collapse" data-target="#reports"
                            aria-expanded="false" aria-controls="charts">
                            <span><i class="material-icons fs-16">equalizer</i>Quotations</span>
                        </a>
                        <ul id="reports" class="collapse" aria-labelledby="charts" data-parent="#side-nav-accordion"
                            style="">
                            <li><a href="{{ route('quotation.index') }}"
                                class="{{ Request::is('quotation') ? 'active' : '' }}">
                                <span>Manage Quotations</span>
                            </a></li>
                            <li><a href="{{ route('quotation.create') }}"
                                class="{{ Request::is('quotation/create') ? 'active' : '' }}">
                                <span>Create New</span>
                            </a></li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('get-all-appointment') }}"
                            class="{{ Request::is('get-all-appointment') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Appointments</span>
                        </a>
                    </li>
                @break

                @case(7)
                    <li class="menu-item">
                        <a href="{{ route('operation-emp-dashboard') }}"
                            class="{{ Request::is('operation-emp-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('operation-emp-manage-task') }}"
                            class="{{ Request::is('operation-emp-manage-task') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Task</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('get-all-appointment') }}"
                            class="{{ Request::is('get-all-appointment') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Appointments</span>
                        </a>
                    </li>

                @break

                @case(8)
                    <li class="menu-item">
                        <a href="{{ route('franchise-employee-dashboard') }}"
                            class="{{ Request::is('franchise-employee-dashboard') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-employee-manage-clients') }}"
                            class="{{ Request::is('franchise-employee-manage-clients') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Leads</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-partner-all-services') }}"
                            class="{{ Request::is('franchise-partner-all-services') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>All Services</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-partner-customer-inquries') }}"
                            class="{{ Request::is('franchise-partner-customer-inquries') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Manage Inquries</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('franchise-partner-customer-orders') }}"
                            class="{{ Request::is('franchise-partner-customer-orders') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Customer Orders</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('partner-traning-section') }}"
                            class="{{ Request::is('partner-traning-section') ? 'active' : '' }}">
                            <span><i class="material-icons fs-16">dashboard</i>Traning Videos</span>
                        </a>
                    </li>
                @break
            @endswitch





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
                        src="{{ url(env('LINK') . 'assets/img/logo_black.png') }}" alt="ETaxwala">
                </a>
            </div>
            <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">


                <li class="ms-nav-item ms-nav-user dropdown">
                    <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="ms-user-img ms-img-round float-right"
                            src="{{ url(env('LINK') . 'assets/img/logo_black.png') }}" alt="ETaxwala">
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
