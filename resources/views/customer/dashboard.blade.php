@include('ui.header')
<style>
    .ms-card{
        border-radius: 10px !important;
        cursor: pointer;
    }
    .heading{
        font-size: calc(5px, 4vw, 8px) !important;
    }
    .small-heading{
        font-size: 11px !important;
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-xl-2 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">
                <a href="{{route('customer-my-services')}}">
                    <div class="ms-card-body media ">
                        <div class="media-body">
                            <span class="heading"><b>Not Started</b></span>
                            <h2 id="notstarted"></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">
                <a href="{{route('customer-my-services')}}">
                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>WIP</b></span>
                        <h2 id="wip"></h2>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">
                <a href="{{route('customer-my-services')}}">
                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="small-heading"><b>Pending From Client</b></span>
                        <h2 id="pendingfromclient"></h2>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">
                <a href="{{route('customer-my-services')}}">
                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Invoiced</b></span>
                        <h2 id="invoiced"></h2>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">
                <a href="{{route('customer-my-services')}}">
                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="small-heading"><b>Payment Pending</b></span>
                        <h2 id="paymentpending"></h2>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-md-6 ">
            <div class="ms-card ms-widget  ms-infographics-widget">
                <a href="{{route('customer-my-services')}}">
                <div class="ms-card-body media ">
                    <div class="media-body">
                        <span class="heading"><b>Completed</b></span>
                        <h2 id="completed"></h2>
                    </div>
                </div>
                </a>
            </div>
        </div>



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
                                <a href="{{ route('Single-Service', ['service_id' => $service->service_id]) }}"
                                    class="media clearfix">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="ms-feed-user mb-0">{{ $service->service_name }}</h6>
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
                                            <p class="d-block text-info">Know more...</p>
                                        </div>
                                    </div>
                                </a>
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
                                <a href="{{ route('Single-Service', ['service_id' => $chatting->service_id]) }}"
                                    class="media clearfix">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="ms-feed-user mb-0">{{ $chatting->service_name }}</h6>
                                        </div>
                                        <span class="my-2 d-block"> <i class="material-icons">date_range</i>
                                            {{ $formattedDate }}</span>

                                        <div class="d-flex justify-content-between">
                                            <p class="d-block"> {{ $chatting->chat_msg }}</p>
                                            <p class="d-block text-info">Continue chat...</p>
                                        </div>
                                    </div>
                                </a>
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
</div>

@include('ui.footer')
<script>
    $(function() {
        GetLeadCount()
        getAllTickets()
    });
    // get recent support ticket
    function getAllTickets() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-customer-own-support-tickets') }}",

            success: function(data) {

                var content = '';
                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        // console.log(item1);
                        const ticket_id = item1.ticket_id;
                        const openTicket = '<span class="badge badge-success"> Open </span>';
                        const closedTicket = '<span class="badge badge-danger"> Closed </span>';
                        const openClosedBadge = item1.is_open ? closedTicket : openTicket;

                        const dateTime = new Date(item1.date);
                        const options = { year: 'numeric', month: 'long', day: 'numeric' };
                        const formattedDate = dateTime.toLocaleDateString('en-US', options);

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
                                    <p class="d-block">${item1.ticket_msg}</p>
                                </div>
                            </li>
                        `;
                    });
                });
                $("#recentSupportTicket").html(content);
            }
        });
    }
    function GetLeadCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Cust-Total-Status-Count') }}",

            success: function(data) {

                $.each(data, function(index, item) {
                    console.log(item);
                    $("#total").html(item.totalTasks);
                    $("#notstarted").html(item.notstarted);
                    $("#wip").html(item.wip);
                    $("#pendingfromclient").html(item.pendingfromclient);
                    $("#invoiced").html(item.invoiced);
                    $("#paymentpending").html(item.paymentpending);
                    $("#completed").html(item.completed);
                })

            }
        });
    }
</script>
