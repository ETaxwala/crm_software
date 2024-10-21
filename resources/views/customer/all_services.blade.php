@include('ui.header')
<style>
    .bg-yellow{
        background-color: #ffd000;
    }
    .verticle__scroll {
        min-height: 200px;
        max-height: 200px;
        overflow: auto;
    }

    .verticle__scroll::-webkit-scrollbar-track {
        /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
        background-color: transparent;
        border-radius: 10px;
    }

    .verticle__scroll::-webkit-scrollbar {
        width: 5px;
        background-color: #F5F5F5;
    }

    .verticle__scroll::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #F90;
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, .2) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, .2) 50%,
                rgba(255, 255, 255, .2) 75%,
                transparent 75%,
                transparent)
    }
    .scroll__verticle{
        min-height: 300px;
        max-height: 300px;
        overflow: auto;
    }
    .scroll__verticle::-webkit-scrollbar-track {
        /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
        background-color: transparent;
        border-radius: 10px;
    }

    .scroll__verticle::-webkit-scrollbar {
        width: 5px;
        background-color: #F5F5F5;
    }

    .scroll__verticle::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #F90;
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, .2) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, .2) 50%,
                rgba(255, 255, 255, .2) 75%,
                transparent 75%,
                transparent)
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">
        @if (session('error'))
            <div id="flash-message" class="alert alert-danger col-md-6">
                <p>{{ session('error') }} <button type="button" class="close"
                        onclick="closeFlashMessage()">&times;</button></p>

            </div>
        @endif
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>All Services</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="f_service_name" placeholder="Search.."
                                onkeyup="GetAllServices(this.value)">
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="f_category_id" onchange="GetAllServices(this.value)">
                                <option value="0">All</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->category_id }}">{{ $categorie->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="ms-panel-body">
                    <div class="row" id="All-Services">

                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <div class="modal left fade" id="AddWorkEffort" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-warning">
                    <h5 class="modal-title text-white" id="AddWorkEffortLabel">Your Cart</h5>
                </div>
                <div class="modal-body">

                    <div class="scrollable-div px-3" id="customerTasks">

                    </div>


                    <div class=" mx-3">

                        <form action="" method="post">
                            @csrf
                            <div class="formgroup">
                                <input type="hidden" name="name" value="{{ Session::get('user_name') }}"
                                    placeholder="Name" class="form-control">
                                <input type="hidden" id="final_service_id" name="final_service_id[]">
                                <input type="hidden" id="final_category_id" name="final_category_id[]">
                                <input type="hidden" id="final_item_amount" name="final_item_amount[]">

                                <input type="hidden" id="amount" name="amount" placeholder="Amount"
                                    class="form-control">
                            </div>
                            <div class="row d-flex justify-content-between">
                                <span id="totalAmount" class="btn btn-warning"> </span>
                                <button id="pay-now" class="place-order btn btn-success" type="">Pay
                                    Now</button>
                            </div>
                        </form>
                        <form action="{{ route('buy-free-service') }}" method="post">
                            @csrf
                            <button style="display: none" id="pay-free"
                                class="place-order btn btn-block btn-success">Buy Free Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="float" data-bs-toggle="modal" data-bs-target="#AddWorkEffort" onclick="GetCartItems()">
        <span class="item-count1" id="itemCount1">0</span>
        <i class="fa fa-shopping-cart my-float"></i>
    </a> --}}


</div>

{{-- combo offer modal --}}
<div class="modal fade" id="comboOffer" data-bs-keyboard="false" tabindex="-1" aria-labelledby="comboOfferLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document"">
        <div class="modal-content rounded">
            <div class="modal-body ">


                <div class="row" id="showPackages">


                </div>

            </div>
        </div>

    </div>
</div>
</div>

{{-- inquiry form --}}
<div class="modal fade " id="inquiryForm" tabindex="-1" role="dialog" aria-labelledby="inquiryForm">
    <div class="modal-dialog modal-dialog-centered modal-min" role="document">
        <div class="modal-content">

            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                {{-- <i class="flaticon-call d-block"></i> --}}
                <h1>Inquire Now</h1>
                <p> Inquir Now and get updates </p>
                <form id="inquiry_form" method="post" action="{{ route('customer-inquiry-form') }}">
                    @csrf
                    <div class="ms-form-group has-icon">
                        <input type="hidden" name="query_service_id" id="query_service_id">
                        {{-- <input type="text" placeholder="Email Address" class="form-control" name="news-letter" value=""> --}}
                        <textarea class="form-control" name="customer_query" id="customer_query" cols="30" rows="5"
                            placeholder="Write your query here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning shadow-none">Inquiry Now</button>
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
    // get item count
    $(document).ready(function() {
        ItemCount();
        GetAllServices();
        GetTotal();

    });

    function calculateArraySum(array) {
        return array.reduce((acc, current) => acc + current, 0);
    }

    function showPremiun(service_id) {
        // console.log(service_id);
        $.ajax({
            type: "GET",
            url: "{{ route('get-package-info') }}",
            data: {
                service_id: service_id
            },

            success: function(data) {

                // console.log(data);
                var remark = "";
                let basicpackageTotal = [];
                let standardpackageTotal = [];
                let premiumpackageTotal = [];
                let diamondpackageTotal = [];
                let cardWidth;

                $.each(data, function(index, item) {
                    // console.log(item.data1.length);
                    // console.log('item => ' + item.data2);
                    if (item.data1.length > 0) {
                        switch (item.data1.length) {
                            case 1:
                                cardWidth = 'col-md-12 col-lg-12';
                                break;

                            case 2:
                                cardWidth = 'col-md-12 col-lg-6';
                                break;
                            case 3:
                                cardWidth = 'col-md-12 col-lg-4';
                                break;
                            case 4:
                                cardWidth = 'col-md-12 col-lg-6';
                                break;
                        }
                        $.each(item.data1, function(index, item1) {

                            // console.log(item1);
                            var package_id = item1.cp_id;
                            var package_type = item1.cp_type;

                            // console.log(package_id);
                            // console.log(package_type);
                            var service_id_array = item1.service_id.split(", ").map(Number);
                            // console.log(service_id_array);

                            let packInfo

                            switch (item1.cp_type) {
                                case 1:

                                    $.each(item.data2, function(index, item2) {
                                        // console.log(item2);
                                        if (service_id_array.includes(item2
                                                .service_id)) {
                                            console.log("basic services ids =>" +
                                                item2.service_id);

                                            basicpackageTotal.push(item2
                                                .service_price)
                                        }
                                    });
                                    // console.log("basic array" + basicpackageTotal);
                                    const basicTotal = calculateArraySum(basicpackageTotal);



                                    packInfo = `
                                <div class="${cardWidth}">
                                <div class="card offer-card">
                                    <div class="offer-card-header header-basic">
                                        <h5 class="card-title text-center text-dark">Basic</h5>
                                    </div>
                                    <div class="card-body scroll__verticle">
                                        <h3 id="basicTotal">Rs. ${basicTotal}/-</h3>
                                        <div class="price-card--features item">
                                            <ul class="price-card--features--list">
                                                `;

                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {
                                            let sname = item2.service_name;

                                            const dataArray = item2.description
                                                .split(
                                                    ',');
                                            $.each(dataArray, function(index,
                                                item3) {

                                                packInfo += `
                                    <li class="price-card--features--item has-tooltip">
                                                    <span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                    </svg></span>${item3}
                                                    <div class="tooltip-container bg-gradient-primary">
                                                    <strong>${sname}</strong>
                                                    <p class="text-white">${item2.description}</p>
                                                </div>
                                            </li>`;
                                            });
                                        }
                                    });
                                    packInfo += `</ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form action="{{ route('Payment.Sub') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="amount" value="${basicTotal}">
                                        <input type="hidden" name="package_id" value="${package_id}">

                                        <button type="submit" class="btn btn-basic text-white btn-block">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                            </div>`;
                                    break;

                                case 2:

                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {

                                            standardpackageTotal.push(item2
                                                .service_price)
                                        }
                                    });
                                    console.log(standardpackageTotal);
                                    const standardTotal = calculateArraySum(
                                        standardpackageTotal);
                                    const sdTotal = standardTotal - standardTotal * (item1
                                        .cp_discount / 100);
                                    packInfo = `
                                <div class="${cardWidth}">
                                <div class="card offer-card">
                                    <div class="offer-card-header header-standard">
                                        <h5 class="card-title text-center text-dark">Standard</h5>
                                        <span class="price-tag">${item1.cp_discount}% OFF</span>
                                    </div>
                                    <div class="card-body scroll__verticle">
                                        <h6 class="old-price">Rs. ${standardTotal}/</h6>
                                        <h3>Rs. ${sdTotal}/-</h3>
                                        <div class="price-card--features item">
                                            <ul class="price-card--features--list">
                                                `;

                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {
                                            let sname = item2.service_name;
                                            // console.log(item1.service_id);
                                            packInfo += `
                                    <li class="price-card--features--item has-tooltip">
                                                    <span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                    </svg></span>${sname} - ${item2.service_price}
                                                    <div class="tooltip-container bg-gradient-primary">
                                                    <strong>${sname}</strong>
                                                    <p class="text-white">${item2.description}</p>
                                                </div>
                                            </li>`;

                                        }
                                    });
                                    packInfo += `</ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form action="{{ route('Payment.Sub') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="amount" value="${sdTotal}">
                                        <input type="hidden" name="package_id" value="${package_id}">

                                        <button type="submit" class="btn btn-standard text-white btn-block">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                            </div>`;
                                    break;
                                case 3:
                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {

                                            premiumpackageTotal.push(item2
                                                .service_price)
                                        }
                                    });
                                    const premiumTotal = calculateArraySum(
                                        premiumpackageTotal);
                                    const pdTotal = premiumTotal - premiumTotal * (item1
                                        .cp_discount / 100);
                                    packInfo = `
                                <div class="${cardWidth}">
                                <div class="card offer-card">
                                    <div class="offer-card-header header-premium">
                                        <h5 class="card-title text-center text-dark">Premium</h5>
                                        <span class="price-tag">${item1.cp_discount}% OFF</span>
                                    </div>
                                    <div class="card-body scroll__verticle">
                                        <h6 class="old-price">Rs. ${premiumTotal}/</h6>
                                        <h3>Rs. ${pdTotal}/-</h3>
                                        <div class="price-card--features item">
                                            <ul class="price-card--features--list">
                                                `;

                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {
                                            let sname = item2.service_name;
                                            packInfo += `
                                    <li class="price-card--features--item has-tooltip">
                                                    <span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                    </svg></span>${sname} - ${item2.service_price}
                                                    <div class="tooltip-container bg-gradient-primary">
                                                    <strong>${sname}</strong>
                                                    <p class="text-white">${item2.description}</p>
                                                </div>
                                            </li>`;

                                        }
                                    });
                                    packInfo += `</ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form action="{{ route('Payment.Sub') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="amount" value="${pdTotal}">
                                        <input type="hidden" name="package_id" value="${package_id}">

                                        <button type="submit" class="btn btn-premium text-white btn-block">Buy Now</button>
                                    </form>
                                </div>
                            </div></div>`;
                                    break;


                                case 4:
                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {

                                            diamondpackageTotal.push(item2
                                                .service_price)
                                        }
                                    });
                                    const diamondTotal = calculateArraySum(
                                        diamondpackageTotal);
                                    const ddTotal = diamondTotal - diamondTotal * (item1
                                        .cp_discount / 100);
                                    packInfo = `
                                <div class="${cardWidth}">
                                <div class="card offer-card">
                                    <div class="offer-card-header header-diamond">
                                        <h5 class="card-title text-center text-dark">Diamond</h5>
                                        <span class="price-tag">${item1.cp_discount}% OFF</span>
                                    </div>
                                    <div class="card-body scroll__verticle">
                                        <h6 class="old-price">Rs. ${diamondTotal}/</h6>
                                        <h3>Rs. ${ddTotal}/-</h3>
                                        <div class="price-card--features item">
                                            <ul class="price-card--features--list">
                                                `;

                                    $.each(item.data2, function(index, item2) {
                                        if (service_id_array.includes(item2
                                                .service_id)) {
                                            let sname = item2.service_name;
                                            packInfo += `
                                    <li class="price-card--features--item has-tooltip">
                                                    <span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                    </svg></span>${sname} - ${item2.service_price}
                                                    <div class="tooltip-container bg-gradient-primary">
                                                    <strong>${sname}</strong>
                                                    <p class="text-white">${item2.description}</p>
                                                </div>
                                            </li>`;

                                        }
                                    });
                                    packInfo += `</ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form action="{{ route('Payment.Sub') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="amount" value="${ddTotal}">
                                        <input type="hidden" name="package_id" value="${package_id}">

                                        <button type="submit" class="btn btn-premium text-white btn-block">Buy Now</button>
                                    </form>
                                </div>
                            </div></div>`;
                                    break;
                            }



                            remark += packInfo;
                        });



                    } else {
                        remark += `<div class="alert alert-danger col-md-12 text-center">
                            <p>No Package Found!!</p>

                        </div>`;
                    }

                });




                // $('#basicTotal').html(result2);
                $('#showPackages').html(remark);

            }
        });
        $("#comboOffer").modal('show')

    }

    function GetAllServices() {

        const category_id = document.getElementById('f_category_id').value;
        const service_name = document.getElementById('f_service_name').value;

        $.ajax({
            type: "GET",
            url: "{{ route('Get-All-Services') }}",
            data: {
                category_id: category_id,
                service_name: service_name
            },
            success: function(data) {

                var remark = "";
                $.each(data, function(index, item) {
                    var serviceIds = item.serviceIds;
                    $.each(item.services, function(index, item1) {
                        // console.log(item1);
                        var fees = item1.service_price === 0 ? '' : 'Rs ' + item1
                            .service_price;
                        var service_id = item1.service_id;

                        var dataArray = item1.description.split(',');

                        let submitButton =
                            `<span class="btn bg-yellow text-dark" onclick="showPremiun(${service_id})"><b>Buy Now</b></span>
                                    <span class="btn bg-dark text-white" onclick="inqueryForm(${service_id})">Inquiry Now</span>`;

                        let inquiryButton =
                            `<span class="btn bg-dark btn-block text-white" onclick="inqueryForm(${service_id})">Inquiry Now</span>`;

                        var btn = item1.service_price === 0 ? inquiryButton : submitButton;

                        var descriptionItems = dataArray.map(function(element) {
                            return `<p><span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                            </svg></span>${element}</p>`;
                        }).join('');

                        remark += `
                <div class="pricing-column col-lg-4 col-md-6 mb-4">
                    <div class="allcards card">
                        <div class="card-header bg-yellow text-center">
                            <h4>${item1.service_name}</h4>
                            <h5 class="text-dark">${fees}</h5>

                        </div>
                        <div class="card-body text-center verticle__scroll">

                            <div class="item">${descriptionItems}</div>

                        </div>
                        <div class="card-footer bg-transparent border-success">${btn}</div>
                    </div>
                </div>`;
                    });
                });

                $('#All-Services').html(remark);
            }
        });
    }



    function ItemCount() {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Item-Count') }}",

            success: function(data) {
                // console.log(data);

                $.each(data, function(index, item) {

                    // console.log(item.length);
                    $("#itemCount").html(item.length);
                    $("#itemCount1").html(item.length);

                });
            }
        });

    }

    // add item to cart
    $(document).ready(function() {
        $(document).on('click', '.submit-button', function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            // AJAX submission
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    GetAllServices();
                    ItemCount();
                    GetTotal();
                    toastr.success(response.success);
                },
                error: function(response) {
                    toastr.success(response.danger);

                }
            });
        });
    });

    // get cart items
    function GetCartItems() {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Item-Count') }}",

            success: function(data) {
                // console.log(data);
                var remark = "";
                $.each(data, function(index, item) {
                    // console.log(item.length);

                    if (item.length == 0) {
                        document.getElementById('pay-now').style.display = 'none';
                        document.getElementById('totalAmount').style.display = 'none';
                        document.getElementById('pay-free').style.display = 'none';


                        remark += `
                        <div>
                                    <div class=" alert alert-danger text-center  mt-2" >
                                <strong>No Item Found</strong>
                            </div>
                            </div>
                            `;
                    } else {

                        const totalAmount = $("#totalAmount").val();

                        if (totalAmount == 0) {
                            document.getElementById('pay-free').style.display = 'block';
                            document.getElementById('pay-now').style.display = 'none';
                            document.getElementById('totalAmount').style.display = 'none';
                        } else {
                            document.getElementById('pay-now').style.display = 'block';
                            document.getElementById('totalAmount').style.display = 'block';
                        }
                        let serviceIDs = []
                        let categoryIDs = []
                        let finalAmounts = []
                        $.each(item, function(index, item1) {
                            console.log(item1);
                            serviceIDs.push(item1.service_id)
                            categoryIDs.push(item1.category_id)
                            finalAmounts.push(item1.service_price)
                            remark += `
                                <div>
                                    <div class="alert alert-info mt-2 d-flex justify-content-between" >
                                        <strong>${item1.service_name}</strong><strong>${item1.service_price}</strong>
                                        <strong class="text-danger" style="cursor:pointer;" onclick="RemoveCartItem(${item1.cart_id})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </strong>
                                    </div>
                                </div>
                            `;
                        });

                        $("#final_service_id").val(serviceIDs);
                        $("#final_category_id").val(categoryIDs);
                        $("#final_item_amount").val(finalAmounts);
                    }

                });
                $('#customerTasks').html(remark);
            }
        });
    }

    // remove cart item
    function RemoveCartItem(v) {
        // console.log(v);
        const cart_id = v;
        $.ajax({
            type: "get",
            url: "{{ route('Delete-Cart-Item') }}",
            data: {
                cart_id: cart_id
            },
            success: function(response) {
                toastr.success(response.success);
                GetCartItems()
                GetAllServices()
                GetCartItems()
                ItemCount()
                GetTotal()

            },
            error: function(response) {

                // console.log(error.responseJSON.message);
                // Handle the error response, if needed
                // toastr.error(error.responseJSON.message);
            }
        });
    }

    // get total cart amount
    function GetTotal() {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Item-Total') }}",

            success: function(data) {

                $.each(data, function(index, item) {
                    // console.log(item);

                    // console.log(item.service_price);
                    $("#totalAmount").html('Total : ' + item.TotalPrice);
                    $("#totalAmount").val(item.TotalPrice);
                    $("#amount").val(item.TotalPrice);

                });
            }
        });
    }

    // inquiry form
    function inqueryForm(service_id) {

        $("#query_service_id").val(service_id);
        $("#inquiryForm").modal('show');
    }

    $(document).ready(function() {
        $('#inquiry_form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log('success' + response.msg);
                    $("#inquiryForm").modal('hide')
                    document.getElementById('customer_query').value = '';
                    // Show a success toast
                    toastr.success(response.msg);
                },
                error: function(error) {
                    // console.log('error' + error.responseJSON);
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error("Please try again later...");
                }
            });
        });
    });
</script>
<script>
    // Function to close the flash message
    function closeFlashMessage() {
        document.getElementById('flash-message').style.display = 'none';
    }

    // Automatically close the flash message after 5000 milliseconds (5 seconds)
    setTimeout(function() {
        closeFlashMessage();
    }, 5000);
</script>
