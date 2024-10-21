@include('ui.header')
<style>
    #service-price {
        display: none;
    }
</style>
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

                    <button type="button" class="btn btn-dark mb-2" name="button"
                        onclick="GetFollowupCallsFilter()">Todays
                        Followup Call <span class="badge badge-pill badge-outline-dark"
                            id="todays_followup_call">0</span></button>

                </div>
            </div>
        </div>

        <div class="col-md-12">

            <div class="ms-panel">

                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Manage Lead's</h6>


                    <div class="col-lg-2 col-md-3 col-6">
                        <select name="user_id" id="assign_to" class="form-control bg-info text-white"
                            onchange="ChangeStatus()">
                            <option disabled selected>Assign Leads To</option>
                            @foreach ($sales_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->username }}</option>
                            @endforeach

                        </select>
                    </div>
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
                                    <th><input type="checkbox" id="checkAll" /></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>F Date</th>
                                    <th>Contact</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Service</th>
                                    <th>Added By</th>
                                    <th>assign_to</th>
                                    <th>Assign Date</th>
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

{{-- lead details --}}






{{-- Add Employee Modal --}}
<div class="modal fade" id="addEmployee" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Add New Lead</h5>
            </div>
            <div class="modal-body">
                <form id="addNewEmployee" class="row g-3" action="{{ route('add-sales-emp-lead') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="" class="visually-hidden">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Contact">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">Service</label>
                                <select name="service" id="" class="form-control">
                                    <option selected disabled>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">State</label>
                                <input type="text" class="form-control" name="state" placeholder="State">
                            </div>
                            <div class="col-6">
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


<div class="modal fade" id="leadDetails" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
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
                                    action="{{ route('update-sales-emp-lead') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <input type="hidden" id="lead_id" name="lead_id" value="">
                                        <div class="row g-3">
                                            <div class="col-auto">
                                                <label for="" class="visually-hidden">Name</label>
                                                <input value="" type="text" class="form-control"
                                                    name="name" id="name" placeholder="Name">
                                            </div>
                                            <div class="col-auto">
                                                <label for="" class="visually-hidden">Email</label>
                                                <input value="" type="text" class="form-control"
                                                    name="email" id="email" placeholder="Email">
                                            </div>
                                            <div class="col-auto">
                                                <label for="" class="visually-hidden">Contact</label>
                                                <input value="" type="text" class="form-control"
                                                    name="contact" id="contact" placeholder="Contact">
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="visually-hidden">Service</label>
                                                <select name="service" id="service" class="form-control">
                                                    <option selected disabled>Select Service</option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->service_id }}">
                                                            {{ $service->service_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <label for="" class="visually-hidden">State</label>
                                                <input value="" type="text" class="form-control"
                                                    name="state" id="state" placeholder="State">
                                            </div>
                                            <div class="col-auto">
                                                <label for="" class="visually-hidden">City</label>
                                                <input value="" type="text" class="form-control"
                                                    name="city" id="city" placeholder="City">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Update Lead</button>
                                        <a id="dynamicLink" href="#" class='btn btn-success btn-sm'>Create
                                            Quotation</a>
                                        <a id="dynamicLink2" href="#" class='btn btn-info btn-sm'>View</a>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                <form id="updateLeadStatus" class="row g-3"
                                    action="{{ route('update-lead-status') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <input type="hidden" id="lead_id2" name="lead_id2" value="">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Lead Status</label>
                                                <select class="form-control" name="lead_status" id="lead_status"
                                                    onchange="ServicePrice(this.value)">
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
                                                </select>
                                            </div>
                                            <br><br><br><br>
                                            <div class="col-12" id="service-price">
                                                <label for="" class="visually-hidden">Service Price <span
                                                        style="color: red">*</span></label>
                                                <input name="service_price" type="text"
                                                    class="form-control shadow-none">
                                                <label for="" class="visually-hidden">Payment Status<span
                                                        style="color: red">*</span></label>
                                                <select name="payment_status" id=""
                                                    class="form-control shadow-none">
                                                    <option selected disabled>Payment Status</option>
                                                    <option value="{{ config('global.paid') }}">Paid</option>
                                                    <option value="{{ config('global.unpaid') }}">Unpaid</option>
                                                    <option value="{{ config('global.pending') }}">Pending</option>
                                                    <option value="{{ config('global.cancle') }}">Cancle</option>
                                                </select>

                                            </div>
                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Lead Remark</label>
                                                <textarea class="form-control" name="lead_remark" id="lead_remark" cols="30" rows="3"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Last Lead Remark</label>
                                                <textarea id="lastLeadRemark" class="form-control" disabled name="" id="" cols="6"
                                                    rows="2"></textarea>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade " id="tab3">
                                <form id="addLeadFollowup" class="row g-3" action="{{ route('add-lead-followup') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <input type="hidden" id="lead_id3" name="lead_id3" value="">
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
                                            <div class="col-12">
                                                <label for="" class="visually-hidden">Last Followup
                                                    Remark</label>
                                                <textarea id="lastFollowupRemark" class="form-control" disabled name="" id="" cols="6"
                                                    rows="2"></textarea>
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
            url: "{{ route('get-emp-followup-calls-details') }}",

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
            url: "{{ route('get-emp-followup-calls-details') }}",

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


    function GetFollowupCallsFilter() {
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
                url: "{{ route('sales-manager-followup-lead-filter') }}",

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
                    data: 'lfd',
                    name: 'lfd',
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
                    name: 'mark3',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark4',
                    name: 'added_by',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'assign_to',
                    name: 'assign_to',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'date',
                    name: 'date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'lead_status',
                    name: 'lead_status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.notconnected') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not Connected</span>"
                        }
                        if (data == Number(
                                "{{ config('global.notintrested') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not-Intrested</span>"
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
                },



            ]
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
            ajax: "{{ route('sales-manage-leads-details') }}",

            columns: [{
                    data: 'checkmark',
                    "className": "text-center",
                    "searchable": false,
                    "orderable": false,
                },
                {
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
                    data: 'lfd',
                    name: 'lfd',
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
                    name: 'mark3',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark4',
                    name: 'added_by',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'assign_to',
                    name: 'assign_to',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'date',
                    name: 'date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'lead_status',
                    name: 'lead_status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.notconnected') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not Connected</span>"
                        }
                        if (data == Number(
                                "{{ config('global.notintrested') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Not-Intrested</span>"
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
                },



            ]
        });


    });



    // lead details for update status
    function SalesLeadDetails2(lead_id) {
        console.log(lead_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Sales-Lead-Details') }}",
            data: {
                lead_id: lead_id
            },
            success: function(data) {

                $.each(data, function(index, item) {
                    if (item.lastfollowupremark == null) {
                        $('#lastFollowupRemark').html('No Remark Found');
                    }
                    if (item.lastleadremark == null) {
                        $('#lastLeadRemark').html('No Remark Found');
                    }
                    $.each(item.lastfollowupremark, function(index, lfr) {
                        // console.log('my data => ' + lfr);
                        $('#lastFollowupRemark').html(lfr);
                    });
                    $.each(item.lastleadremark, function(index, llr) {
                        // console.log('my data => ' + llr);
                        $('#lastLeadRemark').html(llr);
                    });
                    $.each(item.details, function(index, item1) {

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

                        var link = document.getElementById('dynamicLink');
                        link.href = `/create-quotation/${item1.id}`;

                        var link2 = document.getElementById('dynamicLink2');
                        link2.href = `/view-quotation/${item1.id}`;

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
                        toastr.warning(response.message);
                        document.getElementById("service-price").style.display = 'none'
                        GetLeadCount();
                        GetFollowupCallsCount();
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById("service-price").value = '';
                        document.getElementById('lead_remark').value = '';
                        document.getElementById('lead_status').selectedIndex = 0;

                    } else {
                        document.getElementById("service-price").style.display = 'none'
                        GetLeadCount();
                        GetFollowupCallsCount();
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById("service-price").value = '';
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


    // function DeleteSalesLead(lead_id) {
    //     // alert(lead_id)
    //     $.ajax({
    //         type: "get",
    //         url: "",
    //         data: {
    //             lead_id: lead_id
    //         },
    //         success: function(data) {
    //             $('.data-table').DataTable().ajax.reload(null, false);
    //             toastr.success('Lead Deleted!!!');

    //         }
    //     });
    // }

    // get lead remarks

    function GetRemarks(lead_id) {

        // alert(lead_id)
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Lead-Remarks-details') }}",
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


    function ChangeStatus() {
        var selected = [];
        $('input:checked').each(function() {
            // console.log($(this).val());
            if ($(this).val() != 'on') {
                selected.push($(this).val());
            }

        });
        var user_id = document.getElementById('assign_to').value;
        // alert(user_id)
        // console.log(selected);
        if (selected.length > 0) {
            $.ajax({
                type: "GET",
                url: "{{ route('assign-sales-lead-to') }}",
                data: {
                    selected: selected,
                    user_id: user_id,
                },
                success: function(data) {
                    if (data['success'] == true) {
                        Swal.fire(
                            'Well Done?',
                            'Lead Assign successfully.?',
                            'success'
                        )
                        $('.data-table').DataTable().ajax.reload(null, false);
                        document.getElementById('assign_to').selectedIndex = 0

                    } else {
                        Swal.fire(
                            'Somthing went wronge?',
                            data['message'],
                            'error'
                        )
                    }
                }

            })
        } else {
            Swal.fire(
                'Somthing went wronge?',
                'Nothing is selected.?',
                'error'
            )
        }
    }


    function GetFilterLeads(v) {
        var lead_status = v;
        console.log(v);

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
                url: "{{ route('sales-emp-lead-filter-details') }}",
                data: {
                    lead_status: lead_status,
                },
            },

            columns: [

                {
                    data: 'checkmark',
                    "className": "text-center",
                    "searchable": false,
                    "orderable": false,
                },
                {
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
                    data: 'lfd',
                    name: 'lfd',
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
                    name: 'mark3',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark4',
                    name: 'added_by',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'assign_to',
                    name: 'assign_to',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'date',
                    name: 'date',
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
                            return "<span class='badge bg-warning me-1 text-white'>Negotiation</span>"
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
                },




            ]
        });
    }

    function GetLeadCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-emp-lead-count-details') }}",

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

    function ServicePrice(id) {
        // console.log(id);
        if (id == 5) {
            document.getElementById("service-price").style.display = 'block'
        }
    }
</script>
