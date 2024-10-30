@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">
        {{-- <div class="col-md-12">
        <h1 class="db-header-title">Welcome, {{Session::get('user_name')}}</h1>
      </div> --}}
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 3.2%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Sells Graph</strong></span>
                        <h2>$8,451</h2>
                    </div>
                </div>
                <canvas id="line-chart"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-red"><i class="material-icons">arrow_downward</i> 4.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Total Visitors</strong></span>
                        <h2>3,973</h2>
                    </div>
                </div>
                <canvas id="line-chart-2"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 12.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>New Users</strong></span>
                        <h2>7,333</h2>
                    </div>
                </div>
                <canvas id="line-chart-3"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-red"><i class="material-icons">arrow_upward</i> 9.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Total Orders</strong></span>
                        <h2>48,973</h2>
                    </div>
                </div>
                <canvas id="line-chart-4"></canvas>
            </div>
        </div>


        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header new">
                    <h6>Monthly Revenue</h6>
                    <select class="form-control new" id="exampleSelect">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="1">June</option>
                        <option value="2">July</option>
                        <option value="3">August</option>
                        <option value="4">September</option>
                        <option value="5">October</option>
                        <option value="4">November</option>
                        <option value="5">December</option>
                    </select>
                </div>
                <div class="ms-panel-body"> <span class="progress-label"> <strong>week 1</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div> <span class="progress-label"> <strong>week 2</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100">50%</div>
                    </div> <span class="progress-label"> <strong>week 3</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div> <span class="progress-label"> <strong>week 4</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100">40%</div>
                    </div>
                </div>
            </div>
        </div>





        <!-- Recent Support Tickets -->
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
        <!-- Recent Support Tickets -->

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
                            <input class="form-control" type="text" name="coupon_name" id="coupon_name"
                                onchange="checkCouponName(this.value)">
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
@include('ui.footer')
<script>
    $(function() {
        getAllCoupons()
    });

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
