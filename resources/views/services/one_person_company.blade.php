@extends('mainlayouts.app')

@section('title', 'One Person Company Registration')
@section('page_name', 'One Person Company Registration')

@section('content')

    @include('components.service_banner')

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class="sub-title pe-3">One Person Company Registration</h5>
                    <p class="mb-4">In 2013, the Companies Act introduced the concept of a one-person company (OPC) with
                        the aim of aiding individuals in initiating their ventures independently. It permits the
                        establishment of a single-person economic entity, a notable advantage being that only one member is
                        allowed in an OPC. In contrast, a minimum of two members is required for forming and maintaining a
                        Private Limited Company or a Limited Liability Partnership.</p>

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
                    @include('components.mini_inquiry_form')
                </div>
            </div>
            <br><br><br>
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class=" pe-3">Registration Steps:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>

                            <strong>Obtain DSC:</strong> Get a Digital Signature Certificate for the proposed Director.
                        </li>
                        <li>

                            <strong>Apply for DIN:</strong> Apply for Director Identification Number for the proposed
                            Director.
                        </li>
                        <li>

                            <strong>Name Approval:</strong> Choose and get the company name approved by the MCA.
                        </li>
                        <li>

                            <strong>Document Preparation:</strong> Prepare documents including MoA, AoA, nominee details,
                            office proof, affidavits, and compliance declaration.
                        </li>
                        <li>

                            <strong>Filing with MCA:</strong> Upload documents using SPICe Form and other necessary forms to
                            the MCA site for approval.
                        </li>
                        <li>

                            <strong>Certificate Issuance:</strong> Upon verification, the Registrar of Companies issues a
                            Certificate of Incorporation.
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

                        <strong>1. Is Share capital mandatory during company incorporation?</strong>
                        <br>
                        <p>Ans: No, it's not mandatory. Share capital can be deposited within two months after the
                            completion of the registration process and the opening of a bank account.</p>

                        <strong>2. Does an OPC need yearly renewal?</strong>
                        <br>
                        <p>Ans: No, an OPC continues its existence until officially closed down. However, it must file basic
                            annual returns with the Registrar of Companies (RoC).
                        </p>

                        <strong>3. Can the company's address be changed post incorporation?</strong>
                        <br>
                        <p>Ans: Yes, the company's address can be changed at any time after incorporation.</p>

                        <strong>4. Can an OPC trade shares?</strong>
                        <br>
                        <p>Ans: No, as a privately owned company, shares of an One Person Company cannot be traded in the
                            public domain.</p>

                        <strong>5. Who can become a member of an OPC?</strong>
                        <br>
                        <p>Ans: Any natural or juristic person, including NRIs and foreigners, can become a member of an One
                            Person Company.</p>

                        <strong>6. What is a DIN?</strong>
                        <br>
                        <p>Ans: A Director Identification Number (DIN) is a unique identifier for company directors, which
                            must be mentioned in relevant documentation when someone becomes a director.</p>

                        <strong>7. What is a DSC?</strong>
                        <br>
                        <p>Ans: A Digital Signature Certificate (DSC) is an encrypted electronic signature used for signing
                            e-forms during company registration filings.</p>

                        <strong>8. Are there specific compliance requirements for OPCs?</strong>
                        <br>
                        <p>Ans: Yes, for every contract an OPC enters into with its sole member (also the director), the RoC
                            must be informed within 15 days of contract approval. Additionally, an OPC limited by shares
                            cannot transfer shares or invite the public to subscribe to its securities.</p>


                        <strong>9. Can one register more than one OPC at a time?</strong>
                        <br>
                        <p>Ans: No, an individual can register only one OPC at a time, and this rule extends to the nominee
                            of an OPC as well.</p>
                    </ul>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
