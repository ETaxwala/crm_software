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
                    data: 'task_name'
                },
                {
                    data: 'name'
                },
                {
                    data: 'service_name'
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
                                return "<span class='badge bg-secondary me-1 text-white'>notstarted null</span>"; // Optional: Handle any unexpected cases
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
                    url: "{{ route('OM-Get-Customer-Tasks-Details') }}",
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
                        employee_id: employee_id
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
                    data: 'service_name'
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
    
</script>
