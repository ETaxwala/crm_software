@include('ui.header')
<style>
    .ms-card {
        border-radius: 10px !important;
        cursor: pointer;
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
            url: "{{ route('Get-Emp-Total-Status-Count') }}",

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
                })

            }
        });
    }
</script>
