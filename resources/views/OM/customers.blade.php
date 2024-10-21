@include('ui.header')
<style>
    .msg {
        font-size: 12px;
    }

    body {
        background-color: #eee;
    }

    .mt-70 {
        margin-top: 70px;
    }

    .mb-70 {
        margin-bottom: 70px;
    }

    .card {
        box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
        border-width: 0;
        transition: all .2s;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(26, 54, 126, 0.125);
        border-radius: .25rem;
    }

    .work-effort {
        margin-left: 1rem;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .vertical-timeline {
        width: 100%;
        position: relative;
        padding: 1.5rem 0 1rem;
    }

    .vertical-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 77px;
        height: 100%;
        width: 4px;
        background: #e9ecef;
        border-radius: .25rem;
    }

    .vertical-timeline-element {
        position: relative;
        margin: 0 0 1rem;
    }

    .vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
        visibility: visible;
        animation: cd-bounce-1 .8s;
    }

    .vertical-timeline-element-icon {
        position: absolute;
        top: 0;
        left: 70px;
    }

    .vertical-timeline-element-icon .badge-dot-xl {
        box-shadow: 0 0 0 5px #fff;
    }

    .badge-dot-xl {
        width: 18px;
        height: 18px;
        position: relative;
    }

    .badge:empty {
        display: none;
    }


    .badge-dot-xl::before {
        content: '';
        width: 10px;
        height: 10px;
        border-radius: .25rem;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -5px 0 0 -5px;
        background: #fff;
    }

    .vertical-timeline-element-content {
        position: relative;
        margin-left: 90px;
        font-size: .8rem;
    }

    .vertical-timeline-element-content .timeline-title {
        font-size: .8rem;
        text-transform: uppercase;
        margin-left: 1rem;
        padding: 2px 0 0;
        font-weight: bold;
    }

    .vertical-timeline-element-content .vertical-timeline-element-date {
        display: block;
        position: absolute;
        left: -90px;
        top: 0;
        padding-right: 10px;
        text-align: right;
        color: #adb5bd;
        font-size: .7619rem;
        white-space: nowrap;
    }

    .vertical-timeline-element-content:after {
        content: "";
        display: table;
        clear: both;
    }

    /* left modal */

    .modal.left .modal-dialog {
        position: fixed;
        right: 0;
        margin: auto;
        width: 200%;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .modal.right .modal-body {
        padding: 15px 15px 80px;
    }

    .modal.right.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.right.fade.show .modal-dialog {
        right: 0;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #eeeeee;
        background-color: #fafafa;
    }

    /* ----- v CAN BE DELETED v ----- */


    .demo {
        padding-top: 60px;
        padding-bottom: 110px;
    }

    .btn-demo {
        margin: 15px;
        padding: 10px 15px;
        border-radius: 0;
        font-size: 16px;
        background-color: #ffffff;
    }

    .btn-demo:focus {
        outline: 0;
    }

    .scrollable-div {
        height: 480px;
        overflow-x: auto;
    }
</style>
<style>
    .box {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border-top: 3px solid #d2d6de;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .box.box-primary {
        border-top-color: #3c8dbc;
    }

    .box.box-info {
        border-top-color: #00c0ef;
    }

    .box.box-danger {
        border-top-color: #dd4b39;
    }

    .box.box-warning {
        border-top-color: #f39c12;
    }

    .box.box-success {
        border-top-color: #00a65a;
    }

    .box.box-default {
        border-top-color: #d2d6de;
    }

    .box.collapsed-box .box-body,
    .box.collapsed-box .box-footer {
        display: none;
    }

    .box .nav-stacked>li {
        border-bottom: 1px solid #f4f4f4;
        margin: 0;
    }

    .box .nav-stacked>li:last-of-type {
        border-bottom: none;
    }

    .box.height-control .box-body {
        max-height: 300px;
        overflow: auto;
    }

    .box .border-right {
        border-right: 1px solid #f4f4f4;
    }

    .box .border-left {
        border-left: 1px solid #f4f4f4;
    }

    .box.box-solid {
        border-top: 0;
    }

    .box.box-solid>.box-header .btn.btn-default {
        background: transparent;
    }

    .box.box-solid>.box-header .btn:hover,
    .box.box-solid>.box-header a:hover {
        background: rgba(0, 0, 0, 0.1);
    }

    .box.box-solid.box-default {
        border: 1px solid #d2d6de;
    }

    .box.box-solid.box-default>.box-header {
        color: #444;
        background: #d2d6de;
        background-color: #d2d6de;
    }

    .box.box-solid.box-default>.box-header a,
    .box.box-solid.box-default>.box-header .btn {
        color: #444;
    }

    .box.box-solid.box-primary {
        border: 1px solid #3c8dbc;
    }

    .box.box-solid.box-primary>.box-header {
        color: #fff;
        background: #3c8dbc;
        background-color: #3c8dbc;
    }

    .box.box-solid.box-primary>.box-header a,
    .box.box-solid.box-primary>.box-header .btn {
        color: #fff;
    }

    .box.box-solid.box-info {
        border: 1px solid #00c0ef;
    }

    .box.box-solid.box-info>.box-header {
        color: #fff;
        background: #00c0ef;
        background-color: #00c0ef;
    }

    .box.box-solid.box-info>.box-header a,
    .box.box-solid.box-info>.box-header .btn {
        color: #fff;
    }

    .box.box-solid.box-danger {
        border: 1px solid #dd4b39;
    }

    .box.box-solid.box-danger>.box-header {
        color: #fff;
        background: #dd4b39;
        background-color: #dd4b39;
    }

    .box.box-solid.box-danger>.box-header a,
    .box.box-solid.box-danger>.box-header .btn {
        color: #fff;
    }

    .box.box-solid.box-warning {
        border: 1px solid #f39c12;
    }

    .box.box-solid.box-warning>.box-header {
        color: #fff;
        background: #f39c12;
        background-color: #f39c12;
    }

    .box.box-solid.box-warning>.box-header a,
    .box.box-solid.box-warning>.box-header .btn {
        color: #fff;
    }

    .box.box-solid.box-success {
        border: 1px solid #00a65a;
    }

    .box.box-solid.box-success>.box-header {
        color: #fff;
        background: #00a65a;
        background-color: #00a65a;
    }

    .box.box-solid.box-success>.box-header a,
    .box.box-solid.box-success>.box-header .btn {
        color: #fff;
    }

    .box.box-solid>.box-header>.box-tools .btn {
        border: 0;
        box-shadow: none;
    }

    .box.box-solid[class*='bg']>.box-header {
        color: #fff;
    }

    .box .box-group>.box {
        margin-bottom: 5px;
    }

    .box .knob-label {
        text-align: center;
        color: #333;
        font-weight: 100;
        font-size: 12px;
        margin-bottom: 0.3em;
    }

    .box>.overlay,
    .overlay-wrapper>.overlay,
    .box>.loading-img,
    .overlay-wrapper>.loading-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%
    }

    .box .overlay,
    .overlay-wrapper .overlay {
        z-index: 50;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 3px;
    }

    .box .overlay>.fa,
    .overlay-wrapper .overlay>.fa {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -15px;
        margin-top: -15px;
        color: #000;
        font-size: 30px;
    }

    .box .overlay.dark,
    .overlay-wrapper .overlay.dark {
        background: rgba(0, 0, 0, 0.5);
    }

    .box-header:before,
    .box-body:before,
    .box-footer:before,
    .box-header:after,
    .box-body:after,
    .box-footer:after {
        content: " ";
        display: table;
    }

    .box-header:after,
    .box-body:after,
    .box-footer:after {
        clear: both;
    }

    .box-header {
        color: #444;
        display: block;
        padding: 10px;
        position: relative;
    }

    .box-header.with-border {
        border-bottom: 1px solid #f4f4f4;
    }

    .collapsed-box .box-header.with-border {
        border-bottom: none;
    }

    .box-header>.fa,
    .box-header>.glyphicon,
    .box-header>.ion,
    .box-header .box-title {
        display: inline-block;
        font-size: 18px;
        margin: 0;
        line-height: 1;
    }

    .box-header>.fa,
    .box-header>.glyphicon,
    .box-header>.ion {
        margin-right: 5px;
    }

    .box-header>.box-tools {
        position: absolute;
        right: 10px;
        top: 5px;
    }

    .box-header>.box-tools [data-toggle="tooltip"] {
        position: relative;
    }

    .box-header>.box-tools.pull-right .dropdown-menu {
        right: 0;
        left: auto;
    }

    .btn-box-tool {
        padding: 5px;
        font-size: 12px;
        background: transparent;
        color: #97a0b3;
    }

    .open .btn-box-tool,
    .btn-box-tool:hover {
        color: #606c84;
    }

    .btn-box-tool.btn:active {
        box-shadow: none;
    }

    .box-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        padding: 10px;
    }

    .no-header .box-body {
        border-top-right-radius: 3px;
        border-top-left-radius: 3px;
    }

    .box-body>.table {
        margin-bottom: 0;
    }

    .box-body .fc {
        margin-top: 5px;
    }

    .box-body .full-width-chart {
        margin: -19px;
    }

    .box-body.no-padding .full-width-chart {
        margin: -9px;
    }

    .box-body .box-pane {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 3px;
    }

    .box-body .box-pane-right {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 0;
    }

    .box-footer {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        border-top: 1px solid #f4f4f4;
        padding: 10px;
        background-color: #fff;
    }

    .direct-chat .box-body {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        position: relative;
        overflow-x: hidden;
        padding: 0;
    }

    .direct-chat.chat-pane-open .direct-chat-contacts {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .direct-chat-messages {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        padding: 10px;
        height: 250px;
        overflow: auto;
    }

    .direct-chat-msg,
    .direct-chat-text {
        display: block;
    }

    .direct-chat-msg {
        margin-bottom: 10px;
    }

    .direct-chat-msg:before,
    .direct-chat-msg:after {
        content: " ";
        display: table;
    }

    .direct-chat-msg:after {
        clear: both;
    }

    .direct-chat-messages,
    .direct-chat-contacts {
        -webkit-transition: -webkit-transform .5s ease-in-out;
        -moz-transition: -moz-transform .5s ease-in-out;
        -o-transition: -o-transform .5s ease-in-out;
        transition: transform .5s ease-in-out;
    }

    .direct-chat-text {
        border-radius: 5px;
        position: relative;
        padding: 5px 10px;
        background: #d2d6de;
        border: 1px solid #d2d6de;
        margin: 5px 0 0 50px;
        color: #444;
    }

    .direct-chat-text:after,
    .direct-chat-text:before {
        position: absolute;
        right: 100%;
        top: 15px;
        border: solid transparent;
        border-right-color: #d2d6de;
        content: ' ';
        height: 0;
        width: 0;
        pointer-events: none;
    }

    .direct-chat-text:after {
        border-width: 5px;
        margin-top: -5px;
    }

    .direct-chat-text:before {
        border-width: 6px;
        margin-top: -6px;
    }

    .right .direct-chat-text {
        margin-right: 50px;
        margin-left: 0;
    }

    .right .direct-chat-text:after,
    .right .direct-chat-text:before {
        right: auto;
        left: 100%;
        border-right-color: transparent;
        border-left-color: #d2d6de;
    }

    .direct-chat-img {
        border-radius: 50%;
        float: left;
        width: 40px;
        height: 40px;
    }

    .right .direct-chat-img {
        float: right;
    }

    .direct-chat-info {
        display: block;
        margin-bottom: 2px;
        font-size: 12px;
    }

    .direct-chat-name {
        font-weight: 600;
    }

    .direct-chat-timestamp {
        color: #999;
    }

    .direct-chat-contacts-open .direct-chat-contacts {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .direct-chat-contacts {
        -webkit-transform: translate(101%, 0);
        -ms-transform: translate(101%, 0);
        -o-transform: translate(101%, 0);
        transform: translate(101%, 0);
        position: absolute;
        top: 0;
        bottom: 0;
        height: 250px;
        width: 100%;
        background: #222d32;
        color: #fff;
        overflow: auto;
    }

    .contacts-list>li {
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        padding: 10px;
        margin: 0;
    }

    .contacts-list>li:before,
    .contacts-list>li:after {
        content: " ";
        display: table;
    }

    .contacts-list>li:after {
        clear: both;
    }

    .contacts-list>li:last-of-type {
        border-bottom: none;
    }

    .contacts-list-img {
        border-radius: 50%;
        width: 40px;
        float: left;
    }

    .contacts-list-info {
        margin-left: 45px;
        color: #fff;
    }

    .contacts-list-name,
    .contacts-list-status {
        display: block;
    }

    .contacts-list-name {
        font-weight: 600;
    }

    .contacts-list-status {
        font-size: 12px;
    }

    .contacts-list-date {
        color: #aaa;
        font-weight: normal;
    }

    .contacts-list-msg {
        color: #999;
    }

    .direct-chat-primary .right>.direct-chat-text {
        background: #3c8dbc;
        border-color: #3c8dbc;
        color: #fff;
    }

    .direct-chat-primary .right>.direct-chat-text:after,
    .direct-chat-primary .right>.direct-chat-text:before {
        border-left-color: #3c8dbc;
    }

    .client-chatting {
        overflow-y: auto;
        height: 300px;
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Customer List</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="filter_type" onchange="GetAllCustomers(this.value)">
                                <option value="0">All</option>
                                <option value="1">Basic</option>
                                <option value="2">Standard</option>
                                <option value="3">Premium</option>
                                <option value="4">Diamond</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="filter_category_id" onchange="GetAllCustomers(this.value)">
                                <option value="0">All</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->category_id }}">{{ $categorie->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--<div class="col-lg-2 col-md-3 col-6">-->
                    <!--    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"-->
                    <!--        data-bs-target="#bulkAdd">-->
                    <!--        Bulk Add-->
                    <!--    </button>-->
                    <!--</div>-->
                    <!--<div class="col-lg-3 col-md-3 col-6">-->
                    <!--    <a href="{{ url('/upload_customers.xltm') }}" download="upload_customers.xltm">-->
                    <!--        <button class="btn btn-primary btn-sm">Sample Excel File</button>-->
                    <!--    </a>-->
                    <!--</div>-->
                    <h6><svg style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#addCustomer"
                            xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-person-fill-add" viewBox="0 0 16 16">
                            <path
                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path
                                d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                        </svg></h6>

                </div>
                <div class="ms-panel-body">

                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Category</th>
                                    <th>service</th>
                                    <th>Type</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Unpaid</th>
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
<div class="modal fade" id="bulkAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Bulk Customers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="addBulkCustomerForm" method="POST" action="{{ route('add-bulk-offline-customer') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label" for="basic-default-fullname">Select File</label>
                            <input name="file" id="fileInput" type="file" class="form-control" placeholder=""
                                required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Add Customers</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addCustomer" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCustomerLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="addCustomerLabel">Add New Customer</h5>
            </div>
            <div class="modal-body">
                <form id="addOfflineCustomer123" action="{{ route('om-add-offline-customer') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" placeholder="Customer Name"
                                name="customer_name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Business Name">Company/Shop Name</label>

                            <input type="text" class="form-control" placeholder="Company/Shop Name"
                                name="customer_businessName" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Email">Email</label>

                            <input type="text" class="form-control" placeholder="Email" name="customer_email"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Mobile">Mobile No</label>

                            <input type="text" class="form-control" placeholder="Mobile No"
                                name="customer_mobile" required>
                        </div>
                        <div class="col-md-4">
                            <label for="State">State</label>

                            <input type="text" class="form-control" placeholder="State" name="customer_state"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="City">City</label>

                            <input type="text" class="form-control" placeholder="City" name="customer_city"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Service">Category</label>
                            <select class="form-control" onchange="GetServices(this.value)" name=""
                                id="" required>
                                <option>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="Service">Service</label>
                            <select class="form-control" onchange="GetServicePrice(this.value)"
                                name="customer_service" id="serviceSelect" required>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="Total Amount">Total Amount</label>

                            <input type="text" id="actual_service_price" readonly class="form-control"
                                placeholder="Total Amount" name="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Apply Coupon">Apply Coupon</label>
                            <input type="text" id="apply_coupon" name="apply_coupon" class="form-control"
                                onchange="applyCouponCode(this.value)" placeholder="enter coupon code if any">
                            <div id="coupon-error"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="Total Amount">Discount Amount</label>

                            <input type="hidden" id="actual_service_price">
                            <input type="text" id="total_service_price" readonly class="form-control"
                                placeholder="Total Amount" name="customer_total_service_price" value="0"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="Payment">Payment Mode</label>
                            <select id="payment_mode" name="customer_payment_mode" class="form-control"
                                onchange="PaymentMode(this.value)" required>
                                <option selected disabled>Select EMI</option>
                                <option value="1">No EMI</option>
                                <option value="2">2 EMI</option>
                                <option value="3">3 EMI</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Total Amount">Paid Amount</label>

                            <input type="text" class="form-control" placeholder="Paid Amount"
                                id="total_paid_amount" onchange="CalculateUnpaidAmount(this.value)"
                                name="customer_paid_amount" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Payment">1st EMI</label>

                            <input type="text" id="total_unpaid_amount" class="form-control"
                                placeholder="1st EMI" name="customer_unpaid_amount" value="0" required readonly>
                        </div>
                        <div class="col-md-4" style="display:none;" id="second_emi">
                            <label for="Payment">2nd EMI</label>

                            <input type="text" id="total_unpaid_amount22" class="form-control"
                                placeholder="2nd EMI" name="customer_unpaid_amount22" value="0" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="Total Amount">1st Due Date</label>

                            <input type="date" id="due_date" class="form-control" placeholder="Due Date"
                                name="customer_due_date" readonly>
                        </div>
                        <div class="col-md-4" style="display:none;" id="second_emi_date">
                            <label for="Total Amount">2nd Due Date</label>

                            <input type="date" id="due_date2" class="form-control" placeholder="Due Date"
                                name="customer_due_date2" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="Payment">Comment Box</label>

                            <textarea class="form-control" name="customer_comment" cols="30" rows="3" placeholder="Comment ..."
                                required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-gradient-info btn-block">Add</button>
                        </div>
                        <div class="col-md-2">
                            <button type="reset" class="btn btn-gradient-danger btn-block"
                                onclick="clearSpan()">Reset</button>
                        </div>

                    </div>



                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="workTimeline" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="workTimelineLabel" aria-hidden="true">
    <div class=" modal-dialog-scrollable modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ms-panel-body">
                    <ul class="nav nav-tabs tabs-bordered d-flex nav-justified mb-4" role="tablist">
                        <li role="presentation"><a href="#tab1" aria-controls="tab1" class="active show"
                                role="tab" data-toggle="tab" aria-selected="true"> Direct Chat </a></li>
                        <li role="presentation"><a href="#tab2" aria-controls="tab2" class=""
                                role="tab" data-toggle="tab" aria-selected="false"> Work Timeline </a></li>
                        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab"
                                data-toggle="tab" class="" aria-selected="false"> Service Price </a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active show" id="tab1">
                            <div>
                                <div class="box box-primary direct-chat direct-chat-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Direct Chat</h3>

                                    </div>
                                    <div class="box-body">
                                        <div class="direct-chat-messages client-chatting" id="client-chatting">

                                        </div>

                                    </div>
                                    <div class="box-footer">


                                        <form id="sendChatMsg" action="{{ route('customer-chatting-from-manager') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="cust_id" id="chat_cust_id" value="">
                                            <input type="hidden" name="service_id" id="chat_service_id"
                                                value="">
                                            <div class="input-group">
                                                <input type="text" name="chat_msg" id="chat-msg"
                                                    placeholder="Type Message ..." class="form-control">
                                                <button type="submit" class=" btn-square btn-gradient-info"><i
                                                        class="flaticon-tick-inside-circle"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade " id="tab2">
                            <div class="row d-flex justify-content-center">

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <select class="form-control" name="customer_task_id"
                                            onchange="GetCustomerWorkTimeline(this.value)" id="customerTaskList">
                                        </select>
                                    </div>
                                    <br>
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">



                                            <div id="my_works"
                                                class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab3">
                            <div id="service-price">

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
{{-- add work taskl --}}

<div class="modal left fade" id="AddWorkEffort" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h5 class="modal-title text-white" id="AddWorkEffortLabel">Add Tasks</h5>
            </div>
            <div class="modal-body">
                <form id="addNewTask" class="row g-3" action="{{ route('add-customer-tasks') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cust_id" id="work_cust_id" value="">
                    <input type="hidden" name="service_id" id="service_id" value="">
                    <div class="container">
                        <div class="row g-2">

                            <div class="col-md-10">
                                <input class="form-control" type="text" name="cust_task" id="cust_task"
                                    placeholder="Create New Task">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn-primary form-control ">Add</button>
                            </div>
                        </div>

                        <br>
                    </div>
                </form>
                <div class="scrollable-div px-3" id="customerTasks">

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
                                <input type="date" name="due_date" id="due_date"
                                    class="form-control shadow-none">
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


{{-- Add Employee Modal --}}
<div class="modal fade" id="addEmployee" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Add New Manager</h5>
            </div>
            <div class="modal-body">
                <form id="addNewEmployee" class="row g-3" action="{{ route('add-franchise-employee') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Name</span>
                            <input type="text" class="form-control shadow-none" name="username"
                                placeholder="Name" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Email</span>
                            <input type="email" class="form-control shadow-none" name="email"
                                placeholder="Email" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Contact</span>
                            <input type="text" class="form-control shadow-none" name="contact"
                                placeholder="Contact" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Password</span>
                            <input type="text" class="form-control shadow-none" name="password"
                                placeholder="Password" value="" required>
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>

                        <br>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editEmployee" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="addEmployeeLabel">Edit Admin</h5>
            </div>
            <div class="modal-body">
                <form id="updateEmployee" class="row g-3" action="{{ route('update-franchise-employee') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Name</span>
                            <input type="text" class="form-control shadow-none" id="username" name="username"
                                placeholder="Name" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Email</span>
                            <input type="email" class="form-control shadow-none" id="email" name="email"
                                placeholder="Email" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Contact</span>
                            <input type="text" class="form-control shadow-none" id="contact" name="contact"
                                placeholder="Contact" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text bg-danger text-white">Password</span>
                            <input type="text" class="form-control shadow-none" id="password" name="password"
                                placeholder="Password" value="" required>
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>

                        <br>
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



<script type="text/javascript">
    function clearSpan() {
        document.getElementById('coupon-error').innerHTML = '';
    }
    $('#workTimeline').on('hidden.bs.modal', function() {
        $('#my_works').html('');
    });

    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('operation-manage-customer') }}",

            columns: [{
                    data: 'mark2',
                    name: 'name',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'contact',
                    name: 'contact',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'category_name',
                    name: 'category_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'service_name',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'cp_type',
                    name: 'cp_type',
                    render: function(data) {

                        switch (data) {
                            case 1:
                                return "<span class='badge bg-success me-1 text-white'>Basic</span>"
                                break;

                            case 2:
                                return "<span class='badge bg-secondary me-1 text-white'>Standard</span>"
                                break;
                            case 3:
                                return "<span class='badge bg-warning me-1 text-white'>Premium</span>"
                                break;
                            case 4:
                                return "<span class='badge bg-danger me-1 text-white'>Diamond</span>"
                                break;
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_total_amount',
                    name: 'total_amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_paid_amount',
                    name: 'emi_paid_amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_unpaid_amount',
                    name: 'emi_unpaid_amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_due_date',
                    name: 'emi_due_date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'action',
                    name: 'action',
                    "searchable": false,
                    "orderable": false,
                    "class": 'text-center',
                },



            ]
        });


    });

    // customer tasks list/dropdown
    function GetCustomerTasks123(cust_id, orderId, service_id) {
        // console.log(orderId);
        getServicePrice(orderId);
        OpenChatBox(cust_id, service_id)
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Tasks') }}",
            data: {
                cust_id: cust_id,
                service_id: service_id
            },
            success: function(data) {
                populateDropdown(data);

                $("#workTimeline").modal('show')
            }
        });

        function populateDropdown(data) {
            var dropdown = $('#customerTaskList');

            // Clear existing options
            dropdown.empty();

            // Add new options
            dropdown.append($('<option selected disabled>').text('Select Task'))
            $.each(data, function(index, item) {
                $.each(item, function(index, item1) {

                    // console.log(item1);
                    dropdown.append($('<option>').text(item1.task_name).val(item1.task_id));
                });
            });

        }
    }

    // customer work timeline/ work progress
    function GetCustomerWorkTimeline(cust_id) {
        // console.log(cust_id);

        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Work-Details') }}",
            data: {
                cust_id: cust_id
            },
            success: function(data) {
                var remark = "";
                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {
                        let statusClass;
                        let workStatus;

                        switch (item1.status) {

                            case 2:
                                statusClass = 'badge-warning';
                                workStatus =
                                    '<span class="badge badge-warning">Work In Progress</span>';
                                break;
                            case 3:
                                statusClass = 'badge-danger';
                                workStatus =
                                    '<span class="badge badge-danger">Pending From Client</span>';
                                break;
                            case 4:
                                statusClass = 'badge-secondary';
                                workStatus =
                                    '<span class="badge badge-secondary">Invoiced</span>';
                                break;
                            case 5:
                                statusClass = 'badge-success';
                                workStatus =
                                    '<span class="badge badge-success">Completed</span>';
                                break;
                            case 6:
                                statusClass = 'badge-primary';
                                workStatus =
                                    '<span class="badge badge-primary">Return Back</span>';
                                break;
                            case 7:
                                statusClass = 'badge-primary';
                                workStatus =
                                    '<span class="badge badge-primary">Cancle</span>';
                                break;


                            default:
                                statusClass = 'badge-danger';
                                workStatus =
                                    '<span class="badge badge-danger">Not Started</span>';
                                break;
                        }

                        remark += `
                                <div class="vertical-timeline-item vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                            <i class="badge badge-dot badge-dot-xl ${statusClass}"> </i>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 id="work_timeline_date" class="timeline-title">${workStatus}</h4>
                                            <p id="work_timeline_work" class="work-effort">${item1.work} <br> <span class="text-info">${item1.username   }</span></p>

                                            <span class="vertical-timeline-element-date">${item1.date}</span>
                                        </div>
                                    </div>
                                </div>
                            `;




                    });
                });
                $('#my_works').html(remark);
                $("#workTimeline").modal('show')
            }
        });


    }

    function getServicePrice(order_id) {
        // console.log(cust_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Service-Price') }}",
            data: {
                order_id: order_id
            },
            success: function(data) {

                var remark = "";
                $.each(data, function(index, item) {


                    $.each(item, function(index, item1) {

                        const due_date = item1.emi_due_date ? item1.emi_due_date :
                            'Not required';

                        const total_unpaid_amount = item1.emi_unpaid_amount + item1.second_emi;
                        const unpaid_amount = total_unpaid_amount ? 'RS ' + total_unpaid_amount : 'No Pending Payment';

                        remark += `
                            <div class="container">
                                <div class="d-flex justify-content-between">
                                    <span><b>Total Amount:</b> <br/> Rs. ${item1.emi_total_amount}</span>
                                    <span><b>Paid Amount:</b> <br/> Rs. ${item1.emi_paid_amount}</span>
                                    <span><b>Unpaid Amount:</b> <br/> ${unpaid_amount}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span><b>2nd EMI:</b> <br/> ${item1.emi_unpaid_amount}</span>
                                    <span><b>2nd Due Date:</b> <br/>  ${item1.emi_due_date ? item1.emi_due_date : 'NA'}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span><b>3rd EMI:</b> <br/> ${item1.second_emi ? item1.second_emi : 'NA'}</span>
                                    <span><b>3rd Due Date:</b> <br/>  ${item1.second_emi_due_date ? item1.second_emi_due_date : 'NA'}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-start">
                                    <span><b>Comment:</b> <br/> ${item1.emi_comment}</span>
                                </div>`;

                        if (total_unpaid_amount > 0) {
                            remark += `
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <form id="updateEMI" action="{{ route('om-update-emi') }}" method="post"  enctype="multipart/form-data">
                                        <div class="row">
                                            @csrf
                                            <div class="col-md-6">
                                            <label for="">Paid Amount</label>
                                            <input type="hidden" id="total_unpaid_amount2" value="${item1.emi_unpaid_amount}" >
                                            <input type="hidden" name="customer_id" value="${item1.customer_id}" >
                                            <input type="number" class="form-control shadow-none" name="paid_amount" onchange="calculateUnpaid(this.value)" placeholder="Paid Amount" required>
                                            </div>
                                            <br><br>
                                            <div class="col-md-6">
                                            <label for="">Unpaid Amount</label>
                                            <input type="number" class="form-control shadow-none" id="final_unpaid_amount" name="unpaid_amount" placeholder="Unpaid Amount" required readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Payment Screenshot</label>
                                            <input type="file" class="form-control shadow-none" name="payment_screenshot" required accept="image/*">
                                        </div>
                                            <br><br>
                                            <input type="hidden" class="form-control shadow-none" name="emi_no" value="${item1.emi_id}">
                                            <div class="col-md-6"><input type="submit" class="btn btn-info" value="Pay Now"></div>
                                        </div>
                                    </form>
                                </div>`;
                        }

                        remark += `</div>`;




                    });
                });
                $('#service-price').html(remark);
            }
        });

    }
    // add work effort
    function AddWorkEffort(cust_id, service_id) {
        // console.log(service_id);

        $("#work_cust_id").val(cust_id);
        $("#service_id").val(service_id);
        $("#AddWorkEffort").modal('show')
        GetCustomerTasks(cust_id, service_id);
    }


    // customer tasks
    function GetCustomerTasks(cust_id, service_id) {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Tasks') }}",
            data: {
                cust_id: cust_id,
                service_id: service_id
            },
            success: function(data) {
                var remark = "";
                $.each(data, function(index, item) {


                    if (item.length > 0) {
                        $.each(item, function(index, item1) {
                            // console.log(item1);

                            let assignedUser;

                            if (item1.is_return == 1) {
                                assignedUser = "Return Back";
                            } else {
                                assignedUser = item1.username !== null ? item1.username :
                                    "Not Assigned";

                            }

                            let assignedClass;
                            let textClass;

                            switch (item1.is_assign) {
                                case 0:
                                    if (item1.is_return == 1) {
                                        assignedClass = 'bg-danger';
                                        break;
                                    } else {
                                        assignedClass = 'bg-warning';
                                        break;
                                    }

                                case 1:
                                    assignedClass = 'bg-success text-white';
                                    textClass = 'text-white';
                                    break;

                                default:
                                    assignedClass = 'bg-danger text-white';
                                    textClass = 'text-white';
                                    break;

                            }


                            remark += `
                            <div class="row">
                                <div class="col-md-9 accordion has-gap ms-accordion-chevron" id="accordionExample2">

                                <div class="card">
                                <div class="card-header collapsed  ${assignedClass}" data-toggle="collapse" data-target="#collapseFive${item1.taskID}" role="button" aria-expanded="false" aria-controls="collapseFive">
                                    <span class="${textClass}"> ${item1.task_name} </span>
                                </div>

                                <div id="collapseFive${item1.taskID}" class="collapse" data-parent="#accordionExample2" style="">
                                    <div class="card-body">

                                    Assign To: ${assignedUser}

                                    </div>
                                </div>
                                </div>

                                </div>
                            <div style="cursor:pointer" onclick="AssignCustTask(${item1.taskID})" class="col-md-1 alert alert-success mx-2 px-2" >
                                <strong>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                    </svg>
                                </strong>
                            </div>
                            <div style="cursor:pointer" onclick="DeleteCustTask(${item1.taskID})" class="col-md-1 alert alert-danger px-2" >
                                <strong>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </strong>
                            </div>
                            </div>
                            `;

                        });
                    } else {
                        remark += `
                        <div>
                                    <div class=" alert alert-danger text-center  mt-2" >
                                <strong>Task Not Found</strong>
                            </div>
                            </div>
                            `;
                    }


                });
                $('#customerTasks').html(remark);
                // $("#workTimeline").modal('show')
            }
        });
    }

    // assign customer task
    function AssignCustTask(task_id) {
        // alert(task_id)
        $("#task-assign-to-id").val(task_id)
        // task-assign-to-id
        $("#AssignTaskTo").modal('show')

    }

    // delete customer task
    function DeleteCustTask(task_id) {
        // alert(task_id);
        $.ajax({
            type: "get",
            url: "{{ route('Delete-Customer-Task') }}",
            data: {
                task_id: task_id
            },
            success: function(data) {
                var c_id = document.getElementById('work_cust_id').value;
                var service_id = document.getElementById('service_id').value;
                GetCustomerTasks(c_id, service_id)
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('Task Deleted!!!');

            },
            error: function(error) {
                // console.log(error.responseJSON.message);
                // Handle the error response, if needed
                toastr.error('Getting Error');
            }
        });
    }


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

    // add data
    $(document).ready(function() {
        $('#addNewEmployee').on('submit', function(e) {
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
                    document.getElementById('addNewEmployee').reset();
                    // Show a success toast
                    toastr.success('User Added!!!');
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });

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

    // add new task
    $(document).ready(function() {
        $('#addNewTask').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    var c_id = document.getElementById('work_cust_id').value;
                    var service_id = document.getElementById('service_id').value;
                    GetCustomerTasks(c_id, service_id)
                    $('.data-table').DataTable().ajax.reload(null, false);
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('cust_task').value = '';
                    // Show a success toast
                    toastr.success('Task Added!!');
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error('Wrong!!!');
                }
            });
        });
    });

    // AssignCutomerTaskTo
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
                    var c_id = document.getElementById('work_cust_id').value;
                    var service_id = document.getElementById('service_id').value;
                    GetCustomerTasks(c_id, service_id)
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

    // add new offline customer
    $(document).ready(function() {
        $('#addOfflineCustomer').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.data-table').DataTable().ajax.reload(null, false);
                    document.getElementById('addOfflineCustomer').reset();
                    // Show a success toast
                    toastr.success('User Added!!!');
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });

    // delete franchise employee
    function DeleteFranchiseEmployee(user_id) {
        // alert(user_id)
        $.ajax({
            type: "get",
            url: "{{ route('Delete-Franchise-Employee') }}",
            data: {
                user_id: user_id
            },
            success: function(data) {
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('User Deleted!!!');

            },
            error: function(error) {
                // console.log(error.responseJSON.message);
                // Handle the error response, if needed
                toastr.error(error.responseJSON.message);
            }
        });
    }




    // chatting section
    // Get-Customer-Chat-Details
    function OpenChatBox(cust_id, service_id) {

        // console.log(service_id);
        $("#chat_cust_id").val(cust_id);
        $("#chat_service_id").val(service_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Chat-Details-Manager') }}",
            data: {
                cust_id: cust_id,
                service_id: service_id
            },
            success: function(data) {
                var remark = "";
                $.each(data, function(index, item) {

                    // console.log(item);
                    $.each(data, function(index, item) {

                        // console.log(item.chat_from);
                        $.each(item, function(index, item1) {
                            // console.log(item1);


                            if (item1.chat_from != cust_id) {

                                remark += `
                            <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">Employee</span>
                            <span class="direct-chat-timestamp pull-left">${item1.date}</span>
                        </div>
                        <img class="direct-chat-img" src="https://bootdey.com/img/Content/user_1.jpg"
                            alt="Message User Image">
                        <div class="direct-chat-text">
                            ${item1.chat_msg}
                        </div>
                    </div>
                            `;

                            } else {

                                remark += `<div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">client</span>
                            <span class="direct-chat-timestamp pull-right">${item1.date}</span>
                        </div>
                        <img class="direct-chat-img" src="https://bootdey.com/img/Content/user_1.jpg"
                            alt="Message User Image">
                        <div class="direct-chat-text">
                            ${item1.chat_msg}
                        </div>

                    </div>
                            `;


                            }

                        });
                    });
                });
                $('#client-chatting').html(remark);
                scrollToBottom();
            }
        });

    }
    setInterval(function() {
        var custID = document.getElementById("chat_cust_id").value;
        var service_id = document.getElementById("chat_service_id").value;

        var modal = $("#ChatBox");
        if (modal.hasClass('show')) {
            OpenChatBox(custID, service_id);
            scrollToBottom();
        }
        scrollToBottom();
    }, 10000);

    function scrollToBottom() {
        var scrollableDiv = document.getElementById('client-chatting');
        scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
    }


    // add chat
    $(document).ready(function() {
        $('#sendChatMsg').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    var custID = document.getElementById('chat_cust_id').value;
                    var service_id = document.getElementById('chat_service_id').value;
                    OpenChatBox(custID, service_id)
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('chat-msg').value = "";
                    // Show a success toast
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                }
            });
        });
    });

    // GetServicePrice
    function GetServicePrice(cp_id) {
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Service-Price') }}",
            data: {
                cp_id: cp_id
            },

            success: function(data) {
                $("#total_service_price").val(data.data);
                $("#actual_service_price").val(data.data);


                document.getElementById("payment_mode").selectedIndex = 0;
                document.getElementById("total_paid_amount").value = '';
                document.getElementById("total_unpaid_amount").value = '';
                document.getElementById("due_date").value = '';
                document.getElementById("coupon-error").value = '';
            }
        });
    }


    // Apply Coupon Code
    function applyCouponCode(v) {

        const total_price = document.getElementById("actual_service_price").value;
        // console.log(total_price);
        // alert(total_price)
        if (total_price == null || total_price == '') {
            $("#coupon-error").html(`<span class="msg text-red">select category and service</span>`);
            // document.getElementById('coupon-error').style = 'border';
        } else {
            const coupon_code = v;
            $.ajax({
                url: "{{ url('apply-coupon-code') }}",
                data: {
                    total_price: total_price,
                    coupon_code: coupon_code,
                },
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        $("#coupon-error").html(`<span class="msg text-red">${data.error}</span>`);
                    } else {
                        $("#coupon-error").html(
                            '<span class="msg text-success">Coupon Apply Successfully</span>');
                        $("#total_service_price").val(data);
                    }
                    // $("#total_service_price").val(data);
                    // console.log(data);
                }
            });
        }

    }

    // payment mode
    function PaymentMode(v) {
        const TotalPrice = document.getElementById("total_service_price").value;
        if (v == 1) {
            $("#total_paid_amount").val(TotalPrice);
            $("#total_paid_amount").prop("readonly", true);
            document.getElementById("second_emi").style.display = 'none';
            document.getElementById("second_emi_date").style.display = 'none';
            CalculateUnpaidAmount(TotalPrice);
        }
        if (v == 2) {
            document.getElementById("total_paid_amount").value = '';
            $("#total_paid_amount").prop("readonly", false);
            document.getElementById("second_emi").style.display = 'none';
            document.getElementById("second_emi_date").style.display = 'none';
            CalculateUnpaidAmount(TotalPrice);
        }
        if (v == 3) {
            // console.log(v);
            document.getElementById("total_paid_amount").value = '';
            document.getElementById("second_emi").style.display = 'block';
            document.getElementById("second_emi_date").style.display = 'block';
            $("#total_paid_amount").prop("readonly", false);
            CalculateUnpaidAmount(TotalPrice);

        }
    }

    //  calculate unpaid amount
    function CalculateUnpaidAmount(paid_amount) {

        // console.log(paid_amount);
        const TotalPrice = document.getElementById("total_service_price").value;
        const payment_mode = document.getElementById("payment_mode").value;



        if (payment_mode == 1) {
            const total_unpaid_amount = TotalPrice - paid_amount;
            $("#total_unpaid_amount").val(total_unpaid_amount);
        }
        if (payment_mode != 1) {



            if (payment_mode == 2) {

                const total_unpaid_amount = TotalPrice - paid_amount;
                $("#total_unpaid_amount").val(total_unpaid_amount);

                var currentDate = new Date();
                currentDate.setDate(currentDate.getDate() + 15);
                var futureDate = currentDate.toISOString().slice(0, 10);
                $("#due_date").val(futureDate);
            }
            if (payment_mode == 3) {

                const total_unpaid_amount = TotalPrice - paid_amount;
                $("#total_unpaid_amount").val(total_unpaid_amount / 2);
                $("#total_unpaid_amount22").val(total_unpaid_amount / 2);

                var currentDate1 = new Date();
                currentDate1.setDate(currentDate1.getDate() + 15);

                var currentDate2 = new Date();
                currentDate2.setDate(currentDate2.getDate() + 30);

                var futureDate1 = currentDate1.toISOString().slice(0, 10);
                var futureDate2 = currentDate2.toISOString().slice(0, 10);
                $("#due_date").val(futureDate1);
                $("#due_date2").val(futureDate2);
            }

        } else {
            document.getElementById("due_date").value = '';
        }



    }


    // get all services depends on categories
    function GetServices(category_id) {
        $("#serviceSelect").html('');
        $.ajax({
            url: "{{ url('api/fetch-services') }}",
            data: {
                category_id: category_id,
            },
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $('#serviceSelect').html('<option disabled selected>Select Services</option>');
                $.each(result.services, function(key, value) {
                    var badgeText = "";
                    switch (value.cp_type) {
                        case 1:
                            badgeText = '<span class=" badge badge-success">Basic</span>';
                            break;
                        case 2:
                            badgeText =
                                '<span class=" badge badge-secondary">Standard</span>';
                            break;
                        case 3:
                            badgeText = '<span class=" badge badge-warning">Premium</span>';
                            break;
                        case 4:
                            badgeText = '<span class=" badge badge-danger">Diamond</span>';
                            break;
                        default:
                            badgeText = '';
                    }
                    $("#serviceSelect").append('<option value="' + value.cp_id + '">' +
                        value.service_name + ' = ' + badgeText + '</option>');
                    $("#serviceSelect").append(badgeText); // Append badge outside of option
                });
            }
        });
    }

    function GetAllCustomers() {

        const category_id = document.getElementById('filter_category_id').value;
        const package_type = document.getElementById('filter_type').value;

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
                url: "{{ route('om-customer-filter') }}",
                data: {
                    category_id: category_id,
                    package_type: package_type
                },
            },

            columns: [{
                    data: 'mark2',
                    name: 'name',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'contact',
                    name: 'contact',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'category_name',
                    name: 'category_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'service_name',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'cp_type',
                    name: 'cp_type',
                    render: function(data) {

                        switch (data) {
                            case 1:
                                return "<span class='badge bg-success me-1 text-white'>Basic</span>"
                                break;

                            case 2:
                                return "<span class='badge bg-secondary me-1 text-white'>Standard</span>"
                                break;
                            case 3:
                                return "<span class='badge bg-warning me-1 text-white'>Premium</span>"
                                break;
                            case 4:
                                return "<span class='badge bg-danger me-1 text-white'>Diamond</span>"
                                break;
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_total_amount',
                    name: 'total_amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_paid_amount',
                    name: 'emi_paid_amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_unpaid_amount',
                    name: 'emi_unpaid_amount',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_due_date',
                    name: 'emi_due_date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'action',
                    name: 'action',
                    "searchable": false,
                    "orderable": false,
                    "class": 'text-center',
                },



            ]
        });

    }

    $(document).ready(function() {
        $('#addBulkCustomerForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response);


                    if (response.success == true) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('addBulkCustomerForm').reset();
                        toastr.success(response.msg);
                    } else {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('addBulkCustomerForm').reset();
                        toastr.error(response.msg);
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                }
            });
        });
    });

    function calculateUnpaid(v) {
        const totalUnpaid = document.getElementById("total_unpaid_amount2").value;

        const result = totalUnpaid - v;

        $("#final_unpaid_amount").val(result);

        console.log('final unpaid amount =->>' + result);
    }
    
    function DeleteCustomer(customer_id, service_id) {

        $.ajax({
            type: "get",
            url: "{{ route('om-delete-customer') }}",
            data: {
                customer_id: customer_id,
                service_id: service_id,
            },
            success: function(data) {
                $('.data-table').DataTable().ajax.reload(null, false);
                toastr.success('User Deleted!!!');
            },
            error: function(error) {
                // Handle the error response, if needed
                toastr.error(error.responseJSON.message);
            }
        });

    }
</script>
