@extends('mainlayouts.app')

@section('title', 'Partnership Firm Registration')
@section('page_name', 'Partnership Firm Registration')

@section('content')

    @include('components.service_banner')

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class="sub-title pe-3">Partnership Firm Registration</h5>
                    <p class="mb-4">The Indian Partnership Act of 1932 governs the formation and functioning of a
                        partnership firm in India. A partnership involves multiple individuals bound by a legal agreement
                        defining their roles, duties, and profit-sharing ratios. Each partner shares profits and is
                        personally liable for losses incurred.</p>

                </div>

            </div>
            <br><br><br>
            <div class="row g-5">

                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.3s">


                    <h5 class=" pe-3">Documents Required for Registration:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>Statement in Form 1 along with the specified fees.</li>
                        <li>Notarized True Copy of the **Partnership Deed** stating:</li>
                        <ul>
                            <li>Firm's name</li>
                            <li>Nature of business</li>
                            <li>Principal business location</li>
                            <li>Other business locations</li>
                            <li>Partners' details (names, addresses)</li>
                            <li>Date of joining</li>
                            <li>Duration of the firm</li>
                            <li>Proof of ownership or lease of business location</li>
                        </ul>
                        <li>PAN Card of partners.</li>
                        <li>Copy of Aadhaar Card/Voter Identity Card</li>
                        <li>Address Proof of partners (Aadhar Card, Driver's License, Passport, or Voter ID).</li>
                        <li>PAN Card of the firm.</li>
                        <li>Address Proof of the firm (Rent agreement, utility bills for rented or owned premises).</li>
                    </ul>
                    </p>

                </div>
                <div class="col-xl-5 wow fadeInRight " data-wow-delay="0.1s">
                    {{-- <div class="bg-light rounded">
                        <img src="img/service-8.jpg" class=" w-100" style="margin-bottom: -7px;" alt="Image">
                    </div> --}}
                    @include('components.mini_inquiry_form')
                </div>
            </div>
            <br><br><br>
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class=" pe-3">Detailed Documents Needed for Partnership Firm Registration:</h5>
                    <p class="mb-4">
                    <ul>
                        <li>
                            <strong>Partnership Deed:</strong> An agreement defining rights and duties of partners.
                        </li>
                        <li>
                            <strong>Partners' Documents:</strong> PAN Cards and Address Proofs of partners.
                        </li>
                        <li>
                            <strong>Firm's PAN Card:</strong> Essential for tax purposes.
                        </li>
                        <li>
                            <strong>Firm's Address Proof:</strong> Utility bills or property documents.
                        </li>
                        <li>
                            <strong>Additional Documents:</strong> GST Registration, Bank Account details, and Partnership
                            Registration
                            Certificate if applicable.
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
                            <strong>Partnership Form and Document Verification:</strong> ETaxwala assists in filling forms
                            and verifies required documents.
                        </li>
                        <li>
                            <strong>Drafting Partnership Deed:</strong> Creation of the legal partnership agreement.
                        </li>
                        <li>
                            <strong>PAN, TAN Application:</strong> Application for PAN and TAN.
                        </li>
                        <li>
                            <strong>Current Bank Account:</strong> Assistance in opening a current bank account.
                        </li>
                        <li>
                            <strong>Completion:</strong> Access and download Partnership Deed and relevant documents.
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

                        <strong>Q. Who can form a partnership firm?</strong>
                        <br>
                        <p>Ans: ETaxwala assists in filling forms and verifies required documents.</p>

                        <strong>Q. Is a partnership firm a separate legal entity?</strong>
                        <br>
                        <p>Ans: No, it doesn't have a separate legal identity.</p>

                        <strong>Q. Is registration mandatory?</strong>
                        <br>
                        <p>Ans: No, but recommended for legal advantages.</p>

                        <strong>Q. How many partners are required?</strong>
                        <br>
                        <p>Ans: Minimum of 2, maximum of 10 (banking) or 20 (other businesses).</p>

                        <strong>Q. Is there a minimum capital requirement?</strong>
                        <br>
                        <p>Ans: No, except for maintaining a bank account balance.</p>

                        <strong>Q. Is audit mandatory?</strong>
                        <br>
                        <p>Ans: No statutory requirement, but tax audit if turnover exceeds limits</p>

                        <strong>Q. Can ownership interest be transferred?</strong>
                        <br>
                        <p>Ans: Restricted transfer among existing partners with unanimous consent</p>

                    </ul>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
