@include('ui.header')
<style>
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
    .vertical-timeline-element-content .vertical-timeline-element-time {
        display: block;
        position: absolute;
        left: -90px;
        top: 20px;
        padding-right: 10px;
        text-align: right;
        color: #adb5bd;
        font-size: .7619rem;
        white-space: nowrap;
    }
    .vertical-timeline-element-content .vertical-timeline-element-effort {
        display: block;
        position: absolute;
        left: -90px;
        top: 40px;
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

    .border-none {
        border-left: none !important;
        border-right: none !important;
        border-top: none !important;
        border-bottom: 1px solid gray;
    }

    .vertical-line {
        position: relative;
        width: 2px;
        /* Adjust the width of the line as needed */
        height: 220px;
        background-color: gray !important;
        /* Adjust the color of the line as needed */
        margin: 0 10px;
        /* Adjust the margin to position the line as needed */
    }











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
<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Task List</h6>
    
                    <h6>
                        <select class="form-control" id="filter_task_status" onchange="GetAllTasks(this.value)">
                            <option value="0">All</option>
                            <option value="1">Not Started</option>
                            <option value="2">WIP</option>
                            <option value="3">Pending From Client</option>
                            <option value="4">Invoiced</option>
                            <option value="5">Completed</option>
                            <option value="6">Return Back</option>
                            <option value="7">Cancle</option>
                            <option value="8">Payment Pending</option>
                        </select>
                    </h6>
                </div>

                <div class="ms-panel-body">

                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Assign Date</th>
                                    <th>Name</th>
                                    <th>Task</th>
                                    <th>Mobile</th>
                                    <th>service</th>
                                    <th>Status</th>
                                    <th>Due Date</th>

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
{{-- meassage --}}
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
                                    <form id="addNewEffort" class="" action="{{ route('add-cust-work-effort-emp') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="cust_id" id="work_cust_id" value="">
                                        <input type="hidden" name="task_id" id="work_task_id" value="">
                                        <input type="hidden" name="work_service_id" id="work_service_id" value="">
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
                                            <input class="form-control" type="text" name="work_hour" id="" placeholder="Hour">
                                            <input class="form-control" type="text" name="work_minute" id="" placeholder="Minute">
                                        </div>
                                        <br>
                                        <div class="">
                                            <textarea class="form-control" name="work" id="work-effort" cols="30" rows="3"
                                                placeholder="Add Efforts..."></textarea>
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

<div class="modal fade" id="workTimeline" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="workTimelineLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(164, 0, 50);">
                <h5 class="modal-title text-white" id="workTimelineLabel">Work Timeline</h5>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">

                    <div class="col-md-12">

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

        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-sm" id="ChatBox" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="col-md-12">
                <br>
                <!-- DIRECT CHAT PRIMARY -->
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Direct Chat</h3>

                    </div>
                    <div class="box-body">
                        <div class="direct-chat-messages client-chatting" id="client-chatting">




                        </div>

                    </div>
                    <div class="box-footer">


                        <form id="sendChatMsg" action="{{ route('customer-chatting-from-operation') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="cust_id" id="chat_cust_id" value="">
                            <input type="hidden" name="service_id" id="chat_service_id" value="">
                            <div class="input-group">
                                <input type="text" name="chat_msg" id="chat-msg" placeholder="Type Message ..."
                                    class="form-control">
                                <button type="submit" class=" btn-square btn-gradient-info"><i
                                        class="flaticon-tick-inside-circle"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!--/.direct-chat -->
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
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('operation-emp-manage-task') }}",

            columns: [

                {
                    data: 'assign_date',
                    name: 'assign_date',
                    "searchable": true,
                    "orderable": false,
                }, {
                    data: 'mark',
                    name: 'mark',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark2',
                    name: 'mark2',
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
                    data: 'service_name',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'actual_task_status',
                    name: 'actual_task_status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.notstarted') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>notstarted</span>"
                        }
                        if (data == Number(
                                "{{ config('global.wip') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>WIP</span>"
                        }
                        if (data == Number(
                                "{{ config('global.pendingfromclient') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>pendingfromclient</span>"
                        }
                        if (data == Number(
                                "{{ config('global.invoiced') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>invoiced</span>"
                        }
                        if (data == Number(
                                "{{ config('global.completed') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>completed</span>"
                        }
                        if (data == Number(
                                "{{ config('global.returnback') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>returnback</span>"
                        }
                        if (data == Number(
                                "{{ config('global.cancel') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>cancel</span>"
                        }
                        if (data == Number(
                                "{{ config('global.paymentpending') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>paymentpending</span>"
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'due_date',
                    name: 'due_date',
                    "searchable": true,
                    "orderable": false,
                },



            ]

        });


    });

    function GetAllTasks(v) {
        var task_status = v;

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
                url: "{{ route('operation-employee-task-filter') }}",
                data: {
                    task_status: task_status,
                },
            },

            columns: [

                {
                    data: 'assign_date',
                    name: 'assign_date',
                    "searchable": true,
                    "orderable": false,
                }, {
                    data: 'mark',
                    name: 'mark',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'mark2',
                    name: 'mark2',
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
                    data: 'service_name',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'actual_task_status',
                    name: 'actual_task_status',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.notstarted') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>notstarted</span>"
                        }
                        if (data == Number(
                                "{{ config('global.wip') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>WIP</span>"
                        }
                        if (data == Number(
                                "{{ config('global.pendingfromclient') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>pendingfromclient</span>"
                        }
                        if (data == Number(
                                "{{ config('global.invoiced') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>invoiced</span>"
                        }
                        if (data == Number(
                                "{{ config('global.completed') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>completed</span>"
                        }
                        if (data == Number(
                                "{{ config('global.returnback') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>returnback</span>"
                        }
                        if (data == Number(
                                "{{ config('global.cancel') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>cancel</span>"
                        }
                        if (data == Number(
                                "{{ config('global.paymentpending') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>paymentpending</span>"
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'due_date',
                    name: 'due_date',
                    "searchable": true,
                    "orderable": false,
                },



            ]
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


    // get user details
    function WorkTimeline(cust_id) {
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
                        // console.log(item1);
                        let statusClass;
                        let workStatus;

                        switch (item1.status) {

                            case 1:
                                statusClass = 'badge-danger';
                                workStatus =
                                    '<span class="badge badge-danger">Not Started</span>';
                                break;
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
                            case 8:
                                statusClass = 'badge-info';
                                workStatus =
                                    '<span class="badge badge-info">Payment Pending</span>';
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
                                            <p id="work_timeline_work" class="work-effort">${item1.work} <br> <span class="text-info">${item1.username}</span></p>

                                            <span class="vertical-timeline-element-date">${item1.date}</span>
                                            <span class="vertical-timeline-element-time">${item1.time}</span>
                                            <span class="vertical-timeline-element-effort">Hour : ${item1.work_hour} <br> Minute : ${item1.work_minute}</span>
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

    // add work effort
    function AddWorkEffort(cust_id, task_id) {
        $("#work_cust_id").val(cust_id);
        $("#work_task_id").val(task_id);
        $("#AddWorkEffort").modal('show')
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

    // Get-Customer-Chat-Details
    function OpenChatBox(cust_id, service_id) {

        // console.log(cust_id);
        $("#chat_cust_id").val(cust_id);
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Chat-Details') }}",
            data: {
                cust_id: cust_id,
                service_id: service_id
            },
            success: function(data) {
                var remark = "";
                $.each(data, function(index, item) {

                    // console.log(item.chat_from);
                    $.each(data, function(index, item) {

                        // console.log(item.chat_from);
                        $.each(item, function(index, item1) {
                            console.log(item1);


                            if (item1.chat_to !==0) {

                                remark += `
                                    <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Send</span>
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
                                    <span class="direct-chat-name pull-left">Received</span>
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
                $("#ChatBox").modal('show');
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

    // $(document).mouseup(function (e) {
    //     var modal = $("#ChatBox");
    //     if (modal.hasClass('show') && !modal.is(e.target) && modal.has(e.target).length === 0) {
    //         modal.modal('hide');
    //     }
    // });
</script>
