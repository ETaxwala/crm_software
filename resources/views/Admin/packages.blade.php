@include('ui.header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Manage Combo Offers</h6>
                    <h6>
                        <svg style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#addAdmin"
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
                                    <th>Package Name</th>
                                    <th>Service Include</th>
                                    <th>Package Type</th>
                                    <th>Discount %</th>
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
{{-- Add Service Modal --}}
<div class="modal fade" id="addAdmin" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAdminLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="addAdminLabel">Create New Package</h5>
            </div>
            <div class="modal-body">
                <form id="combo-packages-form" class="row g-3" action="{{ route('add-combo-package') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Package Title <span style="color: red">*</span></label>
                                <select class="form-control border-none" name="package_title">
                                    <option selected disabled>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Package Type <span style="color: red">*</span></label>
                                <select class="form-control border-none" name="package_type" id="">
                                    <option value="1">Basic</option>
                                    <option value="2">Standard</option>
                                    <option value="3">Premium</option>
                                    <option value="4">Diamond</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Package Discount <span style="color: red">*</span></label>
                                <input type="text" class="form-control border-none" name="package_discount"
                                    placeholder="Package Discount">
                            </div>
                            <div class="col-md-12">
                                <label for="select2Field">Select Services <span style="color: red">*</span></label>

                                <select class="form-control border-none js-select2-multi" id="select2Field"
                                    name="package_services[]" multiple="multiple">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br><br>
                            <div class="col-md-6">
                                <button data-bs-dismiss="modal" type="button"
                                    class="form-control btn btn-square btn-gradient-dark">Cancle</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit"
                                    class="form-control btn btn-square btn-gradient-primary">ADD</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editService" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAdminLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="addAdminLabel">Edit Category</h5>
            </div>
            <div class="modal-body">
                <form id="updateAdmin" class="row g-3" action="{{ route('update-company-category') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="category_id" id="category_id" value="">
                                <label for="">Service Name <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none"
                                    name="category_name" id="category_name" placeholder="Service Name" required>
                            </div>
                            <br><br>
                            <div class="col-md-6">
                                <button data-bs-dismiss="modal" type="button"
                                    class="form-control btn btn-square btn-gradient-dark">Cancle</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit"
                                    class="form-control btn btn-square btn-gradient-primary">Update</button>
                            </div>


                        </div>
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
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@include('ui.footer')
<script type="text/javascript">
    $(document).ready(function() {
        // $('#select2Field').select2();
        $("#select2Field").select2({
            closeOnSelect: false
        });
    });

    $('#addAdmin').on('hidden.bs.modal', function() {
        // Assuming your input has an id of "myInput"
        document.getElementById('addService').reset();
    });

    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('admin-manage-packages') }}",

            columns: [{
                    data: 'service_name_2',
                    name: 'service_name_2',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'service_name_1',
                    name: 'service_name_1',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'cp_type',
                    name: 'cp_type',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.basic') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Basic</span>"
                        }
                        else if (data == Number(
                                "{{ config('global.standard') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Standard</span>"
                        } else if (data == Number(
                                "{{ config('global.premium') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Premium</span>";
                        }
                        else {
                            return "<span class='badge bg-danger me-1 text-white'>Diamond</span>";
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'cp_discount',
                    name: 'cp_discount',
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

    });

    // get user details
    function EditService(category_id) {
        console.log(category_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Category-Details') }}",
            data: {
                category_id: category_id
            },
            success: function(data) {

                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        console.log(item1);
                        $("#category_id").val(item1.category_id);
                        $("#category_name").val(item1.category_name);
                    });
                });
                $("#editService").modal('show')
            }
        });

    }

    // add data
    $(document).ready(function() {
        $('#addService').on('submit', function(e) {
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
                    document.getElementById('addService').reset();
                    // Show a success toast
                    toastr.success('Category Added!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });

    $(document).ready(function() {
        $('#updateAdmin').on('submit', function(e) {
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
                    // document.getElementById('addAdmin').reset();
                    // Show a success toast
                    toastr.success('Category Updated!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });



    function DeleteService(category_id) {
        // alert(category_id)
        $.ajax({
            type: "get",
            url: "{{ route('Delete-Company-Category') }}",
            data: {
                category_id: category_id
            },
            success: function(data) {
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('User Deleted!!!');

            }
        });
    }

    // add combo packages
    $(document).ready(function() {
        $('#combo-packages-form').on('submit', function(e) {
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
                    document.getElementById('combo-packages-form').reset();
                    // Show a success toast
                    toastr.success('Package Added!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });
</script>
