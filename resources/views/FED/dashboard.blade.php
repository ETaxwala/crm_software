@include('ui.header')
<style>
    .media {
        background-color: #ffd000;
    }
</style>
<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="ms-card card-success">
                <div class="ms-card-body">
                    <h6>Total Customers</h6>
                    <h6 id="total_customers">0</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="ms-card card-gradient-info">
                <div class="ms-card-body">
                    <h6>Total Sells</h6>
                    <h6 id="total_sells">0</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="ms-card card-gradient-secondary">
                <div class="ms-card-body">
                    <h6>Collected Amount</h6>
                    <h6 id="collected_amount">0</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="ms-card card-gradient-danger">
                <div class="ms-card-body">
                    <h6>Uncollected Amount</h6>
                    <h6 id="uncollected_amount">0</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Total Tasks</b></span>
                        <h2 id="total"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Not Started</b></span>
                        <h2 id="notstarted"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>WIP</b></span>
                        <h2 id="wip"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="small-heading"><b>Pending From Client</b></span>
                        <h2 id="pendingfromclient"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Invoiced</b></span>
                        <h2 id="invoiced"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="small-heading"><b>Payment Pending</b></span>
                        <h2 id="paymentpending"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Completed</b></span>
                        <h2 id="completed"></h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">

                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Not Assign</b></span>
                        <h2 id="notassign"></h2>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header">
                    <h6>Total Sells (In Rupees)</h6>

                </div>
                <div class="ms-panel-body">

                    <div class="row">
                        <div class="col-xl-12 col-md-6">
                            <div class="chartjs-size-monitor"
                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                    </div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas id="myPieChart1"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                <div class="ms-panel-header">
                    <div class="align-self-center align-left">
                        <h6>Recent Support Tickets</h6>
                    </div>
                </div>
                <div class="ms-panel-body ms-scrollable ps ps--active-y">
                    <ul id="recentSupportTicket" class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                <div class="ms-panel-header">
                    <div class="align-self-center align-left">
                        <h6>Recent Service Status</h6>
                    </div>
                </div>
                <div class="ms-panel-body ms-scrollable ps ps--active-y">
                    <ul class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">
                        @foreach ($services as $service)
                            @php
                                $dateString = $service->date;
                                $dateTime = new DateTime($dateString);
                                $formattedDate = $dateTime->format('F j, Y');

                            @endphp
                            <li class="ms-list-item">

                                <div class="media-body">
                                    <div>
                                        <h6 class="ms-feed-user mb-0">{{ $service->name }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="ms-feed-user mb-0">{{ $service->service_name }}</p>
                                        @switch($service->status)
                                            @case(1)
                                                <span class="badge badge-danger"> Not Started </span>
                                            @break

                                            @case(2)
                                                <span class="badge badge-warning"> Work In Progress </span>
                                            @break

                                            @case(3)
                                                <span class="badge badge-primary"> Pending From Client </span>
                                            @break

                                            @case(4)
                                                <span class="badge badge-secondary"> Invoiced </span>
                                            @break

                                            @case(5)
                                                <span class="badge badge-success"> Completed </span>
                                            @break

                                            @case(6)
                                                <span class="badge badge-danger"> Return Back </span>
                                            @break

                                            @case(7)
                                                <span class="badge badge-danger"> Cancel </span>
                                            @break

                                            @case(8)
                                                <span class="badge badge-secondary"> Payment Pending </span>
                                            @break
                                        @endswitch
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i>
                                        {{ $formattedDate }}</span>

                                    <div class="d-flex justify-content-between">
                                        <p class="d-block"> {{ $service->work }}</p>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                <div class="ms-panel-header">
                    <div class="align-self-center align-left">
                        <h6>Recent Chatting</h6>
                    </div>
                </div>
                <div class="ms-panel-body ms-scrollable ps ps--active-y">
                    <ul class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">
                        @foreach ($chattings as $chatting)
                            @php
                                $dateString = $chatting->date;
                                $dateTime = new DateTime($dateString);
                                $formattedDate = $dateTime->format('F j, Y');
                            @endphp
                            <li class="ms-list-item">

                                <div class="media-body">
                                    <div class="">
                                        <h6 class="ms-feed-user mb-0">{{ $chatting->name }}</h6>
                                        <br>
                                        <p class="mb-0">{{ $chatting->service_name }}</p>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i>
                                        {{ $formattedDate }}</span>

                                    <div class="d-flex justify-content-between">
                                        <p class="d-block"> {{ $chatting->chat_msg }}</p>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

@include('ui.footer')
<script>
    const ctx = document.getElementById('myPieChart1').getContext('2d');
    const myPieChart = new Chart(ctx, {
        type: 'pie', // Specify the chart type
        data: {
            labels: ['Online', 'Offline'], // Labels for the pie slices
            datasets: [{
                data: [11200, 22500], // Data for the pie slices
                backgroundColor: ['#FF6384', '#36A2EB'], // Colors for the pie slices
            }]
        },
        options: {
            responsive: false, // Ensure the chart is responsive
            maintainAspectRatio: false, // Optional
        }
    });
</script>
<script>
    $(function() {
        getAllTickets()
        getData()
        GetLeadCount()
    });

    function GetLeadCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Cust-Total-Status-Count-Partner') }}",

            success: function(data) {

                $.each(data, function(index, item) {
                    // console.log(item);
                    $("#total").html(item.totalTasks);
                    $("#notstarted").html(item.notstarted);
                    $("#wip").html(item.wip);
                    $("#pendingfromclient").html(item.pendingfromclient);
                    $("#invoiced").html(item.invoiced);
                    $("#paymentpending").html(item.paymentpending);
                    $("#completed").html(item.completed);
                    $("#notassign").html(item.notassign);
                })

            }
        });
    }

    function getAllTickets() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-customer-support-tickets-partner') }}",

            success: function(data) {

                var content = '';
                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        // console.log(item1);
                        const ticket_id = item1.ticket_id;
                        const openTicket =
                            '<span class="badge badge-success"> Open </span>';
                        const closedTicket =
                            '<span class="badge badge-danger"> Closed </span>';
                        const openClosedBadge = item1.is_open ? closedTicket : openTicket;

                        const dateTime = new Date(item1.date);
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        const formattedDate = dateTime.toLocaleDateString('en-US', options);

                        const closeTicketButton =
                            `<span class="badge badge-secondary pointer" onclick="changeTicketStatus(${item1.ticket_id})"> Close Ticket </span>`;
                        const closeThisTicket = item1.is_open ? '' : closeTicketButton;

                        const answer =
                            `<p class="d-block"><b>Answer :</b> ${item1.ticket_answer}</p>`;
                        const ticket_answer = item1.is_open ? answer : '';
                        content += `
                            <li class="ms-list-item">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">${item1.name}</h6>
                                        ${openClosedBadge}
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i>
                                        ${formattedDate}</span>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">${item1.service_name}</h6>

                                    </div>
                                    <br>
                                    <p class="d-block"><b>Query :</b> ${item1.ticket_msg}</p>
                                    ${ticket_answer}
                                </div>
                            </li>
                        `;
                    });
                });
                $("#recentSupportTicket").html(content);
            }
        });
    }

    function changeTicketStatus(ticket_id) {
        $("#ticket_id").val(ticket_id);
        $("#supportTicketForm").modal('show');
    }

    $(document).ready(function() {
        $('#support_ticket_form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    getAllTickets()
                    $("#supportTicketForm").modal('hide');
                    document.getElementById('support_ticket_form').reset();
                    toastr.success('Ticket Closed Successfully');
                },
                error: function(response) {
                    toastr.error('Something wrong');
                }
            });
        });
    });

    function getData() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-franchise-partner-data') }}",

            success: function(data) {
                console.log(data);
                $.each(data, function(index, item) {
                    $("#total_customers").html(item.total_customers);
                    $("#total_sells").html('Rs. ' + item.total_sells);
                    $("#collected_amount").html('Rs. ' + item.collected_amount);
                    $("#uncollected_amount").html('Rs. ' + item.uncollected_amount);
                })
            }
        });
    }
</script>
