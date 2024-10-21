@extends('mainlayouts.app')

@section('title', 'Private Limited Company Registration')
@section('page_name', 'Private Limited Company Registration')

@section('content')

    @include('components.service_banner')

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class="sub-title pe-3">Private Limited Company Registration</h5>
                    <p class="mb-4">A private limited company is a privately held corporation primarily designed for small
                        businesses. In India, the legal responsibility of its members is limited to the shares they hold.
                        The shares of a private limited company are not publicly traded and can fall into three categories:
                        limited by shares, limited by guarantee, and unlimited.</p>
                    <p class="mb-4">
                        Setting up a private limited company involves specific ROC (Registrar of Companies) compliance,
                        incurring an additional annual cost ranging from Rs. 5,000 to 10,000. The company necessitates a
                        minimum capital of Rs. 100,000 and can have a maximum of 200 members.
                    </p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">

                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.3s">


                    <h5 class=" pe-3">Documents Required for Registration:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>PAN Card copies of directors</li>
                        <li>Utility bills for the business premise</li>

                        <li>Passport-size photos of directors</li>
                        <li>Aadhaar Card/Voter ID copies of directors</li>
                        <li>Rent agreement copy (for rented property)</li>
                        <li>Property papers copy (for owned property)</li>
                        <li>Landlord's No Objection Certificate (NOC)</li>
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
                    <h5 class=" pe-3">Registration Steps:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>
                            <strong>Application for DSC and DIN:</strong> Each partner needs to apply for a Digital Signature and Director Identification Number.
                        </li>
                        <li>
                            <strong>Name Approval:</strong> Provide three name options to the Ministry of Corporate Affairs, ensuring uniqueness and relevance to the business.
                        </li>
                        <li>
                            <strong>MOA and AOA Submission:</strong> Draft the Memorandum of Association and Articles of Association upon approval of the company name.
                        </li>
                        <li>
                            <strong>Incorporation Certificate:</strong> It takes about 15-25 days to obtain the certificate confirming the company's formation, including the Corporate Identification Number (CIN).
                        </li>
                        <li>
                            <strong>PAN, TAN, and Bank Account Application:</strong> Apply for PAN and TAN, and then use the obtained certificates along with incorporation documents to open a bank account.
                        </li>

                    </ul>
                    </p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class=" pe-3">Registration Process:</h5>
                    <p class="mb-4">
                        <b>ETaxwala simplifies registration procedures for businesses in India:</b>
                    <ul>
                        <li>
                            Obtain DSC & DIN
                        </li>
                        <li>
                            Name Approval
                        </li>
                        <li>
                            MoA and AoA Submission
                        </li>
                        <li>
                            Certificate of Incorporation, PAN, TAN, Bank Account
                        </li>
                        <li>
                            Congratulations on completing the process!
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

                        <strong>1) Is it mandatory to deposit Share capital at the time of company Incorporation?</strong>
                        <br>
                        <p>Ans: No, share capital can be deposited within two months after the registration process and bank account opening.</p>

                        <strong>2) Does a Private Limited (PVT LTD) Company require yearly renewal?</strong>
                        <br>
                        <p>Ans: No, a PVT. LTD. Company continues its existence until officially closed down by its owners.</p>

                        <strong>3) Can the company address be changed after Incorporation?</strong>
                        <br>
                        <p>Ans: Yes, the company address can be changed post Incorporation.</p>

                        <strong>Q. How many partners are required?</strong>
                        <br>
                        <p>Ans: Minimum of 2, maximum of 10 (banking) or 20 (other businesses).</p>

                        <strong>4) Can PVT LTD Companies trade shares?</strong>
                        <br>
                        <p>Ans: No, as privately owned companies, PVT. LTD. companies cannot trade shares publicly.</p>

                        <strong>5) What is the qualification for an individual to be a shareholder or director of a PVT LTD Company?</strong>
                        <br>
                        <p>Ans: There's no mandatory qualification for individuals to be shareholders or directors. Any individual can assume these roles.</p>

                        <strong>6) What is a DIN (Director Identification Number)?</strong>
                        <br>
                        <p>Ans: A DIN uniquely identifies a company director and must be mentioned in relevant documentation upon appointment.</p>

                        <strong>7) What is a DSC (Digital Signature Certificate)?</strong>
                        <br>
                        <p>Ans: A DSC is an encrypted electronic signature used for signing e-forms during company registration.</p>
                    </ul>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
