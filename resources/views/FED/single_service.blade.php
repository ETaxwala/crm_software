@include('ui.header')
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

    .client-chatting1 {
        overflow-y: auto;
        height: 400px;
    }

    .custome-header-box {
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .custome-header-box-doc {
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        min-height: 50px;
        text-align: center;
        align-items: center;
        margin-left: 3px;
        margin-right: 3px;

    }
</style>

<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">
            <div class="ms-panel">

                <div class="ms-panel-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card dark ">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($services as $service)
                                            <div class="col-md-12">
                                                <div class="text-section">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title">{{ $service->service_name }}</h5>
                                                        <h5 class="card-title">
                                                            <a href="#" onclick="supportTicketForm()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="28" fill="blue"
                                                                    class="bi bi-ticket-perforated" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M4 4.85v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9z" />
                                                                    <path
                                                                        d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3zM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9z" />
                                                                </svg>
                                                            </a>
                                                            &nbsp;
                                                            <a href="">
                                                                <svg class="pointer" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" fill="red"
                                                                    class="bi bi-file-earmark-arrow-down"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                                                    <path
                                                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                                                </svg>
                                                            </a>
                                                            &nbsp;
                                                            <a href="mailto:support@etaxwala.com">
                                                                <svg class="pointer" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" fill="blue"
                                                                    class="bi bi-envelope" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                                                </svg>
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <hr>

                                                    <?php
                                                    $dataArray = explode(',', $service->description);
                                                    ?>
                                                    @for ($i = 0; $i < count($dataArray); $i += 2)
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="card-text"><span class="check"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            fill="currentColor"
                                                                            class="bi bi-check2-circle"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                                            <path
                                                                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                                        </svg></span>{{ $dataArray[$i] }}</p>
                                                            </div>
                                                            @if ($i + 1 < count($dataArray))
                                                                <div class="col-md-6">
                                                                    <p class="card-text"><span class="check"><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="20" height="20"
                                                                                fill="currentColor"
                                                                                class="bi bi-check2-circle"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                                                <path
                                                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                                            </svg></span>{{ $dataArray[$i + 1] }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endfor
                                                    <hr>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ms-panel ms-panel-fh">
                                                <div class="card-body">
                                                    <div class="box box-primary direct-chat direct-chat-primary">
                                                        <div class="box-header with-border custome-header-box">
                                                            <h3 class="box-title">Direct Chat</h3>

                                                        </div>
                                                        <div class="box-body">
                                                            <div class="direct-chat-messages client-chatting"
                                                                id="client-chatting">

                                                            </div>

                                                        </div>
                                                        <div class="box-footer">


                                                            <form id="sendChatMsg"
                                                                action="{{ route('franchise-customer-chatting') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="service_id"
                                                                    id="chat_cust_id" value="{{ $serviceID }}">
                                                                <input type="hidden" name="customer_id"
                                                                    id="chat_cust_id2" value="{{ $customerID }}">
                                                                <div class="input-group">
                                                                    <input type="text" name="chat_msg" id="chat-msg"
                                                                        placeholder="Type Message ..."
                                                                        class="form-control chat-msg">
                                                                    <button type="submit"
                                                                        class=" btn-square btn-gradient-info">Send</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ms-panel ms-panel-fh">
                                                <div class="card-body">
                                                    <div class="box box-primary direct-chat direct-chat-primary">
                                                        <div class="box-header with-border custome-header-box">
                                                            <h3 class="box-title">Work Timeline</h3>

                                                        </div>
                                                        <div class="box-body">
                                                            <div class="direct-chat-messages client-chatting1"
                                                                id="work-timeline">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col-md-4">
                                            <span>Send Documents</span>
                                        </div>
                                        <div class="col-md-4">
                                            <span>Received Documents</span>
                                        </div>
                                        <div class="col-md-4">
                                            <span>Upload Documents</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <a href="#" onclick="showRequiredDocs()"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="blue" class="bi bi-info-circle"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                        <path
                                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                    </svg></span></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="col-md-4" id="customerSendDocuments">

                                        </div>
                                        <div class="col-md-4" id="customerReceviedDocuments">

                                        </div>
                                        <div class="col-md-4">
                                            <form id="documentUploads"
                                                action="{{ route('upload-franchise-customer-documents') }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="doc_customer_id" id="doc_cust_id"
                                                        value="{{ $customerID }}">
                                                    <input type="hidden" name="doc_service_id" id="doc_service_id"
                                                        value="{{ $serviceID }}">
                                                    <div class="col-md-12">
                                                        <div class="mb-1">
                                                            <input class="form-control" type="text"
                                                                name="docs_name" id="docs_name"
                                                                placeholder="Document Name...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-1">
                                                            <input class="form-control" type="file"
                                                                name="customer_docs" id="customer_docs"
                                                                accept=".pdf, .jpeg, .jpg, .png">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button
                                                            class="form-control btn btn-square btn-gradient-secondary"
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
    </div>

    {{-- support ticket for services --}}
    <div class="modal fade " id="supportTicketForm" tabindex="-1" role="dialog"
        aria-labelledby="supportTicketForm">
        <div class="modal-dialog modal-dialog-centered modal-min" role="document">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h1>Create Your Ticket</h1>
                    <p> Create Your Ticket and get updates </p>
                    <form id="support_ticket_form" method="post"
                        action="{{ route('franchise-customer-support-ticket') }}">
                        @csrf
                        <div class="ms-form-group has-icon">
                            <input type="hidden" name="ticket_service_id" id="ticket_service_id">
                            <input type="hidden" name="ticket_customer_id" id="ticket_customer_id">

                            <textarea class="form-control" name="customer_ticket_query" id="customer_ticket_query" cols="30"
                                rows="5" placeholder="Write your query here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-info shadow-none">Submit Ticket</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- show required documents --}}
    <div class="modal fade " id="showRequiredDocs" tabindex="-1" role="dialog"
        aria-labelledby="showRequiredDocs">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h1>Required Documents</h1>
                    <div class="text-left">
                        @foreach ($docs as $doc)
                            <?php
                            $dataArray = explode(',', $doc->sd_name);
                            ?>
                            @for ($i = 0; $i < count($dataArray); $i += 2)
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text"><span class="check"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check2-circle"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                    <path
                                                        d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                </svg></span>{{ $dataArray[$i] }}</p>
                                    </div>
                                    @if ($i + 1 < count($dataArray))
                                        <div class="col-md-6">
                                            <p class="card-text"><span class="check"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" fill="currentColor"
                                                        class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                        <path
                                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                    </svg></span>{{ $dataArray[$i + 1] }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
    @include('ui.footer')
    <script>
        var service_id = @json($serviceID);
        var customer_id = @json($customerID);

        // console.log(service_id);
        $(function() {

            OpenChatBox(service_id, customer_id)
            GetDocuments(service_id, customer_id)
            GetCustomerWorkTimeline(service_id, customer_id)
        });

        function OpenChatBox(service_id) {
            // const service_id = 27;
            // console.log(service_id);
            $.ajax({
                type: "GET",
                url: "{{ route('Get-Franchise-Emp-Chat-Details') }}",
                data: {
                    service_id: service_id,
                    customer_id: customer_id
                },
                success: function(data) {
                    // console.log('data=> ' + data);
                    var remark = "";
                    $.each(data, function(index, item) {

                        // console.log('data=> ' + item);

                        $.each(data, function(index, item) {

                            // console.log(item.chat_from);git commit -m ""
                            $.each(item, function(index, item1) {
                                console.log(item1);


                                if (item1.chat_to == 0) {

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
                                                <span class="direct-chat-name pull-left">${item1.from_name}</span>
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
            if (typeof OpenChatBox.chatInterval === "undefined") {
                OpenChatBox.chatInterval = setInterval(function() {
                    OpenChatBox(service_id);
                }, 10000);
            }

        }
        setInterval(function() {
            var custID = document.getElementById("chat_cust_id").value;
            var modal = $("#ChatBox");
            if (modal.hasClass('show')) {
                OpenChatBox(custID);
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
                        OpenChatBox(custID)
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('chat-msg').value = '';
                        // Show a success toast
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.message);
                        // Handle the error response, if needed
                    }
                });
            });
        });

        function GetDocuments(service_id) {
            console.log(service_id);
            $.ajax({
                type: "GET",
                url: "{{ route('Get-Franchise-Customer-Documents') }}",
                data: {
                    service_id: service_id,
                    customer_id: customer_id
                },
                success: function(data) {
                    console.log('documents => ' + data);
                    var remark = "";
                    var remark2 = "";
                    $.each(data, function(index, item) {

                        if (item.cd_to !== 0) {
                            var downloadUrl = "{{ url('Docs/') }}" + '/' + item.cd_doc;
                            remark += `
                                <a download="${item.cd_doc}" href="${downloadUrl}">
                                    ${item.cd_name} <span class="text-dark">|</span> &nbsp;
                                </a>`;
                        } else {
                            var downloadUrl2 = "{{ url('Docs/') }}" + '/' + item.cd_doc;
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

        // upload documents
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
                        // var service_id = document.getElementById('doc_service_id').value;
                        GetDocuments(service_id)
                        // $("#LeadDetails").modal('hide')
                        document.getElementById('docs_name').value = '';
                        document.getElementById('customer_docs').value = '';
                        // Show a success toast
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.message);
                        // Handle the error response, if needed
                    }
                });
            });
        });

        function GetCustomerWorkTimeline(service_id) {
            // console.log(service_id);
            $.ajax({
                type: "GET",
                url: "{{ route('Get-Franchise-Customer-Work-Timeline') }}",
                data: {
                    service_id: service_id,
                    customer_id: customer_id
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
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <span class="timeline-title">${workStatus}</span>
                                            <p id="" class="work-effort">${item1.work}</p>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-info">By : ${item1.username}</span>
                                                <span class="text-info">Date : ${item1.date}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            `;




                        });
                    });
                    $('#work-timeline').html(remark);
                }
            });


        }

        // support ticket form
        function supportTicketForm() {

            $("#ticket_service_id").val(service_id);
            $("#ticket_customer_id").val(customer_id);
            $("#supportTicketForm").modal('show');
        }

        // add support ticket
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
                        document.getElementById('customer_ticket_query').value = '';
                        toastr.success(response.msg);
                    },
                    error: function(response) {
                        toastr.error('Something wrong');
                    }
                });
            });
        });

        function showRequiredDocs() {

            $("#showRequiredDocs").modal('show');
        }
    </script>
