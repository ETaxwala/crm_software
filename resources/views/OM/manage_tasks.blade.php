@include('ui.header')
<style>
    .time-line-box {
        height: 100%;
        padding: 100px 0;
        width: 100%;
        background-color: #dadefe;
    }

    .time-line-box .timeline {
        list-style-type: none;
        display: flex;
        padding: 0;
        text-align: center;

    }

    .time-line-box .timestamp {
        margin: auto;
        margin-bottom: 5px;
        padding: 0px 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .time-line-box .status {
        padding: 0px 10px;
        display: flex;
        justify-content: center;
        border-top: 3px solid #455EFC;
        position: relative;
        transition: all 200ms ease-in;
    }

    .time-line-box .status span {
        padding-top: 8px;
    }

    .time-line-box .status span:before {
        content: '';
        width: 12px;
        height: 12px;
        background-color: #455EFC;
        border-radius: 12px;
        border: 2px solid #455EFC;
        position: absolute;
        left: 50%;
        top: 0%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        transition: all 200ms ease-in;
    }

    .swiper-container {
        width: 95%;
        margin: auto;
        overflow-y: auto;
    }

    .swiper-wrapper {
        display: inline-flex;
        flex-direction: row;
        overflow-y: auto;
        justify-content: center;
        padding-right: 18%;
    }

    .swiper-container::-webkit-scrollbar-track {
        background: #a8a8a8b6;
    }

    .swiper-container::-webkit-scrollbar {
        height: 10px;
    }

    .swiper-container::-webkit-scrollbar-thumb {
        background: #4F4F4F !important;
    }

    .swiper-slide {
        text-align: center;
        font-size: 12px;
        width: 100%;
        height: 100%;
        position: relative;
    }
</style>
<div class="ms-content-wrapper">

    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>All Tasks</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="filter_task_id" onchange="GetAllTasks(this.value)">
                                <option value="0">All Tasks</option>
                                <option value="1">Not Started</option>
                                <option value="123">Not Assign</option>
                                <option value="2">WIP</option>
                                <option value="3">Pending From Client</option>
                                <option value="4">Invoiced</option>
                                <option value="5">Completed</option>
                                <option value="6">Return Back</option>
                                <option value="7">Cancle</option>
                                <option value="8">Payment Pending</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="filter_customer_id" onchange="GetAllTasks(this.value)">
                                <option value="0">All</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="filter_employee_id" onchange="GetAllTasks(this.value)">
                                <option value="0">All</option>
                                @foreach ($oemployees as $oemployee)
                                    <option value="{{ $oemployee->id }}">{{ $oemployee->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">

                    <div class="table-responsive">
                        <table id="table" class=" table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Task Name</th>
                                    <th>Customer Name</th>
                                    <th>Service</th>
                                    <th>Assign To</th>
                                    <th>Assign Date</th>
                                    <th>Due Date</th>
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
<div class="modal fade bd-example-modal-sm" id="AssignTaskTo" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white">Assign Task To</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">

                    <form id="AssignCutomerTaskTo" class="row g-3" action="{{ route('assign-cust-task-to') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="input-group mb-3">
                                <input type="hidden" name="task_id" value="" id="task-assign-to-id">
                                <select class="form-control shadow-none" name="employee_id" id="employee_id">
                                    <option disabled selected>Select User</option>
                                    @foreach ($oemployees as $item)
                                        <option value="{{ $item->id }}">{{ $item->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="dueDate">Due Date</label>
                            <div class="input-group mb-3">
                                <input type="date" name="due_date" id="due_date" class="form-control shadow-none">
                            </div>
                            <div class="input-group mb-3">
                                <button type="submit"
                                    class="input-group-text bg-gradient-danger text-white">Assign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="MessageToClient" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="MessageToClientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document"">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="workTimelineLabel">Client Info</h5>
            </div>
            <div class="modal-body">
                <div class="ms-panel ms-panel-fh">

                    <div class="ms-panel-body">
                        <div class="container-fluid">


                            <div class="row">
                                <div class="col-md-7">
                                    <div class="d-flex justify-content-between">
                                        <h6>Client Details</h6>
                                        <span id="WhpMail">

                                        </span>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <input type="hidden" id="client_id" name="client_id" value="">
                                        <div class="col-md-6">
                                            <input value="" type="text" class="form-control border-none"
                                                name="client_name" id="client_name" readonly placeholder="Name">
                                        </div>
                                        <div class="col-md-6">
                                            <input value="" type="text" class="form-control border-none"
                                                name="client_email" id="client_email" readonly placeholder="Email">
                                        </div>
                                        <br><br>
                                        <div class="col-md-6">
                                            <input value="" type="text" class="form-control border-none"
                                                name="client_contact" id="client_contact" readonly
                                                placeholder="Contact">
                                        </div>
                                        <div class="col-md-6">
                                            <input value="" type="text" class="form-control border-none"
                                                name="client_service" id="client_service" readonly
                                                placeholder="Service">
                                        </div>
                                        <br><br>
                                        <div class="col-md-6">
                                            <input value="" type="text" class="form-control border-none"
                                                name="client_state" id="client_state" readonly placeholder="State">
                                        </div>
                                        <div class="col-md-6">
                                            <input value="" type="text" class="form-control border-none"
                                                name="client_city" id="client_city" readonly placeholder="City">
                                        </div>


                                    </div>

                                </div>
                                <div class="vertical-line"></div>
                                <div class="col-md-4">
                                    <h6>Add Effort</h6>
                                    <form id="addNewEffort" class=""
                                        action="{{ route('add-cust-work-effort-emp') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="cust_id" id="work_cust_id" value="">
                                        <input type="hidden" name="task_id" id="work_task_id" value="">
                                        <input type="hidden" name="work_service_id" id="work_service_id"
                                            value="">
                                        <div class="">
                                            <select class="form-control" name="status" id="work-status">
                                                <option selected disabled>Select Status</option>
                                                <option value="{{ config('global.notstarted') }}">Not Started</option>
                                                <option value="{{ config('global.wip') }}">Work In Progress</option>
                                                <option value="{{ config('global.pendingfromclient') }}">Pending From
                                                    Client</option>
                                                <option value="{{ config('global.invoiced') }}">Invoiced</option>
                                                <option value="{{ config('global.paymentpending') }}">Payment Pending
                                                </option>
                                                <option value="{{ config('global.completed') }}">Completed</option>
                                                <option value="{{ config('global.returnback') }}">Return Back</option>
                                                <option value="{{ config('global.cancel') }}">Cancle</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="d-flex">
                                            <input class="form-control" type="text" name="work_hour"
                                                id="" placeholder="Hour" required>
                                            <input class="form-control" type="text" name="work_minute"
                                                id="" placeholder="Minute" required>
                                        </div>
                                        <br>
                                        <div class="">
                                            <textarea class="form-control" name="work" id="work-effort" cols="30" rows="3"
                                                placeholder="Add Efforts..." required></textarea>
                                        </div>
                                        <button type="submit"
                                            class="form-control btn btn-square btn-gradient-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                            <hr class="h-line">
                            <div class="row">
                                <div class="col-md-4">
                                    <span>Send Documents</span>
                                </div>
                                <div class="col-md-4">
                                    <span>Received Documents</span>
                                </div>
                                <div class="col-md-4">
                                    <span>Upload Documents</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">

                                <div class="col-md-4" id="customerSendDocuments">

                                </div>
                                <div class="col-md-4" id="customerReceviedDocuments">

                                </div>
                                <div class="col-md-4">
                                    <form id="documentUploads" action="{{ route('upload-employee-document') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="doc_cust_id" id="doc_cust_id">
                                            <input type="hidden" name="cd_service_id" id="cd_service_id">
                                            <div class="col-md-12">
                                                <div class="mb-1">
                                                    <input class="form-control" type="text" name="docs_name"
                                                        id="docs_name" placeholder="Document Name...">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-1">
                                                    <input class="form-control" type="file" name="customer_docs"
                                                        id="customer_docs" accept=".pdf, .jpeg, .jpg, .png">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="form-control btn btn-square btn-gradient-secondary"
                                                    type="submit">Upload</button>
                                            </div>
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
</div>
@include('ui.footer')
<script>
$(document).ready(function() {
        // Initialize the DataTable
        var table = $('#table').DataTable({
            ajax: "{{ route('operation-manager-manage-all-tasks') }}",
            columns: [{
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'mark'
                },
                {
                    data: 'name'
                },
                {
                    data: 'service_name',
                },
                {
                    data: 'username',
                    render: function(data) {
                        return data === null ?
                            "<span class='badge bg-danger me-1 text-white'>Un-Assign</span>" :
                            data;
                    }
                },

                {
                    data: 'assign_date',
                },
                {
                    data: 'due_date',
                },
                {
                    data: 'actual_task_status',
                    render: function(data) {

                        switch (data) {
                            case Number("{{ config('global.notstarted') }}"):
                                return "<span class='badge bg-danger me-1 text-white'>notstarted</span>";

                            case Number("{{ config('global.wip') }}"):
                                return "<span class='badge bg-info me-1 text-white'>WIP</span>";

                            case Number("{{ config('global.pendingfromclient') }}"):
                                return "<span class='badge bg-warning me-1 text-white'>pendingfromclient</span>";

                            case Number("{{ config('global.invoiced') }}"):
                                return "<span class='badge bg-success me-1 text-white'>invoiced</span>";

                            case Number("{{ config('global.completed') }}"):
                                return "<span class='badge bg-success me-1 text-white'>completed</span>";

                            case Number("{{ config('global.returnback') }}"):
                                return "<span class='badge bg-danger me-1 text-white'>returnback</span>";

                            case Number("{{ config('global.cancel') }}"):
                                return "<span class='badge bg-danger me-1 text-white'>cancel</span>";

                            case Number("{{ config('global.paymentpending') }}"):
                                return "<span class='badge bg-danger me-1 text-white'>paymentpending</span>";

                            case null:
                                return "<span class='badge bg-danger me-1 text-white'>notstarted</span>";

                            default:
                                return "<span class='badge bg-secondary me-1 text-white'>notstarted</span>"; // Optional: Handle any unexpected cases
                        }


                    },
                },
                {
                    data: 'action'
                }
            ],
        });

        // Flag to determine if the table is filtered
        let isFiltered = false;

        // Function to handle the row details formatting
        function formatData(data) {
            return isFiltered ? format2(data) : format(data);
        }

        // Function to format the initial load data
        function format(d) {
            // Your original format logic
            console.log('formate1');
            console.log(d);
            // `d` is the original data object for the row
            let remark = ''
            let cls = ''
            if (d.length == 0) {
                cls = 'text-center';
                remark += `<h6>No work timeline found</h6>`;
            }

            d.forEach(element => {
                let status
                switch (element.status) {
                    case 1:
                        status = '<p class="badge badge-primary">Not Started</p>';
                        break;

                    case 2:
                        status = '<p class="badge badge-warning">Work In Progress</p>';
                        break;
                    case 3:
                        status = '<p class="badge badge-danger">Pending From Client</p>';
                        break;
                    case 4:
                        status = '<p class="badge badge-secondary">Invoiced</p>';
                        break;

                    case 5:
                        status = '<p class="badge badge-success">Completed</p>';
                        break;
                    case 6:
                        status = '<p class="badge badge-primary">Return Back</p>';
                        break;
                    case 7:
                        status = '<p class="badge badge-primary">Cancle</p>';
                        break;
                    case 8:
                        status = '<p class="badge badge-warning">Work In Progress</p>';
                        break;

                }

                remark += `<div class="swiper-slide">
                                <div class="timestamp"><span class="date">${element.date}</span></div>
                                <div class="timestamp"><span class="date">${element.time}</span></div>
                                <div class="timestamp"><span class="date">Hour : ${element.work_hour} Minute : ${element.work_minute}</span></div>
                                <div class="timestamp"><span class="date">${element.username}</span></div>
                                <div class="status"><span>${status} <br> ${element.work}</span></div>
                            </div>`;

            });


            let remark2 = `<section class="time-line-box">
                                <div class="swiper-container ${cls}">
                                    <div class="swiper-wrapper">

                                        ${remark}
                                    </div>
                                    <br><br>
                                <div class="swiper-pagination"></div>
                                </div>
                            </section>`;



            return remark2;

        }

        // Function to format the filtered data
        function format2(d) {
            // Your original format2 logic
            console.log('formate2');
            console.log(d);
            // `d` is the original data object for the row
            let remark = ''
            let cls = ''
            if (d.length == 0) {
                cls = 'text-center';
                remark += `<h6>No work timeline found</h6>`;
            }

            d.forEach(element => {
                let status
                switch (element.status) {
                    case 1:
                        status = '<p class="badge badge-primary">Not Started</p>';
                        break;

                    case 2:
                        status = '<p class="badge badge-warning">Work In Progress</p>';
                        break;
                    case 3:
                        status = '<p class="badge badge-danger">Pending From Client</p>';
                        break;
                    case 4:
                        status = '<p class="badge badge-secondary">Invoiced</p>';
                        break;

                    case 5:
                        status = '<p class="badge badge-success">Completed</p>';
                        break;
                    case 6:
                        status = '<p class="badge badge-primary">Return Back</p>';
                        break;
                    case 7:
                        status = '<p class="badge badge-primary">Cancle</p>';
                        break;
                    case 8:
                        status = '<p class="badge badge-warning">Work In Progress</p>';
                        break;

                }

                remark += `<div class="swiper-slide">
                                <div class="timestamp"><span class="date">${element.date}</span></div>
                                <div class="timestamp"><span class="date">${element.time}</span></div>
                                <div class="timestamp"><span class="date">Hour : ${element.work_hour} Minute : ${element.work_minute}</span></div>
                                <div class="timestamp"><span class="date">${element.username}</span></div>
                                <div class="status"><span>${status} <br> ${element.work}</span></div>
                            </div>`;

            });


            let remark2 = `<section class="time-line-box">
                                <div class="swiper-container ${cls}">
                                    <div class="swiper-wrapper">

                                        ${remark}
                                    </div>
                                    <br><br>
                                <div class="swiper-pagination"></div>
                                </div>
                            </section>`;



            return remark2;

        }

        // Common event listener for row expansion
        $('#table tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
            } else {
                const task_id = row.data().task_id;

                $.ajax({
                    type: "GET",
                    url: "{{ route('Get-Customer-Tasks-Details') }}",
                    data: {
                        task_id: task_id
                    },
                    success: function(data) {
                        row.child(formatData(data)).show();
                    }
                });
            }
        });

        // Function to get tasks with filters
        window.GetAllTasks = function() {
            const customer_id = document.getElementById('filter_customer_id').value;
            const employee_id = document.getElementById('filter_employee_id').value;
            const task_status = document.getElementById('filter_task_id').value;

            console.log('task status =' + task_status);
            isFiltered = true; // Set flag to true when filtering

            // Destroy and reinitialize the DataTable with filtered data
            table.destroy();
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lBfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
                ajax: {
                    url: "{{ route('operation-manager-manage-filter-tasks') }}",
                    data: {
                        customer_id: customer_id,
                        employee_id: employee_id,
                        task_status: task_status
                    },
                },
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data: 'task_name'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'service_name',
                    },
                    {
                        data: 'username',
                        render: function(data) {
                            return data === null ?
                                "<span class='badge bg-danger me-1 text-white'>Un-Assign</span>" :
                                data;
                        }
                    },

                    {
                        data: 'assign_date'
                    },
                    {
                        data: 'due_date'
                    },
                    {
                        data: 'actual_task_status',
                        render: function(data) {

                            switch (data) {
                                case Number("{{ config('global.notstarted') }}"):
                                    return "<span class='badge bg-danger me-1 text-white'>notstarted</span>";

                                case Number("{{ config('global.wip') }}"):
                                    return "<span class='badge bg-info me-1 text-white'>WIP</span>";

                                case Number("{{ config('global.pendingfromclient') }}"):
                                    return "<span class='badge bg-warning me-1 text-white'>pendingfromclient</span>";

                                case Number("{{ config('global.invoiced') }}"):
                                    return "<span class='badge bg-success me-1 text-white'>invoiced</span>";

                                case Number("{{ config('global.completed') }}"):
                                    return "<span class='badge bg-success me-1 text-white'>completed</span>";

                                case Number("{{ config('global.returnback') }}"):
                                    return "<span class='badge bg-danger me-1 text-white'>returnback</span>";

                                case Number("{{ config('global.cancel') }}"):
                                    return "<span class='badge bg-danger me-1 text-white'>cancel</span>";

                                case Number("{{ config('global.paymentpending') }}"):
                                    return "<span class='badge bg-danger me-1 text-white'>paymentpending</span>";

                                case null:
                                    return "<span class='badge bg-danger me-1 text-white'>notstarted</span>";

                                default:
                                    return "<span class='badge bg-secondary me-1 text-white'>notstarted</span>"; // Optional: Handle any unexpected cases
                            }


                        },
                    },
                    {
                        data: 'action'
                    }
                ],
            });

        }
    });

    function AssingTaskTo(v) {
        $("#task-assign-to-id").val(v)
        // task-assign-to-id
        $("#AssignTaskTo").modal('show')
    }
    
    function GetDocuments(customer_id, service_id) {
        // console.log(customer_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Client-Documents') }}",
            data: {
                customer_id: customer_id,
                service_id: service_id,
            },
            success: function(data) {
                console.log(data);
                var remark = "";
                var remark2 = "";
                $.each(data, function(index, item) {
                    console.log('docs => ' + item.cd_from);


                    if (item.cd_from == customer_id) {
                        var downloadUrl = "{{ url('public/Docs/') }}" + '/' + item.cd_doc;
                        remark += `
                        <a download="${item.cd_doc}" href="${downloadUrl}">
                            ${item.cd_name} <span class="text-dark">|</span> &nbsp;
                        </a>`;
                    } else {
                        var downloadUrl2 = "{{ url('public/Docs/') }}" + '/' + item.cd_doc;
                        remark2 += `
                        <a download="${item.cd_doc}" href="${downloadUrl2}">
                            ${item.cd_name} <span class="text-dark">|</span> &nbsp;
                        </a>`;
                    }





                });
                $('#customerReceviedDocuments').html(remark);
                $('#customerSendDocuments').html(remark2);


            }
        });
    }

// add effort
    $(document).ready(function() {
        $('#addNewEffort').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('success');
                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('work-effort').value = '';
                    document.getElementById('work-status').selectedIndex = 0;
                    // Show a success toast
                    toastr.success('Remark Added!!');
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error('Wrong!!!');
                }
            });
        });
    });

    // documentUploads
    $(document).ready(function() {
        $('#documentUploads').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    const cust_id = document.getElementById('doc_cust_id').value;

                    const service_id = document.getElementById('chat_service_id').value;
                    
                    GetDocuments(cust_id, service_id);
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('customer_docs').value = '';
                    document.getElementById('docs_name').value = '';
                    // Show a success toast
                    toastr.success('Document Uploades!!!');
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });
    
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
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });


    // update client data
    $(document).ready(function() {
        $('#UpdateClientInfo').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    var cust_id = document.getElementById('work_cust_id').value;
                    var task_id = document.getElementById('work_task_id').value;

                    console.log(cust_id);
                    ClientInfo(cust_id, task_id);
                    // document.getElementById('work-effort').value = '';
                    // document.getElementById('work-status').selectedIndex = 0;
                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    // document.getElementById('MainStatusForm').reset();
                    // Show a success toast
                    toastr.success('Customer Updated!!!');
                },
                error: function(error) {
                    // Handle the error response, if needed
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });
    
    $(document).ready(function() {
        $('#AssignCutomerTaskTo').on('submit', function(e) {
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
                    document.getElementById('employee_id').selectedIndex = 0;
                    document.getElementById('due_date').value = '';

                    // Show a success toast
                    toastr.success('Task Assigned');
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error('Wrong!!!');
                }
            });
        });
    });
    
    
    function DeleteTask(task_id) {
        $.ajax({
                    type: "get",
                    url: "{{ route('om-delete-task') }}",
                    data: {
                        task_id: task_id
                    },
                    success: function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success('Task Deleted!!!');

                    },
                    error: function(error) {
                        // console.log(error.responseJSON.message);
                        // Handle the error response, if needed
                        toastr.error('Something Wrong!!!');
                    }
                });
    }
    
     function ClientInfo(cust_id, task_id, service_id) {

        $("#work_cust_id").val(cust_id);
        $("#work_task_id").val(task_id);
        $("#doc_cust_id").val(cust_id);
        $("#chat_service_id").val(service_id);
        $("#cd_service_id").val(service_id);

        // console.log(service_id);

        GetDocuments(cust_id, service_id);

        $.ajax({
            type: "GET",
            url: "{{ route('Get-Client-Info') }}",
            data: {
                cust_id: cust_id,
                service_id: service_id
            },
            success: function(data) {
                // console.log(data);
                var remark = "";
                $.each(data, function(index, item) {

                    // console.log(item);
                    document.getElementById("client_id").value = item.id;
                    document.getElementById("client_name").value = item.name;
                    document.getElementById("client_email").value = item.email;
                    document.getElementById("client_contact").value = item.contact;
                    document.getElementById("client_service").value = item.service_name;
                    document.getElementById("client_state").value = item.state;
                    document.getElementById("client_city").value = item.city;
                    document.getElementById("work_service_id").value = item.service_id;

                    remark += `
                        <span class="pointer" onclick="OpenChatBox(${cust_id},${service_id})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
                            </svg>
                        </span>
                            &nbsp;
                            <a href="mailto:${item.email}">
                            <svg class="pointer" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="blue" class="bi bi-envelope"
                                viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg>
                            </a>
                        `;

                });
                $('#WhpMail').html(remark);
                $("#MessageToClient").modal('show')
            }
        });


    }
    
</script>
