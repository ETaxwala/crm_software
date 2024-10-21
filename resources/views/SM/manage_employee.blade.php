@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Manage Employee's</h6>{{Session::get('company_id')}}

                    {{-- <select class="form-control" id="toggleColumns">
                        <option disabled selected>Selecect column</option>
                        <option value="status">Status22</option>
                        <option value="username">name</option>
                    </select> --}}
                    <h6>
                        <svg style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#addEmployee"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            <path fill-rule="evenodd"
                                d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </h6>
                </div>

                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>user status</th>
                                    <th>Date</th>
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
{{-- Add Employee Modal --}}
<div class="modal fade" id="addEmployee" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Add New Employee</h5>
            </div>
            <div class="modal-body">
                <form id="addNewEmployee" class="row g-3" action="{{ route('add-sales-employee') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Name</span>
                            <input type="text" class="form-control shadow-none" name="username" placeholder="Name"
                                value="">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Email</span>
                            <input type="email" class="form-control shadow-none" name="email" placeholder="Email"
                                value="">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Contact</span>
                            <input type="text" class="form-control shadow-none" name="contact" placeholder="Contact"
                                value="">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Password</span>
                            <input type="text" class="form-control shadow-none" name="password"
                                placeholder="Password" value="">
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
<div class="modal fade" id="editEmployee" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Edit Admin</h5>
            </div>
            <div class="modal-body">
                <form id="updateEmployee" class="row g-3" action="{{ route('update-sales-employee') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Name</span>
                            <input type="text" class="form-control shadow-none" id="username" name="username"
                                placeholder="Name" value="">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Email</span>
                            <input type="email" class="form-control shadow-none" id="email" name="email"
                                placeholder="Email" value="">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Contact</span>
                            <input type="text" class="form-control shadow-none" id="contact" name="contact"
                                placeholder="Contact" value="">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Password</span>
                            <input type="text" class="form-control shadow-none" id="password" name="password"
                                placeholder="Password" value="">
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>

                        <br>
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
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('sales-manage-employee') }}",

            columns: [{
                    data: 'username',
                    name: 'username',
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
                    data: 'status',
                    name: 'status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.active') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Active</span>"
                        } else {
                            return "<span class='badge bg-danger me-1 text-white'>De-Active</span>";
                        }

                    },
                    "orderable": false,
                },
                {
                    data: 'is_online',
                    name: 'is_online',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.online') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Online</span>"
                        } else {
                            return "<span class='badge bg-danger me-1 text-white'>Offline</span>";
                        }

                    },
                    "orderable": false,
                },
                {
                    data: 'user_date',
                    name: 'user_date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'action',
                    name: 'action',
                    "searchable": false,
                    "orderable": false,
                },



            ]
        });
        setInterval(function() {
            table.ajax.reload();
        }, 10000);

    });

    // $(function() {

    //     $('#toggleColumns').select2({
    //         // Additional options go here
    //         multiple: true, // Enable multiple selections
    //         placeholder: "Select Columns", // Placeholder text
    //     });








    //     // Initial column configuration
    //     var initialColumns = [{
    //             data: 'username',
    //             name: 'username',
    //             "searchable": true,
    //             "orderable": false
    //         },
    //         {
    //             data: 'email',
    //             name: 'email',
    //             "searchable": true,
    //             "orderable": false
    //         },
    //         {
    //             data: 'contact',
    //             name: 'contact',
    //             "searchable": true,
    //             "orderable": false
    //         },
    //         {
    //             data: 'status',
    //             name: 'status',
    //             render: function(data) {

    //                 if (data == Number(
    //                         "{{ config('global.active') }}")) {
    //                     return "<span class='badge bg-success me-1 text-white'>Active</span>"
    //                 } else {
    //                     return "<span class='badge bg-danger me-1 text-white'>De-Active</span>";
    //                 }

    //             },
    //             "orderable": false,
    //         },
    //         {
    //             data: 'is_online',
    //             name: 'is_online',
    //             render: function(data) {

    //                 if (data == Number(
    //                         "{{ config('global.online') }}")) {
    //                     return "<span class='badge bg-success me-1 text-white'>Online</span>"
    //                 } else {
    //                     return "<span class='badge bg-danger me-1 text-white'>Offline</span>";
    //                 }

    //             },
    //             "orderable": false,
    //         },
    //         {
    //             data: 'user_date',
    //             name: 'user_date',
    //             "searchable": true,
    //             "orderable": false
    //         },
    //         {
    //             data: 'action',
    //             name: 'action',
    //             "searchable": false,
    //             "orderable": false
    //         },
    //     ];

    //     var initialHeaders = ['name', 'email', 'mobile', 'status', 'user status', 'date', 'action'];

    //     // Initialize DataTable with initial columns
    //     var table = $('.data-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         dom: 'lBfrtip',
    //         lengthMenu: [
    //             [10, 25, 50, -1],
    //             [10, 25, 50, 'All'],
    //         ],
    //         ajax: "{{ route('sales-manage-employee') }}",
    //         columns: initialColumns,
    //     });

    //     // Example: Dynamically update columns based on user preference
    //     $('#toggleColumns').on('change', function() {
    //         var selectedColumns = $(this).val();
    //         var selectedHeaders = $(this).val();

    //         // Update DataTable columns dynamically based on user preference
    //         var updatedColumns = initialColumns.filter(function(column) {
    //             return selectedColumns.includes(column.data);
    //         });

    //         var updatedHeaders = initialHeaders.filter(function(header) {
    //             return selectedHeaders.includes(header);
    //         });
    //         console.log(selectedHeaders);
    //         if (updatedColumns.length == 0) {
    //             updatedColumns = initialColumns
    //             updatedHeaders = initialHeaders
    //         }

    //         table.clear().destroy();
    //         table = $('.data-table').DataTable({
    //             processing: true,
    //             serverSide: true,
    //             dom: 'lBfrtip',
    //             lengthMenu: [
    //                 [10, 25, 50, -1],
    //                 [10, 25, 50, 'All'],
    //             ],
    //             ajax: {
    //                 url: "{{ route('sales-manage-employee') }}",
    //                 headers: updatedHeaders, // Set additional headers here
    //             },
    //             columns: updatedColumns,
    //         });
    //     });
    // });



    // get user details
    function SalesEmployeeDetails(user_id) {
        console.log(user_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Sales-Employee-Details') }}",
            data: {
                user_id: user_id
            },
            success: function(data) {

                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        console.log(item1);
                        $("#user_id").val(item1.id);
                        $("#username").val(item1.username);
                        $("#contact").val(item1.contact);
                        $("#email").val(item1.email);
                        $("#user_type").val(item1.user_type);
                        $("#password").val(item1.password);



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
                    toastr.success('User Updated!!!');
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

                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('addNewEmployee').reset();
                    // Show a success toast
                    toastr.success('User Added!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });

    function DeleteSalesEmployee(user_id) {
        // alert(user_id)
        $.ajax({
            type: "get",
            url: "{{ route('Delete-Sales-Employee') }}",
            data: {
                user_id: user_id
            },
            success: function(data) {
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('User Deleted!!!');

            }
        });
    }
</script>
