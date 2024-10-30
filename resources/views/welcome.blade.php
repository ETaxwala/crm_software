@extends('mainlayouts.app')

@section('title', 'Home Page')

@section('content')

    @include('components.carousel')

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="bg-light rounded">

                        <img src="{{ url(env('LINK') . 'img/service-8.jpg') }}" class=" w-100" style="margin-bottom: -7px;"
                            alt="Image">
                        {{-- <img src="img/about-3.jpg" class="img-fluid w-100 border-bottom border-5 border-primary"
                            style="border-top-right-radius: 300px; border-top-left-radius: 300px;" alt="Image"> --}}
                    </div>
                </div>
                <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                    <h5 class="sub-title pe-3">About the company</h5>
                    <h1 class=" mb-4">Welcome to ETaxwala Business Solutions Pvt Ltd Your Business Doctor</h1>
                    <p class="mb-4">Running a business can be complex, and at times, overwhelming. But just like your
                        health, your business needs proper care, attention, and expert guidance to thrive. That's where
                        ETaxwala steps in - as your dedicated business doctor, we don't just treat the symptoms; we diagnose
                        the root cause and prescribe solutions that work, helping your business flourish.</p>

                </div>
            </div>
            <br><br><br>
            <div class="row g-5">

                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.3s">

                    <p class="mb-4">
                        Our team of expert Chartered Accountants and business consultants are dedicated to providing
                        holistic solutions across various domains, from business consultation and planning to business
                        registration, audit and compliance, marketing, and branding. Whether you’re a startup seeking
                        guidance, an established company looking for growth, or in need of regulatory assistance, ETaxwala
                        is your trusted partner for all your business needs.
                    </p>
                    <div class="row gy-4 align-items-center">

                        {{-- <div class="col-12 col-sm-6 d-flex align-items-center">
                            <i class="fas fa-map-marked-alt fa-3x text-secondary"></i>
                            <h5 class="ms-4">Best Immigration Resources</h5>
                        </div>
                        <div class="col-12 col-sm-6 d-flex align-items-center">
                            <i class="fas fa-passport fa-3x text-secondary"></i>
                            <h5 class="ms-4">Return Visas Availabile</h5>
                        </div> --}}
                        <div class="col-4 col-md-3">
                            <div class="bg-light text-center rounded p-3">
                                <div class="mb-2">
                                    <i class="fas fa-ticket-alt fa-4x text-primary"></i>
                                </div>
                                <h1 class="display-5 fw-bold mb-2">7</h1>
                                <p class="text-muted mb-0">Years of Experience</p>
                            </div>
                        </div>
                        <div class="col-8 col-md-9">
                            <div class="mb-5">
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Offer
                                    100 % Genuine Assistance</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> It’s
                                    Faster & Reliable Execution</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i>
                                    Accurate & Expert Advice</p>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                                    <a href="" class="position-relative wow tada" data-wow-delay=".9s">
                                        <i class="fa fa-phone-alt text-primary fa-3x"></i>
                                        <div class="position-absolute" style="top: 0; left: 25px;">
                                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="text-primary">Have any questions?</span>
                                    <span class="text-secondary fw-bold fs-5" style="letter-spacing: 2px;">Free: +91 70710
                                        70707</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 wow fadeInRight " data-wow-delay="0.1s">
                    <div class="bg-light rounded">
                        <img src="{{ url(env('LINK') . 'img/service-8.jpg') }}" class=" w-100" style="margin-bottom: -7px;"
                            alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Counter Facts Start -->
    <div class="container-fluid counter-facts py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="counter">
                        <div class="counter-icon">
                            <i class="fas fa-passport"></i>
                        </div>
                        <div class="counter-content">
                            <h3>Total Services</h3>
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="counter-value" data-toggle="counter-up">200</span>
                                <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="counter">
                        <div class="counter-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="counter-content">
                            <h3>Team Members</h3>
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="counter-value" data-toggle="counter-up">30</span>
                                <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="counter">
                        <div class="counter-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="counter-content">
                            <h3>Registrations</h3>
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="counter-value" data-toggle="counter-up">2000</span>
                                <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="counter">
                        <div class="counter-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="counter-content">
                            <h3>Success Rates</h3>
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="counter-value" data-toggle="counter-up">98</span>
                                <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">%</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter Facts End -->


    <!-- Services Start -->
    <div class="container-fluid service overflow-hidden pt-5">
        <div class="container py-5">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">Our Core Services</h5>
                </div>
                <h1 class="display-5 mb-4">Enabling Your Immigration Successfully</h1>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque
                    sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam
                    necessitatibus saepe in ab? Repellat!</p>
            </div>
            <div class="row g-4">

                @foreach ($coreservices as $service)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item">
                            <div class="service-inner">
                                <div class="service-img">
                                    <img src="{{ url(env('LINK') . 'core services/' . $service->image) }}"
                                        class="img-fluid w-100 rounded" alt="Image">
                                </div>
                                <div class="service-title">
                                    <div class="service-title-name">
                                        <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                            <a href="#" class="h4 text-white mb-0">{{ $service->name }}</a>
                                        </div>
                                        <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                            href="#">Explore More</a>
                                    </div>
                                    <div class="service-content pb-4">
                                        <a href="#">
                                            <h4 class="text-white mb-4 py-3">{{ $service->name }}</h4>
                                        </a>
                                        <div class="px-4">
                                            <p class="mb-4">{{ $service->content }}</p>
                                            <a class="btn btn-primary border-secondary rounded-pill py-3 px-5"
                                                href="#">Explore More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Services End -->



    <!-- Features Start -->
    <div class="container-fluid features overflow-hidden py-5">
        <div class="container">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">Why Choose Us</h5>
                </div>
                <h1 class="display-5 mb-4">Why ETaxwala?</h1>
                {{-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque
                    sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam
                    necessitatibus saepe in ab? Repellat!</p> --}}
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fas fa-dollar-sign fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3">Tailored Solutions</h5>
                            <p class="mb-3">We understand that your business is unique, and so are your challenges. Our
                                solutions are customized to fit the specific needs of your business.
                            </p>
                            <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fab fa-cc-visa fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3">Experienced Professionals</h5>
                            <p class="mb-3">Our team of Chartered Accountants, business consultants, and industry experts
                                are equipped with the knowledge and expertise to handle even the most complex business
                                issues.
                            </p>
                            <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fas fa-atlas fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3">Proactive Approach</h5>
                            <p class="mb-3">We don’t just react to problems – we anticipate them. With ETaxwala by your
                                side, you’ll always be ahead of the curve, with strategies that not only solve today’s
                                challenges but prepare you for tomorrow’s.
                            </p>
                            <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fas fa-users fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3">Client-Centric Focus</h5>
                            <p class="mb-3">We place our clients at the heart of everything we do. Our goal is to build
                                long-term relationships based on trust, transparency, and results.
                            </p>
                            <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a class="btn btn-primary border-secondary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.1s"
                        href="#">More Features</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Testimonial Start -->
    <div class="container-fluid testimonial overflow-hidden pb-5">
        <div class="container py-5">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">OUR CLIENTS RIVIEWS</h5>
                </div>
                <h1 class="display-5 mb-4">What Our Clients Say</h1>
                <p class="mb-0">ETaxwala transformed our business operations with their expert financial guidance.
                    From tax management to strategic planning, their team delivered beyond our expectations. Highly
                    recommend for anyone seeking to streamline their business!
                </p>
            </div>
            <div class="owl-carousel testimonial-carousel wow zoomInDown" data-wow-delay="0.2s">
                <div class="testimonial-item">
                    <div class="testimonial-content p-4 mb-5">
                        <p class="fs-5 mb-0">ETaxwala's consultancy services helped us identify growth opportunities we
                            never considered. Their expert advice has made a real difference in our bottom line. A must for
                            businesses looking to grow!

                        </p>
                        <div class="d-flex justify-content-end">
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                    </div>

                    {{-- <div class="d-flex">
                        <div class="rounded-circle me-4" style="width: 100px; height: 100px;">
                            <img class="img-fluid rounded-circle" src="{{ url(env('LINK') . 'img/testimonial-3.jpg') }}"
                                alt="img">
                        </div>
                        <div class="my-auto">
                            <h5>Santosh Asole

                            </h5>
                            <p class="mb-0">MD</p>
                        </div>
                    </div> --}}
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-content p-4 mb-5">
                        <p class="fs-5 mb-0">We’ve been with ETaxwala for over a year, and the level of personalized
                            service is exceptional. Their comprehensive approach helped us navigate complex financial
                            decisions with ease. Highly recommended!


                        </p>
                        <div class="d-flex justify-content-end">
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                    </div>

                    {{-- <div class="d-flex">
                        <div class="rounded-circle me-4" style="width: 100px; height: 100px;">
                            <img class="img-fluid rounded-circle" src="{{ url(env('LINK') . 'img/testimonial-3.jpg') }}"
                                alt="img">
                        </div>
                        <div class="my-auto">
                            <h5>Santosh Asole

                            </h5>
                            <p class="mb-0">MD</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->



    <!-- Training Start -->
    <div class="container-fluid training overflow-hidden bg-light py-5">
        <div class="container py-5">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">CHECK OUR TRAINING</h5>
                </div>
                <h1 class="display-5 mb-4">Get the Best Coacing Service Training with Our Travisa</h1>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque
                    sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam
                    necessitatibus saepe in ab? Repellat!</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="training-item">
                        <div class="training-inner">
                            <img src="{{ url(env('LINK') . 'img/training-1.jpg') }}" class="img-fluid w-100 rounded"
                                alt="Image">
                            <div class="training-title-name">
                                <a href="#" class="h4 text-white mb-0">IELTS</a>
                                <a href="#" class="h4 text-white mb-0">Coaching</a>
                            </div>
                        </div>
                        <div class="training-content bg-secondary rounded-bottom p-4">
                            <a href="#">
                                <h4 class="text-white">IELTS Coaching</h4>
                            </a>
                            <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                                veritatis.</p>
                            <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="training-item">
                        <div class="training-inner">
                            <img src="{{ url(env('LINK') . 'img/training-2.jpg') }}" class="img-fluid w-100 rounded"
                                alt="Image">
                            <div class="training-title-name">
                                <a href="#" class="h4 text-white mb-0">TOEFL</a>
                                <a href="#" class="h4 text-white mb-0">Coaching</a>
                            </div>
                        </div>
                        <div class="training-content bg-secondary rounded-bottom p-4">
                            <a href="#">
                                <h4 class="text-white">TOEFL Coaching</h4>
                            </a>
                            <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                                veritatis.</p>
                            <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="training-item">
                        <div class="training-inner">
                            <img src="{{ url(env('LINK') . 'img/training-3.jpg') }}" class="img-fluid w-100 rounded"
                                alt="Image">
                            <div class="training-title-name">
                                <a href="#" class="h4 text-white mb-0">PTE</a>
                                <a href="#" class="h4 text-white mb-0">Coaching</a>
                            </div>
                        </div>
                        <div class="training-content bg-secondary rounded-bottom p-4">
                            <a href="#">
                                <h4 class="text-white">PTE Coaching</h4>
                            </a>
                            <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                                veritatis.</p>
                            <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="training-item">
                        <div class="training-inner">
                            <img src="{{ url(env('LINK') . 'img/training-4.jpg') }}" class="img-fluid w-100 rounded"
                                alt="Image">
                            <div class="training-title-name">
                                <a href="#" class="h4 text-white mb-0">OET</a>
                                <a href="#" class="h4 text-white mb-0">Coaching</a>
                            </div>
                        </div>
                        <div class="training-content bg-secondary rounded-bottom p-4">
                            <a href="#">
                                <h4 class="text-white">OET Coaching</h4>
                            </a>
                            <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                                veritatis.</p>
                            <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <a class="btn btn-primary border-secondary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.1s"
                        href="#">View More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Training End -->


    <!-- Contact Start -->
    <div class="container-fluid contact overflow-hidden pb-5">
        <div class="container py-5">
            <div class="office pt-5">
                <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h5 class="sub-title text-primary px-3">Worlwide Offices</h5>
                    </div>
                    <h1 class="display-5 mb-4">Explore Our Office Worldwide</h1>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at
                        atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam
                        necessitatibus saepe in ab? Repellat!</p>
                </div>
                <div class="row g-4 justify-content-center">

                    <div class="col-md-6 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="office-item p-4">
                            <div class="office-img mb-4">
                                <img src="{{ url(env('LINK') . 'img/office-4.jpg') }}" class="img-fluid w-100 rounded"
                                    alt="">
                            </div>
                            <div class="office-content d-flex flex-column">
                                <h4 class="mb-2">Ch. Sambhajinagar (Aurangabad)</h4>
                                <a href="#" class="text-secondary fs-5 mb-2">+91 70710 70707</a>
                                <a href="#" class="text-muted fs-5 mb-2">support@etaxwala.com</a>
                                <p class="mb-0">301, Ashoka Residency, In Front Of Hotel Modi Grate, Beside Hotel Shidori
                                    Beed Bypass Road, Ch Sambhajinagar, Maharashtra 431001</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="office-item p-4">
                            <div class="office-img mb-4">
                                <img src="{{ url(env('LINK') . 'img/office-3.jpg') }}" class="img-fluid w-100 rounded"
                                    alt="">
                            </div>
                            <div class="office-content d-flex flex-column">
                                <h4 class="mb-2">Ambad Office, Jalna</h4>
                                <a href="#" class="text-secondary fs-5 mb-2">+91 70710 70707</a>
                                <a href="#" class="text-muted fs-5 mb-2">support@etaxwala.com</a>
                                <p class="mb-0">Ambad Office 150, Jalna Road, beside Bhagwati Traders, Ambad, Maharashtra
                                    431204</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    @include('components.modal')
@endsection

