@include('Assistant.Operation.header')
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
                        <div class="col-md-6">
                            <select class="form-control" id="filter_customer_id" onchange="GetAllTasks(this.value)">
                                <option value="0">All</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
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
                                    <th>Assign To</th>
                                    <th>Assign Date</th>
                                    <th>Due Date</th>
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
@include('Assistant.Operation.footer')
<script>
    $(function() {
        // Formatting function for row details - modify as you need
        function format(d) {

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

        var table = $('#table').DataTable({
            ajax: "{{ route('operation-manage-all-tasks') }}",
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
                    data: 'username',

                    render: function(data) {
                        if (data === null) {
                            return "<span class='badge bg-danger me-1 text-white'>Un-Assign</span>"
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'assign_date'
                },
                {
                    data: 'due_date'
                },
                {
                    data: 'action'
                }
            ],
        });

        // Add event listener for opening and closing details
        $('#table tbody').on('click', 'td.dt-control', function() {



            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            } else {
                console.log();
                const task_id = row.data().task_id;

                $.ajax({
                    type: "GET",
                    url: "{{ route('Get-Customer-Tasks-Details') }}",
                    data: {
                        task_id: task_id,
                    },
                    success: function(data) {

                        row.child(format(data)).show();
                        // console.log(data);
                    }
                });
                // Open this row

            }
        });


    })

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

    function GetAllTasks() {

        const customer_id = document.getElementById('filter_customer_id').value;
        const employee_id = document.getElementById('filter_employee_id').value;

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
                url: "{{ route('operation-manage-filter-tasks') }}",
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
                    data: 'username',

                    render: function(data) {
                        if (data === null) {
                            return "<span class='badge bg-danger me-1 text-white'>Un-Assign</span>"
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'assign_date'
                },
                {
                    data: 'due_date'
                },
                {
                    data: 'action'
                }
            ],
        });

    }
</script>
