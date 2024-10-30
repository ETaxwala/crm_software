<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-secondary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-secondary px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-5 text-center text-lg-start mb-lg-0">
            <div class="d-flex">
                <a href="#" class="text-muted me-4"><i
                        class="fas fa-envelope text-secondary me-2"></i>support@etaxwala.com</a>
                <a href="#" class="text-muted me-0"><i class="fas fa-phone-alt text-secondary me-2"></i>+91 7071
                    070707</a>
            </div>
        </div>
        <div class="col-lg-3 row-cols-1 text-center mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" target="_blank"
                    href="https://whatsapp.com/channel/0029VaklRIwD8SDyeJOQY043"><i
                        class="fab fa-whatsapp fw-normal text-primary"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" target="_blank"
                    href="https://www.facebook.com/etaxwala.official"><i
                        class="fab fa-facebook-f fw-normal text-primary"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" target="_blank"
                    href="https://www.linkedin.com/company/etaxwala/"><i
                        class="fab fa-linkedin-in fw-normal text-primary"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" target="_blank"
                    href="https://www.instagram.com/etaxwala.official/"><i
                        class="fab fa-instagram fw-normal text-primary"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle" target="_blank"
                    href="https://www.youtube.com/@etaxwala"><i class="fab fa-youtube fw-normal text-primary"></i></a>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                {{-- <a onclick="showsearchModal()" class="text-muted mx-2"> Inquiry Now</a><small> / </small> --}}
                <a href="#" class="text-muted mx-2"> Support</a><small> / </small>
                <a href="{{ route('user-login') }}" target="_blank" class="text-muted mx-2">Staff Login </a> <small> / </small>
              <a href="{{ route('customer.login') }}" target="_blank" class="text-muted ms-2">User Login</a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar p-0">
    <nav class=" navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <img src="{{ url(env('LINK') . 'img/logo_black.png')}}" alt="Logo" width="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('index') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown"><span
                            class="dropdown-toggle">Registration</span></a>
                    <div class="dropdown-menu m-0">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-5">
                                    <strong class="dropdown-item-heading">Business Registrations</strong>
                                    <a href="{{ route('Partnership Firm Registration') }}"
                                        class="dropdown-item {{ Request::is('Partnership-Firm-Registration') ? 'active' : '' }}">Partnership
                                        Firm Registration</a>
                                    <a href="{{ route('One Person Company') }}"
                                        class="dropdown-item {{ Request::is('One-Person-Company') ? 'active' : '' }}">One
                                        Person Company</a>
                                    <a href="{{ route('Private LTD Company') }}"
                                        class="dropdown-item {{ Request::is('Private-LTD-Company') ? 'active' : '' }}">Private
                                        LTD Company </a>
                                    <a href="{{ route('Limited Liability Partnership (LLP)') }}"
                                        class="dropdown-item {{ Request::is('Limited-Liability-Partnership-LLP') ? 'active' : '' }}">Limited
                                        Liability Partnership (LLP)</a>
                                    <a href="{{ route('Section 8 Company NGO') }}"
                                        class="dropdown-item {{ Request::is('Section-8-Company-NGO') ? 'active' : '' }}">Section
                                        8 Company NGO</a>
                                    <a href="{{ route('Producer Company') }}"
                                        class="dropdown-item {{ Request::is('Producer-Company') ? 'active' : '' }}">Producer
                                        Company </a>
                                    <a href="{{ route('Public LTD Company') }}"
                                        class="dropdown-item {{ Request::is('Public-LTD-Company') ? 'active' : '' }}">Public
                                        LTD Company </a>
                                    <a href="{{ route('Indian Subsidiary Company') }}" class="dropdown-item {{ Request::is('Indian-Subsidiary-Company') ? 'active' : '' }}">Indian
                                        Subsidiary Company </a>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <strong class="dropdown-item-heading">Others Registrations</strong>
                                    <a href="{{route('Shop Act Registration')}}" class="dropdown-item  {{ Request::is('shop-act-registration') ? 'active' : '' }} ">Shop Act Registration</a>
                                    <a href="{{route('MSME Registration')}}" class="dropdown-item  {{ Request::is('msme-registration') ? 'active' : '' }} ">MSME Registration</a>
                                    <a href="{{route('GST Registration')}}" class="dropdown-item  {{ Request::is('gst-registration') ? 'active' : '' }} ">GST Registration</a>
                                    <a href="{{route('FSSAI Registration')}}" class="dropdown-item  {{ Request::is('fssai-registration') ? 'active' : '' }} ">FSSAI Registration</a>
                                    <a href="{{route('Import Export Code')}}" class="dropdown-item  {{ Request::is('import-export-code') ? 'active' : '' }} ">Import Export Code</a>
                                    <a href="{{route('EPFO ESIC Registration')}}" class="dropdown-item  {{ Request::is('epfo-esic-registration') ? 'active' : '' }} ">EPFO ESIC Registration</a>
                                    <a href="{{route('80G 12A Registration')}}" class="dropdown-item  {{ Request::is('80G-12A-registration') ? 'active' : '' }} ">80G 12A Registration</a>
                                    <a href="{{route('Professional Tax Registration')}}" class="dropdown-item  {{ Request::is('professional-tax-registration') ? 'active' : '' }}">Professional Tax Registration</a>
                                    <a href="{{route('TAN Registration')}}" class="dropdown-item  {{ Request::is('tan-registration') ? 'active' : '' }}">TAN Registration</a>
                                    <a href="{{route('Digital Signature')}}" class="dropdown-item  {{ Request::is('DSC') ? 'active' : '' }}">Digital Signature (DSC)</a>
                                    <a href="{{route('PASARA License')}}" class="dropdown-item  {{ Request::is('PASARA-license') ? 'active' : '' }}">PASARA License</a>
                                    <a href="{{route('Niti Ayog Darpan')}}" class="dropdown-item  {{ Request::is('niti-ayog-darpan') ? 'active' : '' }}">Niti Ayog Darpan</a>
                                    <a href="{{route('Trade License')}}" class="dropdown-item  {{ Request::is('trade-license') ? 'active' : '' }}">Trade License</a>
                                </div>
                            </div>
                        </div>

                        {{-- <a href="{{ route('Microfinance Company (Section 8)')}}" class="dropdown-item">Microfinance Company (Section 8)</a>
                        <a href="{{ route('Microfinance Company NBFC (RBI Registered)')}}" class="dropdown-item">Microfinance Company NBFC (RBI Registered)</a> --}}
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown"><span
                            class="dropdown-toggle">Taxation & Return</span></a>
                    <div class="dropdown-menu m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="countries.html" class="dropdown-item">Countries</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="training.html" class="dropdown-item">Training</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown"><span class="dropdown-toggle">Audit
                            & Compliances</span></a>
                    <div class="dropdown-menu m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="countries.html" class="dropdown-item">Countries</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="training.html" class="dropdown-item">Training</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown"><span
                            class="dropdown-toggle">Consultancy</span></a>
                    <div class="dropdown-menu m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="countries.html" class="dropdown-item">Countries</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="training.html" class="dropdown-item">Training</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown"><span
                            class="dropdown-toggle">Marketing & Branding</span></a>
                    <div class="dropdown-menu m-0">
                        <a href="feature.html" class="dropdown-item">Feature</a>
                        <a href="countries.html" class="dropdown-item">Countries</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="training.html" class="dropdown-item">Training</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
            </div>
            {{-- <button class="btn btn-primary btn-md-square border-secondary mb-3 mb-md-3 mb-lg-0 me-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button> --}}
            {{-- <a href="" class="btn btn-primary border-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0">Get A Quote</a> --}}
        </div>
    </nav>
</div>
<!-- Navbar & Hero End -->
