@extends('mainlayouts.app')

@section('title', 'Producer Company Registration')
@section('page_name', 'Producer Company Registration')

@section('content')

    @include('components.service_banner')

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class="sub-title pe-3">Producer Company Registration</h5>
                    <p class="mb-4">A producer company is formally recognized as a legal entity composed of farmers or
                        agriculturists with the purpose of enhancing their standard of living and ensuring the well-being of
                        their support, earnings, and profitability. Registered under the Companies Act, a producer company
                        in India can be formed by a minimum of 10 individuals or 2 institutions, or a combination of both,
                        with their business activities focusing on procurement, production, harvesting, grading, pooling,
                        handling, marketing, selling, or exporting primary producers' goods or services for their benefit.
                    </p>
                    <p class="mb-4">
                        The primary objectives of a producer company include simplifying cooperative businesses' formation
                        as corporations and facilitating the transformation of existing cooperative businesses into
                        corporations.
                    </p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">

                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.3s">


                    <h5 class=" pe-3">Documents Required for Producer Company Registration</h5>
                    <p class="mb-4">
                    <ul>
                        <li>PAN Card/Passport/Election ID Card of each director and shareholder</li>
                        <li>Latest bank statement</li>
                        <li>Voter's ID/Driver's License/Passport of each director and shareholder</li>
                        <li>Passport-sized photographs of each director and shareholder</li>
                        <li>Any utility bill copy as a residential proof <br> (For rented property: scanned copy of the
                            rent agreement along with NOC from the landlord; for owned property: a copy of property papers)
                        </li>
                    </ul>
                    </p>

                </div>
                <div class="col-xl-5 wow fadeInRight " data-wow-delay="0.1s">
                    <div class="bg-light rounded">
                        <img src="img/service-8.jpg" class=" w-100" style="margin-bottom: -7px;" alt="Image">
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class=" pe-3">Registration Process with ETaxwala</h5>
                    <p class="mb-4">
                    <p class="mb-4">
                        ETaxwala, a professional tech-based online platform, offers legal services to simplify various
                        registration processes, implementation, tax concerns, and additional legal compliance for businesses
                        in India.
                    </p>
                    <ul>
                        <li>
                            <strong>Step 1: Obtain DSC & DIN</strong> <br> ETaxwala initiates the process by applying for
                            Digital
                            Signature Certificate (DSC) and Director Identification Number (DIN), typically completing this
                            step within 2-3 working days.
                        </li>
                        <li>
                            <strong>Step 2: Name Approval</strong> <br> ETaxwala proceeds to apply for company name
                            approval, with an expected duration of approximately 2-3 days.
                        </li>
                        <li>
                            <strong>Step 3: MoA and AoA Submission</strong> <br> The platform takes responsibility for
                            preparing
                            the Memorandum of Association (MoA) and Articles of Association (AoA) within an estimated
                            timeframe of 5-7 days.
                        </li>
                        <li>
                            <strong>Step 4: Certificate of Incorporation, PAN & TAN</strong> <br> ETaxwala then files for
                            obtaining the Certificate of Incorporation (CoI), along with PAN & TAN, anticipating completion
                            within about 10-15 days.
                        </li>
                        <li>
                            <strong>Step 5: Congratulations!</strong> <br> Upon successful company incorporation, your work
                            is complete. You can conveniently download your Incorporation certificate and Incorporation kit
                            from your dashboard.
                        </li>

                    </ul>
                    </p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class=" pe-3">FAQs:</h5>
                    <p class="mb-4">
                    <ul>

                        <strong>1. Qualification for Director of a Producer Company:</strong>
                        <br>
                        <p>Ans: An individual qualified to be a director of this company must be any natural person above the age of 18 engaged in farming activities.</p>

                        <strong>2. Rules for Name Selection of a Producer Company:</strong>
                        <br>
                        <p>Ans: The first part of the company name must be a unique word or name, and the second part must describe the type of business activity. The name must end with "Producer Company Limited."</p>

                        <strong>3. What is a DIN?</strong>
                        <br>
                        <p>Ans: A Director Identification Number (DIN) is a unique identifier for a company director. When appointed, the DIN must be mentioned in relevant documentation.</p>

                        <strong>4. What is DSC?</strong>
                        <br>
                        <p>Ans: A Digital Signature Certificate (DSC) is an electronic signature in encrypted form. It is used for signing e-forms during the filing of documents for company registration.</p>

                        <strong>5. Audit Requirement for Producer Company:</strong>
                        <br>
                        <p>Ans: Yes, the books of the company must be audited annually. If the annual turnover exceeds Rs. 5 crores, a full-time Company Secretary must be employed to manage daily affairs.</p>

                        <strong>6. Commercial Space Requirement:</strong>
                        <br>
                        <p>Ans: No, having a commercial or industrial space is not mandatory. A residential address is sufficient.</p>

                        <strong>7. Persons Suited to Form a Producer Company:</strong>
                        <br>
                        <p>Ans: Individuals engaged in primary agriculture activities or activities related to produce will benefit from forming a Producer Company.</p>

                    </ul>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
