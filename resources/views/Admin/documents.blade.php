@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Manage Documents</h6>
                    <h6>
                        {{-- <a href="" style="cursor: pointer"> --}}
                        <svg style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#addAdmin"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            <path fill-rule="evenodd"
                                d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                        {{-- </a> --}}
                    </h6>
                </div>

                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Service Name</th>
                                    <th>Price</th>
                                    <th>Added By</th>
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
                <h5 class="modal-title text-white" id="addAdminLabel">Add New Service</h5>
            </div>
            <div class="modal-body">
                <form id="addService" class="row g-3" action="{{ route('add-company-service') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="">Service Name <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none"
                                    name="service_name" placeholder="Service Name" required>
                            </div>
                            <br><br><br><br>
                            <div class="col-md-6">
                                <label for="">Service Name <span style="color: red">*</span></label>
                                <select name="category_id" class="form-control border-none">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Service Price <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none"
                                    name="service_price" placeholder="Service Price" required>
                            </div>
                            <br><br>
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
                <h5 class="modal-title text-white" id="addAdminLabel">Edit Service</h5>
            </div>
            <div class="modal-body">
                <form id="updateAdmin" class="row g-3" action="{{ route('update-company-service') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="service_id" id="service_id" value="">
                                <label for="">Service Name <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none"
                                    name="service_name" id="service_name" placeholder="Service Name" required>
                            </div>
                            <br><br><br><br>
                            <div class="col-md-6">
                                <label for="">Select Category <span style="color: red">*</span></label>
                                <select name="category_id" id="category_id" class="form-control border-none">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->service_id }}">{{ $service->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Service Price <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none"
                                    name="service_price" id="service_price" placeholder="Service Price" required>
                            </div>
                            <br><br>
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
@include('ui.footer')
<script type="text/javascript">
    $('#addAdmin').on('hidden.bs.modal', function() {
        document.getElementById('addService').reset();
    });

    // $(function() {
    //     var table = $('.data-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         dom: 'lBfrtip',
    //         lengthMenu: [
    //             [10, 25, 50, -1],
    //             [10, 25, 50, 'All'],
    //         ],
    //         ajax: "{{ route('admin-manage-service') }}",

    //         columns: [
    //             {
    //                 data: 'category_name',
    //                 name: 'category_name',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },
    //             {
    //                 data: 'service_name',
    //                 name: 'service_name',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },

    //             {
    //                 data: 'price',
    //                 name: 'price',
    //                 "searchable": true,
    //                 "orderable": true
    //             },
    //             {
    //                 data: 'username',
    //                 name: 'username',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },

    //             {
    //                 data: 'action',
    //                 name: 'action',
    //                 "searchable": false,
    //                 "orderable": false,
    //             },



    //         ]
    //     });

    // });

    // get user details
    // function EditService(service_id) {
    //     console.log(service_id);
    //     $.ajax({
    //         type: "GET",
    //         url: "{{ route('Get-Service-Details') }}",
    //         data: {
    //             service_id: service_id
    //         },
    //         success: function(data) {

    //             $.each(data, function(index, item) {


    //                 $.each(item, function(index, item1) {
    //                     console.log(item1);
    //                     $("#service_id").val(item1.service_id);
    //                     $("#service_name").val(item1.service_name);
    //                     $("#service_price").val(item1.service_price);
    //                     $("#category_id").val(item1.category_id);


    //                 });
    //             });
    //             $("#editService").modal('show')
    //         }
    //     });

    // }

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
                    toastr.success('Service Added!!');
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
                    toastr.success('Service Updated!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });



    // function DeleteService(service_id) {
    //     // alert(service_id)
    //     $.ajax({
    //         type: "get",
    //         url: "{{ route('Delete-Company-Service') }}",
    //         data: {
    //             service_id: service_id
    //         },
    //         success: function(data) {
    //             $('.data-table').DataTable().ajax.reload(null, false);
    //             toastr.success('User Deleted!!!');

    //         }
    //     });
    // }
</script>
