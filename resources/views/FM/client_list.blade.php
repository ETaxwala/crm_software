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
                    <div class="col-md-3">
                        <select name="" id="" class="form-control" onchange="PartnerFilter(this.value)">
                            <option selected disabled>Select Partner</option>
                            <option value="all">All</option>
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->username }}</option>
                            @endforeach
                        </select>
                    </div>
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
            url: "{{ route('get-today-followup-calls') }}",

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
            url: "{{ route('get-client-followup-calls') }}",

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
            ajax: "{{ route('franchise-client-list') }}",

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
                    data: 'service',
                    name: 'service',
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
                                "{{ config('global.intrested') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Intrested</span>"
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


    // get lead remarks

    function GetRemarks(lead_id) {

        // alert(lead_id)
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Lead-Remarks') }}",
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
                url: "{{ route('franchise-client-lead-filter') }}",
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
                    data: 'service',
                    name: 'service',
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
                                "{{ config('global.intrested') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Intrested</span>"
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
            url: "{{ route('get-client-lead-count') }}",

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
                })

            }
        });
    }

    function PartnerFilter(v) {
        var p_id = v;

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
                url: "{{ route('partner-wise-lead-filter') }}",
                data: {
                    p_id: p_id,
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
                    data: 'service',
                    name: 'service',
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
                                "{{ config('global.intrested') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Intrested</span>"
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
</script>
