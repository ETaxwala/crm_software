@extends('mainlayouts.app')

@section('title', 'Section 8 Company')
@section('page_name', 'Section 8 Company')

@section('content')

    @include('components.service_banner')

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class="sub-title pe-3">Section 8 Company</h5>
                    <p class="mb-4">A Section 8 company is a registered Non-Profit Organization (NPO) functioning as a
                        corporation. Its primary objective is to promote various sectors such as arts, commerce, charity,
                        education, and environmental protection. Profits or income generated are exclusively utilized to
                        further these objectives. Although it operates similarly to a limited company with corresponding
                        rights and obligations, a key distinction is that it is prohibited from using the terms "Section 8"
                        or "Limited" in its name.</p>

                    <p class="mb-4">
                        These entities are registered under the Companies Act and are treated as limited companies without
                        the inclusion of the term "limited" in their names, whether initially registered as private or
                        public limited companies.
                        <br>
                        <br>
                        Section 8 Companies are a legal structure for Non-Profit Organizations (NPOs) or Non-Governmental
                        Organizations (NGOs), granting them the right to operate nationwide.
                    </p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">

                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.3s">


                    <h5 class=" pe-3">Documents Required for Registration:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>Digital Signature Certificate</li>
                        <li>Director Identification Number</li>
                        <li>Memorandum of Association</li>
                        <li>Articles of Association</li>
                        <li>ID proof for members (Aadhar Card, Passport, Voter ID)</li>
                        <li>Passport-size Photographs</li>
                        <li>Director’s details (if Members are other Companies/LLPs)</li>
                        <li>Address Proof</li>
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
                    <h5 class=" pe-3">Section 8 Company Registration Process:</h5>
                    <p class="mb-4">
                        <b>ETaxwala simplifies registration procedures for businesses in India:</b>
                    <ul>
                        <li>
                            - Compliance with the Companies Act, 2013.
                        </li>
                        <li>
                            - Application for a license from the Ministry of Corporate Affairs (MCA).
                        </li>
                        <li>
                            - A minimum of 2 directors for private limited and 3 for public limited companies.
                        </li>
                        <li>
                            - At least one director must be a resident of India.
                        </li>
                        <li>
                            - Initial capital must be invested within 2 months.
                        </li>
                        <li>
                            - Annual filing of accounts, statements, and returns with the Registrar of Companies (ROC).
                        </li>


                    </ul>
                    </p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class=" pe-3">Online Section 8 Company Registration:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>
                            Application of DSC and DPIN.
                        </li>
                        <li>
                            Name approval from MCA.
                        </li>
                        <li>
                            Approval from other authorities, if required.
                        </li>
                        <li>
                            Obtaining Section 8 Company License from MCA.
                        </li>
                        <li>
                            Submission of MOA and AOA to MCA.
                        </li>
                        <li>
                            Receipt of Section 8 Company incorporation certificate.
                        </li>
                        <li>
                            Application for PAN, TAN, and opening a bank account.
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

                        <strong>1. What is the minimum number of directors required for a Section 8 Company?</strong>
                        <br>
                        <p>Ans: A Section 8 company must have a minimum of 2 directors.</p>

                        <strong>2. Who can be the director of a Section 8 Company?</strong>
                        <br>
                        <p>Ans: Any natural person above the age of 18 can become a director of a Section 8 company, and
                            it is not mandatory for the person to be an Indian national.</p>

                        <strong>3. Is it essential to have a non-profit motive to form a Section 8 Company?</strong>
                        <br>
                        <p>Ans: Yes, as per the law, it is mandatory for a Section 8 company to have a non-profit motive.
                        </p>

                        <strong>4. Does a Section 8 Company have a limited life?</strong>
                        <br>
                        <p>Ans: No, a Section 8 company does not necessarily have a limited life. Its existence continues
                            until it achieves its objectives, goes bankrupt, or is involved in fraudulent practices and
                            receives a winding-up order from the government.</p>

                        <strong>5. What is a DIN (Director Identification Number)?</strong>
                        <br>
                        <p>Ans: A DIN is a unique number that identifies a director of a company. It must be mentioned in
                            relevant documentation when a person is appointed as a company director.</p>

                        <strong>6. What is DSC (Digital Signature Certificate)?</strong>
                        <br>
                        <p>Ans: A Digital Signature Certificate (DSC) is an electronic signature in encrypted form. It is
                            used for signing e-forms when filing documents for company registration.</p>



                    </ul>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
