@include('ui.header')
<style>
    .ms-card {
        border-radius: 10px !important;
        cursor: pointer;
    }
    .codeName{
        border: none;
        background-color: #fff;
        font-weight: bold;
        width: auto;
    }
</style>
<div class="ms-content-wrapper">
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
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">{{ $chatting->service_name }}</h6>
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

        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                <div class="ms-panel-header">
                    <div class="align-self-center align-left d-flex justify-content-between">
                        <h6>Generate Coupon Code</h6>
                        <h6 class="pointer" onclick="generateCouponCode()"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="blue" class="bi bi-patch-plus"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5" />
                                <path
                                    d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z" />
                            </svg></h6>
                    </div>

                </div>
                <div class="ms-panel-body ms-scrollable ps ps--active-y">
                    <ul id="getallCouponCodes" class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="generateCoupon" tabindex="-1" role="dialog" aria-labelledby="generateCoupon">
    <div class="modal-dialog modal-dialog-centered modal-min" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <div class="text-center mb-5">
                    <h1>Create New Coupon</h1>
                </div>
                <form id="generateCouponForm" method="post" action="{{ route('generate-new-coupon') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="">Select Coupon type</label>
                            <select class="form-control" name="coupon_type" id="">
                                <option value="0">Amount Wise</option>
                                <option value="1">% Wise</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Coupon Name</label>
                            <input class="form-control" type="text" name="coupon_name" id="coupon_name" onchange="checkCouponName(this.value)">
                            <div id="coupon-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Discount Amount/Percentage</label>
                            <input class="form-control" type="text" name="coupon_discount" id="">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Coupon Validity</label>
                            <input class="form-control" type="date" name="coupon_validity" id="">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">No Of Uses</label>
                            <input class="form-control" type="text" name="coupon_uses" id="">
                        </div>
                        <div class="col-md-6 mb-2 mt-3">
                            <button type="submit" class="btn btn-info shadow-none btn-sm">Create Coupon</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
{{-- closed ticket --}}
<div class="modal fade " id="supportTicketForm" tabindex="-1" role="dialog" aria-labelledby="supportTicketForm">
    <div class="modal-dialog modal-dialog-centered modal-min" role="document">
        <div class="modal-content">

            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h1>Close This Ticket</h1>
                <form id="support_ticket_form" method="post" action="{{ route('change-ticket-status') }}">
                    @csrf
                    <div class="ms-form-group has-icon">
                        <input type="hidden" name="ticket_id" id="ticket_id">

                        <textarea class="form-control" name="ticket_answer" id="ticket_answer" cols="30" rows="5"
                            placeholder="Write your support query here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-info shadow-none">Close Ticket</button>
                </form>
            </div>

        </div>
    </div>
</div>
@include('ui.footer')
<script>
    $(function() {
        getAllTickets()
        GetLeadCount()
        getAllCoupons()
    });

    function getAllTickets() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-customer-support-tickets') }}",

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
                                        ${closeThisTicket}
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

    function GetLeadCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Cust-Total-Status-Count-OM') }}",

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

    function generateCouponCode() {
        $("#generateCoupon").modal('show');
    }

    function getAllCoupons() {
        $.ajax({
            type: "GET",
            url: "{{ route('get-all-coupons') }}",

            success: function(data) {

                var content = '';
                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        // console.log('coupons => ' + item1);
                        const coupon_id = item1.coupon_id;
                        const coupon_type = item1.coupon_type;
                        const openCoupon =
                            '<span class="badge badge-success"> Open </span>';
                        const closedCoupon =
                            '<span class="badge badge-danger"> Expired </span>';
                        const openClosedBadge = item1.is_active ? closedCoupon : openCoupon;


                        const discountInRs = `Rs ${item1.coupon_discount}`;
                        const discountInPercentage = `${item1.coupon_discount}%`;
                        const couponTypeBadge = item1.coupon_type ? discountInPercentage :
                            discountInRs

                        const dateTime = new Date(item1.coupon_validity);
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        const formattedDate = dateTime.toLocaleDateString('en-US', options);
                        const copyBtn = `<svg onclick="copyTo(${coupon_id})" id="copyButton${coupon_id}" class="pointer" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                                        </svg>`;
                        const newcopyBtn = `<p id="newcopyBtn${coupon_id}"></p>`;

                        content += `
                            <li class="ms-list-item">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">

                                        <input class="codeName" type="text" id="copyText${coupon_id}" value="${item1.coupon_name}" readonly>
                                        ${copyBtn}
                                        ${newcopyBtn}
                                        ${openClosedBadge}
                                    </div>
                                    <span class="my-2 d-block"><b>Expire On :</b>  <i class="material-icons">date_range</i>
                                        ${formattedDate}</span>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">Discount : ${couponTypeBadge}</h6>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">Total Uses : ${item1.coupon_uses}</h6>
                                        <h6 class="ms-feed-user mb-0">Remaining Uses : ${item1.coupon_remaining}</h6>

                                    </div>
                                </div>
                            </li>
                        `;
                    });
                });
                $("#getallCouponCodes").html(content);
            }
        });
    }
</script>
<script>
    function copyTo(v) {
        var copyText = document.getElementById("copyText" + v);
        console.log(copyText);

        // Select the text inside the input field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected text
        document.execCommand("copy");

        // Deselect the input field
        copyText.blur();

        // Change button text to indicate it's copied
        document.getElementById("newcopyBtn" + v).innerHTML = "Copied!";
    }
    function checkCouponName(v) {
        const coupon_name = v;
        $.ajax({
                url: "{{ url('check-coupon-code') }}",
                data: {
                    coupon_name: coupon_name,
                },
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        $("#coupon-error").html(`<span class="msg text-red">${data.error}</span>`);
                        // document.getElementById("coupon_name").value = '';
                    } else {
                        $("#coupon-error").html(`<span class="msg text-red"></span>`);

                    }
                    // $("#total_service_price").val(data);
                    // console.log(data);
                }
            });
    }
</script>
