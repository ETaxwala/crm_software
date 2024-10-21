@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel ms-panel-fh ms-btn-display">
                <div class="ms-panel-header">
                    <button onclick="GetFilterLeads('all')" type="button" class="btn btn-primary mb-2" name="button">Total
                        <span class="badge badge-pill badge-outline-primary" id="total_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.new') }}')" type="button"
                        class="btn btn-secondary mb-2" name="button">New <span
                            class="badge badge-pill badge-outline-secondary" id="new_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.notintrested') }}')" type="button"
                        class="btn btn-danger mb-2" name="button">Not Intrested <span
                            class="badge badge-pill badge-outline-danger" id="notintrested_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.intrested') }}')" type="button"
                        class="btn btn-info mb-2" name="button">Intrested <span
                            class="badge badge-pill badge-outline-info" id="intrested_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.quotation') }}')" type="button"
                        class="btn btn-dark mb-2" name="button">Quotation <span
                            class="badge badge-pill badge-outline-dark" id="quotation_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.hot') }}')" type="button"
                        class="btn btn-warning mb-2" name="button">Hot <span
                            class="badge badge-pill badge-outline-warning" id="hot_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.customer') }}')" type="button"
                        class="btn btn-dark mb-2" name="button">Customer <span
                            class="badge badge-pill badge-outline-dark" id="customer_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.notconnected') }}')" type="button"
                        class="btn btn-dark mb-2" name="button">Not Connected <span
                            class="badge badge-pill badge-outline-dark" id="notconnected_leads"></span></button>

                    <button onclick="GetFilterLeads('{{ config('global.negotiation') }}')" type="button"
                        class="btn btn-dark mb-2" name="button">Negotiation <span
                            class="badge badge-pill badge-outline-dark" id="negotiation_leads"></span></button>

                    <button type="button" class="btn btn-dark mb-2" name="button" onclick="GetFollowupCalls()">Todays
                        Followup Call <span class="badge badge-pill badge-outline-dark"
                            id="todays_followup_call"></span></button>

                </div>
            </div>
        </div>

        <div class="col-md-12">

            <div class="ms-panel">

                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Manage Lead's</h6>
                    <!--<span class="btn btn-sm btn-danger" data-bs-toggle="modal"-->
                    <!--data-bs-target="#bulkAdd">Bulk Upload</span>-->
                    <!--    <a href="{{ url('public/leads_dummy.xlsx') }}" download="upload_leads.xlsx">-->
                    <!--        <button class="btn btn-primary btn-sm">Sample Excel File</button>-->
                    <!--    </a>-->

                    <svg style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#addEmployee"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                </div>

                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Service</th>
                                    <th>Added By</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="modal fade" id="bulkAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Bulk Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="addBulkLeadForm123" method="POST" action="{{ route('fe-add-bulk-leads') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label" for="basic-default-fullname">Select File</label>
                            <input name="file" id="fileInput" type="file" class="form-control" placeholder=""
                                required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Add Lead</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Employee Modal --}}
<div class="modal fade" id="addEmployee" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Add New Lead</h5>
            </div>
            <div class="modal-body">
                <form id="addNewEmployee" class="row g-3" action="{{ route('add-f-emp-lead') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row g-3">
                            <div class="col-auto">
                                <label for="" class="visually-hidden">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="col-auto">
                                <label for="" class="visually-hidden">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col-auto">
                                <label for="" class="visually-hidden">Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Contact">
                            </div>
                            <div class="col-5">
                                <label for="" class="visually-hidden">Service</label>
                                {{-- <input type="text" class="form-control" name="service" placeholder="Service"> --}}
                                <select class="form-control" name="service" id="">
                                    <option selected disabled>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="" class="visually-hidden">State</label>
                                <input type="text" class="form-control" name="state" placeholder="State">
                            </div>
                            <div class="col-auto">
                                <label for="" class="visually-hidden">City</label>
                                <input type="text" class="form-control" name="city" placeholder="City">
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>

                        <br>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


{{-- lead details for update status --}}

<div class="modal fade" id="leadDetails" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Lead Details</h5>
            </div>
            <div class="modal-body">
                <div class="ms-panel ms-panel-fh">

                    <div class="ms-panel-body">
                        <ul class="nav nav-tabs tabs-bordered d-flex nav-justified mb-4" role="tablist">
                            <li role="presentation"><a href="#tab1" aria-controls="tab1" class="active show"
                                    role="tab" data-toggle="tab" aria-selected="true"> Client Info </a></li>
                            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab"
                                    data-toggle="tab" class="" aria-selected="false"> Update Status </a></li>
                            <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab"
                                    data-toggle="tab" class="" aria-selected="false"> Followup </a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="tab1">
                                <form id="updateLeadDetails" class="row g-3"
                                    action="{{ route('update-f-emp-lead') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <input type="hidden" id="lead_id" name="lead_id" value="">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">Name</label>
                                                <input value="" type="text" class="form-control"
                                                    name="name" id="name" placeholder="Name">
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">Email</label>
                                                <input value="" type="text" class="form-control"
                                                    name="email" id="email" placeholder="Email">
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">Contact</label>
                                                <input value="" type="text" class="form-control"
                                                    name="contact" id="contact" placeholder="Contact">
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">Service</label>
                                                <input value="" type="text" class="form-control"
                                                    name="service" id="service" placeholder="Service">
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">State</label>
                                                <input value="" type="text" class="form-control"
                                                    name="state" id="state" placeholder="State">
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">City</label>
                                                <input value="" type="text" class="form-control"
                                                    name="city" id="city" placeholder="City">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                <form id="updateLeadStatus" class="row g-3"
                                    action="{{ route('update-f-lead-status') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <input type="hidden" id="lead_id2" name="lead_id2" value="">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Lead Status</label>
                                                <select class="form-control" name="lead_status" id="lead_status"
                                                    onchange="showCustomerForm(this.value)">
                                                    <option disabled selected>Select Status</option>
                                                    <option value="{{ config('global.notconnected') }}">NOT CONNECTED
                                                    </option>
                                                    <option value="{{ config('global.notintrested') }}">NOT INTRESTED
                                                    </option>
                                                    <option value="{{ config('global.intrested') }}">INTRESTED
                                                    </option>
                                                    <option value="{{ config('global.negotiation') }}">NEGOTIATION
                                                    </option>
                                                    <option value="{{ config('global.quotation') }}">QUOTATION
                                                    </option>
                                                    <option value="{{ config('global.hot') }}">HOT</option>
                                                    <option value="{{ config('global.customer') }}">CUSTOMER</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Lead Remark</label>
                                                <textarea class="form-control" name="lead_remark" id="lead_remark" cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade " id="tab3">
                                <form id="addLeadFollowup" class="row g-3"
                                    action="{{ route('add-f-lead-followup') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <input type="hidden" id="lead_id2" name="lead_id2" value="">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Followup Date</label>
                                                <input value="" type="date" class="form-control"
                                                    name="followup_date" id="followup_date" placeholder="date">
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Followup Remark</label>
                                                <textarea class="form-control" name="followup_remark" id="followup_remark" cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- lead remarks --}}
<div class="modal fade" id="UserLeadRemarks" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="UserLeadRemarksLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="UserLeadRemarksLabel">Lead Remarks</h5>
            </div>
            <div class="modal-body">
                <table class="table ">
                    <tbody id="remakrs">


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- todays followup calls --}}
<div class="modal fade" id="FollowupCalls" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="FollowupCallsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="FollowupCallsLabel">Today's Followup Calls</h5>
            </div>
            <div class="modal-body">
                <table class="table ">
                    <tbody id="FCalls">


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="addCustomer" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCustomerLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="addCustomerLabel">Add New Customer11</h5>
            </div>
            <div class="modal-body">
                <form id="addOfflineCustomer11" action="{{ route('franchise-add-offline-customer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="lead_id3" name="lead_id3" value="">

                    <div class="row">
                        <div class="col-md-4">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" placeholder="Customer Name"
                                name="customer_name" id="customer_name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Business Name">Company/Shop Name</label>

                            <input type="text" class="form-control" placeholder="Company/Shop Name"
                                name="customer_businessName" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Email">Email</label>

                            <input type="text" class="form-control" placeholder="Email" name="customer_email"
                                id="customer_email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Mobile">Mobile No</label>

                            <input type="text" class="form-control" placeholder="Mobile No"
                                name="customer_mobile" id="customer_mobile" required>
                        </div>
                        <div class="col-md-4">
                            <label for="State">State</label>

                            <input type="text" class="form-control" placeholder="State" name="customer_state"
                                id="customer_state" required>
                        </div>
                        <div class="col-md-4">
                            <label for="City">City</label>

                            <input type="text" class="form-control" placeholder="City" name="customer_city"
                                id="customer_city" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Service">Category</label>
                            <select class="form-control" onchange="GetServices(this.value)" name=""
                                id="" required>
                                <option>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="Service">Service</label>
                            <select class="form-control" onchange="GetServicePrice(this.value)"
                                name="customer_service" id="serviceSelect" required>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="Total Amount">Total Amount</label>

                            <input type="text" id="actual_service_price" readonly class="form-control"
                                placeholder="Total Amount" name="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Apply Coupon">Apply Coupon</label>
                            <input type="text" id="apply_coupon" name="apply_coupon" class="form-control"
                                onchange="applyCouponCode(this.value)" placeholder="enter coupon code if any">
                            <div id="coupon-error"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="Total Amount">Discount Amount</label>

                            <input type="hidden" id="actual_service_price">
                            <input type="text" id="total_service_price" readonly class="form-control"
                                placeholder="Total Amount" name="customer_total_service_price" value="0"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="Payment">Payment Mode</label>
                            <select id="payment_mode" name="customer_payment_mode" class="form-control"
                                onchange="PaymentMode(this.value)" required>
                                <option selected disabled>Select EMI</option>
                                <option value="1">No EMI</option>
                                <option value="2">2 EMI</option>
                                <option value="3">3 EMI</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Total Amount">Paid Amount</label>

                            <input type="text" class="form-control" placeholder="Paid Amount"
                                id="total_paid_amount" onchange="CalculateUnpaidAmount(this.value)"
                                name="customer_paid_amount" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Payment">Unpaid Amount</label>

                            <input type="text" id="total_unpaid_amount" class="form-control"
                                placeholder="Unpaid Amount" name="customer_unpaid_amount" value="0" required
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="Total Amount">Next Due Date</label>

                            <input type="date" id="due_date" class="form-control" placeholder="Due Date"
                                name="customer_due_date" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Payment">Payment Details</label>

                            <textarea class="form-control" name="customer_comment" cols="30" rows="3"
                                placeholder="Payment Details ..." required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="Payment">Upload Payment Screenshot</label>

                            <input class="form-control" type="file" name="payment_screenshot" accept="image/*">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-gradient-info btn-block">Add</button>
                        </div>
                        <div class="col-md-2">
                            <button type="reset" class="btn btn-gradient-danger btn-block"
                                onclick="clearSpan()">Reset</button>
                        </div>
                        @if (session('error'))
                            <div id="flash-message" class="alert alert-danger col-md-6">
                                <p>{{ session('error') }} <button type="button" class="close"
                                        onclick="closeFlashMessage()">&times;</button></p>

                            </div>
                        @endif

                    </div>



                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('ui.footer')
<script type="text/javascript">
    $(document).ready(function() {

        GetLeadCount();
        GetFollowupCallsCount();
    });

    // followup call conut
    function GetFollowupCallsCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-emp-followup-calls') }}",

            success: function(data) {

                $.each(data, function(index, item) {
                    $.each(item, function(index, item1) {
                        var FCCount = item.length;
                        $("#todays_followup_call").html(FCCount);

                    })

                })

            }
        });
    }

    // followup calls details
    function GetFollowupCalls() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-emp-followup-calls') }}",

            success: function(data) {

                // console.log(data);
                var remark = "";
                remark += '<tr>';
                remark += '<td><b>Client Name</b></td>';
                remark += '<td><b>Contact No</b></td>';
                remark += '<td><b>Date</b></td>';
                remark += '<td><b>Remark</b></td>';

                remark += '</tr>';
                $.each(data, function(index, item) {
                    // console.log(item);
                    $.each(item, function(index, item1) {
                        // console.log(item1);
                        var inputDate = new Date(item1.followup_date);
                        remark += '<tr>';
                        remark += '<td>' + item1.name + '</td>';
                        remark += '<td>' + item1.contact + '</td>';
                        remark += '<td>' + inputDate.toLocaleString('en-GB', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        }); +
                        '</td>';
                        remark += '<td>' + item1.followup_remark + '</td>';
                        remark += '</tr>';
                    })
                })

                $('#FCalls').html(remark);
                $("#FollowupCalls").modal('show')

            }
        });
    }

    $(function() {

        $('#checkAll').change(function() {
            $('.checkbox').prop('checked', $(this).prop('checked'));
            console.log();
        });

        $('#table tbody').on('change', '.checkbox', function() {
            // If all checkboxes are checked, update the "check all" checkbox state
            $('#checkAll').prop('checked', $('.checkbox:checked').length === table.rows().count());
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('franchise-employee-manage-clients') }}",

            columns: [{
                    data: 'mark',
                    "className": "text-center",
                    "searchable": false,
                    "orderable": true,
                },
                {
                    data: 'mark2',
                    name: 'mark2',
                    "orderable": false,
                },
                {
                    data: 'email',
                    name: 'email',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'contact',
                    name: 'contact',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'state',
                    name: 'state',
                    "orderable": false,
                },
                {
                    data: 'city',
                    name: 'city',
                    "orderable": false,
                },
                {
                    data: 'mark3',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'added_by',
                    name: 'added_by',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'lead_status',
                    name: 'lead_status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.notintrested') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not-Intrested</span>"
                        }
                        if (data == Number(
                                "{{ config('global.notconnected') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not-Connected</span>"
                        }
                        if (data == Number(
                                "{{ config('global.intrested') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Intrested</span>"
                        }
                        if (data == Number(
                                "{{ config('global.negotiation') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Negotiation</span>"
                        }
                        if (data == Number(
                                "{{ config('global.quotation') }}")) {
                            return "<span class='badge bg-secondary me-1 text-white'>Quotation</span>"
                        }
                        if (data == Number(
                                "{{ config('global.hot') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>Hot</span>"
                        }
                        if (data == Number(
                                "{{ config('global.customer') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Customer</span>"
                        } else {
                            return "<span class='badge bg-success me-1 text-white'>New</span>";
                        }

                    },
                    "orderable": false,
                    "class": 'text-center',
                }



            ]
        });


    });


    // lead details for update status
    function SalesLeadDetails2(lead_id) {
        // console.log(lead_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Sales-Lead-Details') }}",
            data: {
                lead_id: lead_id
            },
            success: function(data) {

                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        // console.log(item1);
                        $("#lead_id").val(item1.id);
                        $("#lead_id2").val(item1.id);
                        $("#lead_id3").val(item1.id);
                        $("#name").val(item1.name);
                        $("#contact").val(item1.contact);
                        $("#email").val(item1.email);
                        $("#service").val(item1.service);
                        $("#state").val(item1.state);
                        $("#city").val(item1.city);

                    });
                });
                $("#leadDetails").modal('show')
            }
        });

    }

    // update data
    $(document).ready(function() {
        $('#updateLeadDetails').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {

                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    // document.getElementById('MainStatusForm').reset();
                    // Show a success toast
                    toastr.success('Lead Updated!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });

    // add data
    $(document).ready(function() {
        $('#addNewEmployee').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    GetLeadCount();
                    GetFollowupCallsCount();
                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('addNewEmployee').reset();
                    // Show a success toast
                    toastr.success('Lead Added!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });

    // update lead status

    $(document).ready(function() {
        $('#updateLeadStatus').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response.message);
                    if (response.success == false) {
                        toastr.error(response.message);
                        document.getElementById('lead_remark').value = '';
                        document.getElementById('lead_status').selectedIndex = 0;

                    } else {
                        GetLeadCount();
                        GetFollowupCallsCount();
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('lead_remark').value = '';
                        document.getElementById('lead_status').selectedIndex = 0;
                        // Show a success toast
                        toastr.success('Remark Added!!!');
                    }
                },
                error: function(error) {
                    // Handle the error response, if needed
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });

    // add lead followup remarks
    $(document).ready(function() {
        $('#addLeadFollowup').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    GetLeadCount();
                    GetFollowupCallsCount();
                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('followup_date').value = '';
                    document.getElementById('followup_remark').value = '';
                    // Show a success toast
                    toastr.success('Followup Added!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });




    // get lead remarks

    function GetRemarks(lead_id) {

        // alert(lead_id)
        $.ajax({
            type: "GET",
            url: "{{ route('Get-F-Lead-Remarks') }}",
            data: {
                lead_id: lead_id
            },
            success: function(data) {

                var remark = "";
                remark += '<tr>';
                remark += '<td><b>Call Notes</b></td>';
                remark += '<td><b>Call Date</b></td>';
                remark += '</tr>';
                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        // console.log(item1);
                        var inputDate = new Date(item1.date);
                        remark += '<tr>';
                        remark += '<td>' + item1.lead_remark + '</td>';
                        remark += '<td>' + inputDate.toLocaleString('en-GB', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        }); +
                        '</td>';
                        remark += '</tr>';
                    });
                });
                $('#remakrs').html(remark);
                $("#UserLeadRemarks").modal('show')
            }
        });
    }



    function GetFilterLeads(v) {
        var lead_status = v;

        $('.data-table').DataTable().destroy();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: {
                url: "{{ route('franchise-emp-lead-filter') }}",
                data: {
                    lead_status: lead_status,
                },
            },

            columns: [{
                    data: 'mark',
                    "className": "text-center",
                    "searchable": false,
                    "orderable": true,
                },
                {
                    data: 'mark2',
                    name: 'mark2',
                    "orderable": false,
                },
                {
                    data: 'email',
                    name: 'email',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'contact',
                    name: 'contact',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'state',
                    name: 'state',
                    "orderable": false,
                },
                {
                    data: 'city',
                    name: 'city',
                    "orderable": false,
                },
                {
                    data: 'mark3',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'added_by',
                    name: 'added_by',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'lead_status',
                    name: 'lead_status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.notintrested') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not-Intrested</span>"
                        }
                        if (data == Number(
                                "{{ config('global.notconnected') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not-Connected</span>"
                        }
                        if (data == Number(
                                "{{ config('global.intrested') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Intrested</span>"
                        }
                        if (data == Number(
                                "{{ config('global.negotiation') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Negotiation</span>"
                        }
                        if (data == Number(
                                "{{ config('global.quotation') }}")) {
                            return "<span class='badge bg-secondary me-1 text-white'>Quotation</span>"
                        }
                        if (data == Number(
                                "{{ config('global.hot') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>Hot</span>"
                        }
                        if (data == Number(
                                "{{ config('global.customer') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Customer</span>"
                        } else {
                            return "<span class='badge bg-success me-1 text-white'>New</span>";
                        }

                    },
                    "orderable": false,
                    "class": 'text-center',
                }



            ]
        });
    }

    function GetLeadCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-f-lead-count') }}",

            success: function(data) {

                // console.log(data);
                $.each(data, function(index, item) {
                    // console.log(item);
                    $("#total_leads").html(item.totalLeads);
                    $("#notintrested_leads").html(item.notintrestedLeads);
                    $("#quotation_leads").html(item.quotationLeads);
                    $("#new_leads").html(item.newLeads);
                    $("#hot_leads").html(item.hotLeads);
                    $("#intrested_leads").html(item.intrestedLeads);
                    $("#customer_leads").html(item.customerLeads);
                    $("#notconnected_leads").html(item.notconnectedLeads);
                    $("#negotiation_leads").html(item.negotiationLeads);
                })

            }
        });
    }

    // GetServicePrice
    function GetServicePrice(cp_id) {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Franchise-Service-Price') }}",
            data: {
                cp_id: cp_id
            },

            success: function(data) {
                $("#total_service_price").val(data.data);
                $("#actual_service_price").val(data.data);


                document.getElementById("payment_mode").selectedIndex = 0;
                document.getElementById("total_paid_amount").value = '';
                document.getElementById("total_unpaid_amount").value = '';
                document.getElementById("due_date").value = '';
                document.getElementById("coupon-error").value = '';
            }
        });
    }


    // Apply Coupon Code
    function applyCouponCode(v) {

        const total_price = document.getElementById("actual_service_price").value;
        // console.log(total_price);
        // alert(total_price)
        if (total_price == null || total_price == '') {
            $("#coupon-error").html(`<span class="msg text-red">select category and service</span>`);
            // document.getElementById('coupon-error').style = 'border';
        } else {
            const coupon_code = v;
            $.ajax({
                url: "{{ url('apply-coupon-code') }}",
                data: {
                    total_price: total_price,
                    coupon_code: coupon_code,
                },
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        $("#coupon-error").html(`<span class="msg text-red">${data.error}</span>`);
                    } else {
                        $("#coupon-error").html(
                            '<span class="msg text-success">Coupon Apply Successfully</span>');
                        $("#total_service_price").val(data);
                    }
                    // $("#total_service_price").val(data);
                    // console.log(data);
                }
            });
        }

    }

    // payment mode
    function PaymentMode(v) {
        const TotalPrice = document.getElementById("total_service_price").value;
        if (v == 1) {
            $("#total_paid_amount").val(TotalPrice);
            $("#total_paid_amount").prop("readonly", true);

            CalculateUnpaidAmount(TotalPrice);
        } else {
            document.getElementById("total_paid_amount").value = '';
            $("#total_paid_amount").prop("readonly", false);

        }
    }

    //  calculate unpaid amount
    function CalculateUnpaidAmount(paid_amount) {

        // console.log(paid_amount);
        const TotalPrice = document.getElementById("total_service_price").value;
        const payment_mode = document.getElementById("payment_mode").value;

        const total_unpaid_amount = TotalPrice - paid_amount;
        $("#total_unpaid_amount").val(total_unpaid_amount);

        if (payment_mode != 1) {
            var currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + 15);
            var futureDate = currentDate.toISOString().slice(0, 10);
            $("#due_date").val(futureDate);
        } else {
            document.getElementById("due_date").value = '';
        }



    }


    // get all services depends on categories
    function GetServices(category_id) {
        $("#serviceSelect").html('');
        $.ajax({
            url: "{{ url('api/fetch-services') }}",
            data: {
                category_id: category_id,
            },
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $('#serviceSelect').html('<option disabled selected>Select Services</option>');
                $.each(result.services, function(key, value) {
                    var badgeText = "";
                    switch (value.cp_type) {
                        case 1:
                            badgeText = '<span class=" badge badge-success">Basic</span>';
                            break;
                        case 2:
                            badgeText =
                                '<span class=" badge badge-secondary">Standard</span>';
                            break;
                        case 3:
                            badgeText = '<span class=" badge badge-warning">Premium</span>';
                            break;
                        case 4:
                            badgeText = '<span class=" badge badge-danger">Diamond</span>';
                            break;
                        default:
                            badgeText = '';
                    }
                    $("#serviceSelect").append('<option value="' + value.cp_id + '">' +
                        value.service_name + ' = ' + badgeText + '</option>');
                    $("#serviceSelect").append(badgeText); // Append badge outside of option
                });
            }
        });
    }

    function showCustomerForm(v) {
        // console.log(v);
        var leadID = document.getElementById('lead_id2').value;
        // console.log(leadID);

        if (v == 5) {
            $.ajax({
                type: "GET",
                url: "{{ route('Get-Lead-Information') }}",
                data: {
                    leadID: leadID
                },

                success: function(data) {
                    // console.log(data);
                    $.each(data, function(index, item1) {
                        // console.log(item1.contact);
                        $("#lead_id3").val(leadID);
                        $("#customer_name").val(item1.name);
                        $("#customer_email").val(item1.email);
                        $("#customer_mobile").val(item1.contact);
                        $("#customer_state").val(item1.state);
                        $("#customer_city").val(item1.city);
                    })

                }
            });
            $("#leadDetails").modal('hide');
            $("#addCustomer").modal('show');
            // console.log(leadID);
        }
    }

    // add new offline customer
    $(document).ready(function() {
        $('#addOfflineCustomer').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success == false) {
                        toastr.error(response.error);
                    } else {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        document.getElementById('addOfflineCustomer').reset();
                        // Show a success toast
                        toastr.success('Customer Added!!!');
                    }

                },
                error: function(response) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error(response.error.message);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#addBulkLeadForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response);


                    if (response.success == true) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('addBulkLeadForm').reset();
                        toastr.success(response.msg);
                    } else {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('addBulkLeadForm').reset();
                        toastr.error(response.msg);
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                }
            });
        });
    });
</script>
<script>
    // Function to close the flash message
    function closeFlashMessage() {
        document.getElementById('flash-message').style.display = 'none';
    }

    // Automatically close the flash message after 5000 milliseconds (5 seconds)
    setTimeout(function() {
        closeFlashMessage();
    }, 5000);
</script>
