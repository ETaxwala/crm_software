@include('ui.header')
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">


            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Appointments</h6>
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
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Message</th>
                                    <th>A Date</th>
                                    <th>A Time</th>
                                    <th>Conduct By</th>
                                    <th>Added By</th>
                                    <th>Amount</th>
                                    <th>Status</th>
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

<div class="modal fade" id="addAdmin" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAdminLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="addAdminLabel">Add New Appointment</h5>
            </div>
            <div class="modal-body">
                <form id="addService" class="row g-3" action="{{ route('add-manual-appointment') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">

                            <div class="col-md-6">
                                <label for="">Name <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none" name="name"
                                    placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email <span style="color: red">*</span></label>
                                <input value="" type="email" class="form-control border-none" name="email"
                                    placeholder="Name" required>
                            </div>
                            <br><br><br>
                            <div class="col-md-6">
                                <label for="">Contact No <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none" name="mobile"
                                    placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">City <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none" name="city"
                                    placeholder="City" required>
                            </div>
                            <br><br><br>
                            <div class="col-md-6">
                                <label for="">Date <span style="color: red">*</span></label>
                                <input value="" type="date" class="form-control border-none" name="date"
                                    placeholder="Service Price" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Time <span style="color: red">*</span></label>
                                <input value="" type="time" class="form-control border-none" name="time"
                                    placeholder="Service Price" required>
                            </div>
                            <br><br><br>
                            <div class="col-md-6">
                                <label for="">Conduct By <span style="color: red">*</span></label>
                                <select class="form-control border-none" name="conduct_by" id="">
                                    <option value="Mr. Vaijnath Sir">Mr. Vaijnath Sir</option>
                                    <option value="Mr. Kailas Sir">Mr. Kailas Sir</option>
                                    <option value="Mr. Shailesh Sir">Mr. Shailesh Sir</option>
                                    <option value="Mr. Santosh Asole">Mr. Santosh Asole</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Description <span style="color: red">*</span></label>
                                <textarea class="form-control border-none" name="message" id="" cols="30" rows="5"></textarea>
                            </div>
                            <br><br>
                            <br><br>
                            <div class="col-md-6">
                                <button data-bs-dismiss="modal" type="button"
                                    class="form-control btn btn-square btn-gradient-dark">Cancle</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit"
                                    class="form-control btn btn-square btn-gradient-primary">Book</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="editManager" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addManagerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addManagerLabel">Edit Admin</h5>
            </div>
            <div class="modal-body">
                <form id="updateManager" class="row g-3" action="{{ route('update-manual-appointment') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <input type="hidden" name="appo_id" id="appo_id">
                            <div class="col-md-6">
                                <label for="">Name <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none" name="name"
                                    id="name" placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email <span style="color: red">*</span></label>
                                <input value="" type="email" class="form-control border-none" name="email"
                                    id="email" placeholder="Name" required>
                            </div>
                            <br><br><br>
                            <div class="col-md-6">
                                <label for="">Contact No <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none" name="mobile"
                                    id="mobile" placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">City <span style="color: red">*</span></label>
                                <input value="" type="text" class="form-control border-none" name="city"
                                    id="city" placeholder="City" required>
                            </div>
                            <br><br><br>
                            <div class="col-md-6">
                                <label for="">Date <span style="color: red">*</span></label>
                                <input value="" type="date" class="form-control border-none" name="date"
                                    id="date" placeholder="Service Price" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Time <span style="color: red">*</span></label>
                                <input value="" type="time" class="form-control border-none" name="time"
                                    id="time" placeholder="Service Price" required>
                            </div>
                            <br><br><br>
                            <div class="col-md-6">
                                <label for="">Conduct By <span style="color: red">*</span></label>
                                <select class="form-control border-none" name="conduct_by" id="conduct_by">
                                    <option value="Mr. Vaijnath Sir">Mr. Vaijnath Sir</option>
                                    <option value="Mr. Kailas Sir">Mr. Kailas Sir</option>
                                    <option value="Mr. Shailesh Sir">Mr. Shailesh Sir</option>
                                    <option value="Mr. Santosh Asole">Mr. Santosh Asole</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Description <span style="color: red">*</span></label>
                                <textarea class="form-control border-none" name="message" id="message" cols="30" rows="5"></textarea>
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
<script>
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('get-all-appointment') }}",

            columns: [{
                    data: 'name',
                    name: 'name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'city',
                    name: 'city',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'message',
                    name: 'message',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'ap_date',
                    name: 'ap_date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'ap_time',
                    name: 'ap_time',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'conduct_by',
                    name: 'conduct_by',
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
                    data: 'amount',
                    name: 'amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'status',
                    name: 'status',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'action',
                    name: 'action',
                    "searchable": true,
                    "orderable": false,
                },





            ]
        });

    });



    // get user details
    function EditAppo(id) {
        console.log(id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Appointment-Details') }}",
            data: {
                id: id
            },
            success: function(data) {

                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        console.log(item1);


                        var time = item1.ap_time
                        var hours = parseInt(time.split(':')[0]);
                        var minutes = time.split(':')[1].split('')[0];
                        var ampm = time.split('')[1];

                        if (ampm === 'PM' && hours === 12) {
                            hours = hours + 12;
                        } else {
                            hours = 0;
                        }

                        var timeValue = hours.toString().padStart(2, '0') + ':' + minutes
                            .toString().padStart(2, '0');

                        console.log(timeValue);

                        $("#appo_id").val(item1.id);
                        $("#name").val(item1.name);
                        $("#mobile").val(item1.mobile);
                        $("#email").val(item1.email);
                        $("#city").val(item1.city);
                        $("#date").val(item1.ap_date);
                        $("#time").val(timeValue);
                        $("#conduct_by").val(item1.conduct_by);
                        $("#message").val(item1.message);



                    });
                });
                $("#editManager").modal('show')
            }
        });

    }

    // update data
    $(document).ready(function() {
        $('#updateManager').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {

                    $('.data-table').DataTable().ajax.reload(null, false);

                    toastr.success('Appointment Updated!!!');
                },
                error: function(error) {
                    toastr.error('Something Wrong');
                }
            });
        });
    });

    // add data
    $(document).ready(function() {
        $('#addNewManager').on('submit', function(e) {
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
                    document.getElementById('addNewManager').reset();
                    // Show a success toast
                    toastr.success('User Added!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        });
    });

    function DeleteAppo(id) {
        // alert(id)
        $.ajax({
            type: "get",
            url: "{{ route('delete-manual-appointment') }}",
            data: {
                appo_id: id
            },
            success: function(data) {
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('Appointment Deleted successful');

            },
            error: function(error) {
                toastr.error('Something Wrong');
            }
        });
    }
</script>
