@include('ui.header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">

                <div class="ms-panel-header d-flex justify-content-start">

                    <div class="col-lg-1 col-md-1 col-1">
                        <svg style="cursor: pointer" onclick="showAddEmployee()" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" class="bi bi-plus-circle"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6">
                        <select name="user_id" id="assign_to" class="form-control bg-info text-white"
                            onchange="ChangeStatus()">
                            <option disabled selected>Assign Leads To</option>
                            @foreach ($sales_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->username }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6">
                        <select class="form-control bg-warning text-white" name="is_assign"
                            onchange="GetFilterLeads(this.value)">
                            <option disabled selected>Status</option>
                            <option value="all">All</option>
                            <option value="{{ config('global.assign') }}">ASSIGN</option>
                            <option value="{{ config('global.unassign') }}">UNASSIGN</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6">
                        <button type="button" class="btn btn-danger btn-sm" onclick="showBulkUploadForm()">
                            Bulk Add
                        </button>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                        <a href="{{ url('public/leads_dummy.xlsx') }}" download="leads_dummy.xlsx">
                            <button class="btn btn-primary btn-sm">Sample Excel File</button>
                        </a>
                    </div>
                </div>

                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" /></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Service</th>
                                    <th>Added By</th>
                                    <th>Is Assign</th>
                                    <th>Action</th>

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
                <h5 class="modal-title" id="exampleModalLabel1">Bulk Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="LedgerFrom" method="POST" action="{{route('upload-bulk-leads')}}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Session::get('user_id') }}">
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
<div class="modal fade" id="bulkAdd11" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Bulk Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="addBulkLeadForm11" method="POST" action="{{ route('sm-add-bulk-leads') }}"
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
                <form id="addNewEmployee" class="row g-3" action="{{ route('add-sales-lead') }}" method="POST"
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
                                <select name="service" id="" class="form-control js-select2">
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
<div class="modal fade" id="editEmployee" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Edit Details</h5>
            </div>
            <div class="modal-body">
                <form id="updateEmployee" class="row g-3" action="{{ route('Update-Sales-Lead') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <input type="hidden" id="lead_id" name="lead_id" value="">
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="" class="visually-hidden">Name</label>
                                <input value="" type="text" class="form-control" name="name"
                                    id="name" placeholder="Name">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">Email</label>
                                <input value="" type="text" class="form-control" name="email"
                                    id="email" placeholder="Email">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">Contact</label>
                                <input value="" type="text" class="form-control" name="contact"
                                    id="contact" placeholder="Contact">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">Service</label>
                                <select name="service" id="service" class="form-control">
                                    <option selected disabled>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">State</label>
                                <input value="" type="text" class="form-control" name="state"
                                    id="state" placeholder="State">
                            </div>
                            <div class="col-6">
                                <label for="" class="visually-hidden">City</label>
                                <input value="" type="text" class="form-control" name="city"
                                    id="city" placeholder="City">
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@include('ui.footer')
<script type="text/javascript">
    function showAddEmployee() {
        $("#addEmployee").modal('show')
    }

    function showBulkUploadForm() {
        $("#bulkAdd").modal('show')
    }


    $(document).ready(function() {
        $(".js-select2").select2({
            closeOnSelect: false
        });
    });


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
            ajax: "{{ route('sales-manage-leads') }}",

            columns: [{
                    data: 'mark',
                    name: 'mark',
                    "searchable": false,
                    "orderable": false,
                },
                {
                    data: 'name',
                    name: 'name',
                    "searchable": true,
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
                    name: 'mark3',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark2',
                    name: 'mark2',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'is_assign',
                    name: 'is_assign',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.assign') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Assign</span>"
                        } else {
                            return "<span class='badge bg-danger me-1 text-white'>Un-Assign</span>";
                        }

                    },
                    "orderable": false,
                    "class": 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    "searchable": false,
                    "orderable": false,
                },



            ]
        });
        // setInterval(function() {
        //     table.ajax.reload();
        // }, 10000);

    });


    // get user details
    function SalesLeadDetails(lead_id) {
        // console.log(lead_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Sales-Lead-Details') }}",
            data: {
                lead_id: lead_id
            },
            success: function(data) {

                console.log(data);
                $.each(data, function(index, item) {


                    $.each(item.details, function(index, item1) {
                        // console.log(item1);
                        $("#lead_id").val(item1.id);
                        $("#name").val(item1.name);
                        $("#contact").val(item1.contact);
                        $("#email").val(item1.email);
                        $("#service").val(item1.service);
                        $("#state").val(item1.state);
                        $("#city").val(item1.city);





                    });
                });
                $("#editEmployee").modal('show')
            }
        });

    }

    // update data
    $(document).ready(function() {
        $('#updateEmployee').on('submit', function(e) {
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
                    console.log('data added');
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

    function DeleteSalesLead(lead_id) {
        // alert(lead_id)
        $.ajax({
            type: "get",
            url: "{{ route('Delete-Sales-Lead') }}",
            data: {
                lead_id: lead_id
            },
            success: function(data) {
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('Lead Deleted!!!');

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
                url: "{{ route('sales-manage-leads-filter') }}",
                data: {
                    lead_status: lead_status,
                },
            },

            columns: [{
                    data: 'mark',
                    name: 'mark',
                    "searchable": false,
                    "orderable": false,
                },
                {
                    data: 'name',
                    name: 'name',
                    "searchable": true,
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
                    name: 'mark3',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark2',
                    name: 'mark2',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'is_assign',
                    name: 'is_assign',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.assign') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Assign</span>"
                        } else {
                            return "<span class='badge bg-danger me-1 text-white'>Un-Assign</span>";
                        }

                    },
                    "orderable": false,
                    "class": 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    "searchable": false,
                    "orderable": false,
                },



            ]
        });
    }
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
                    console.log(response);


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
