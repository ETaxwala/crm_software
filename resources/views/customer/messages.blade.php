@include('ui.header')
<style>
    .client-list {
        height: 72vh
    }

    .client-chat {
        height: 72vh
    }

    .scrollable-list {
        padding: 10px;
        overflow-y: auto;
        /* height: 100vh; */
        /* border: 1px solid #ccc; */
    }

    .client-chat-box {
        padding: 10px;
        overflow-y: auto;
        /* height: 60vh; */



    }

    .main-chat-box {
        /* border: 1px solid #ccc; */

    }

    .pointer {
        cursor: pointer;

    }

    .client-chatting {
        overflow-y: auto;
        height: 300px;
    }

    .ms-panel-footer {
        position: sticky;
    }

    #client-header,
    #msg-form {
        display: none;
    }

    .image-upload>input {
        display: none;
    }

    .image-upload img {
        width: 80px;
        cursor: pointer;
    }



    .uploadFile {
        background-color: white;
        color: grey;
        font-size: 16px;
        line-height: 23px;
        overflow: hidden;
        padding: 10px 10px 4px 10px;
        position: relative;
        resize: none;

        [type="file"] {
            cursor: pointer !important;
            display: block;
            font-size: 999px;
            filter: alpha(opacity=0);
            min-height: 100%;
            min-width: 100%;
            opacity: 0;
            position: absolute;
            right: 0px;
            text-align: right;
            top: 0px;
            z-index: 1;
        }
    }
</style>

<div class="ms-content-wrapper">
    <div class="row main-chat-box">

        <div class="col-md-4 ">
            <div class="crollable-list">
                <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                    <div class="ms-panel-header">
                        <div class="ms-chat-header justify-content-between">
                            <h6>Client List</h6>
                        </div>
                    </div>
                    <div class="ms-panel-body ms-scrollable ps ps--active-y">

                        @foreach ($employees as $employee)
                            <div onclick="GetChatMsg({{ $employee->id }}, '{{ $employee->username }}')"
                                class="pointer ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
                                <div class="  ms-chat-img">
                                    <img src="{{ url('assets/img/main_logo.png') }}" class="ms-img-round" alt="people">
                                </div>
                                <div class="media-body">
                                    <h6>{{ $employee->username }}</h6>
                                </div>

                            </div>
                            <br>
                        @endforeach
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 633px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 628px;"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-8">
            <div class="">
                <div class="ms-panel ms-panel-fh ms-widget ms-chat-conversations">
                    <div class="ms-panel-header">
                        <div class="ms-chat-header justify-content-between">
                            <div id="client-header" class="ms-chat-user-container media clearfix">
                                <div class="ms-chat-status ms-status-online ms-chat-img mr-3 align-self-center">
                                    <img src="{{ url('assets/img/main_logo.png') }}" class="ms-img-round" alt="people">
                                </div>
                                <div class="media-body ms-chat-user-info mt-1">
                                    <h6 id="client-name"></h6>
                                    <span class="text-disabled fs-12">
                                        Active Now
                                    </span>
                                </div>
                            </div>
                            {{-- <ul class="ms-list ms-list-flex ms-chat-controls">
                                <li data-toggle="tooltip" data-placement="top" title="Call"> <i
                                        class="material-icons">local_phone</i> </li>
                                <li data-toggle="tooltip" data-placement="top" title="Video Call"> <i
                                        class="material-icons">videocam</i> </li>
                                <li data-toggle="tooltip" data-placement="top" title="Add to Chat"> <i
                                        class="material-icons">person_add</i> </li>
                            </ul> --}}
                        </div>
                    </div>
                    <div class="ms-panel-body  ps ps--active-y ">
                        <div id="client-chatting" class="client-chatting">

                        </div>

                        <div id="msg-form" class="ms-panel-footer">
                            <div class="ms-chat-textbox">
                                <ul class="ms-list-flex mb-0">
                                    <li class="ms-chat-vn"><i class="material-icons">mic</i> </li>
                                    <li class="ms-chat-input">
                                        <form id="sendChatMsg" action="{{ route('customer-chatting-from-operation') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="cust_id" id="chat_cust_id" value="">
                                            <input type="text" name="chat_msg" placeholder="Enter Message"
                                                value="">

                                        </form>

                                    </li>
                                    <li class="ms-chat-text-controls ms-list-flex">
                                        <form id="sendDocs" action="{{ route('customer-chatting-from-operation2') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="cust_id2" id="chat_cust_id2" value="">
                                                <label class="uploadFile">
                                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                                    <span class="filename"></span>

                                                    <input type="file" class="inputfile form-control"
                                                        name="chat_file"
                                                        accept=".txt, .pdf, .doc, .docx, .xls, .xlsx, image/*" required>

                                                </label>
                                                <button type="submit" class="pointer btn-success"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                                    </svg></button>
                                            </div>

                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 633px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 628px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


@include('ui.footer')
<script>
    $("input[type=file]").change(function(e) {
        $(this).parents(".uploadFile").find(".filename").text(e.target.files[0].name);
    });

    function GetChatMsg(cust_id, cust_name) {
        // console.log(cust_id);
        $("#client-name").html(cust_name);
        $("#chat_cust_id").val(cust_id);
        $("#chat_cust_id2").val(cust_id);

        document.getElementById("client-header").style.display = 'flex';
        document.getElementById("msg-form").style.display = 'inline';
        $.ajax({
            type: "GET",
            url: "{{ route('Get-Customer-Chat-Details') }}",
            data: {
                cust_id: cust_id
            },
            success: function(data) {
                var remark = "";
                $.each(data, function(index, item) {

                    // console.log(item.chat_from);
                    $.each(data, function(index, item) {

                        // console.log(item.chat_from);
                        $.each(item, function(index, item1) {
                            // console.log(item1);


                            if (item1.chat_from != cust_id) {
                                if (item1.chat_msg == null) {
                                    remark += `
                                        <div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
                                            <div class="ms-chat-status ms-status-online ms-chat-img">
                                                <img src="{{ url('assets/img/client.png') }}" class="ms-img-round" alt="people">
                                            </div>
                                            <div class="media-body">
                                                <div class="ms-chat-text">
                                                    <p>
                                                        <a class="text-white" href="/file-download/${item1.chat_id}" download="${item1.chat_file}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                        </svg> ${item1.chat_file_name}</a>
                                                        </p>

                                                </div>
                                                <p class="ms-chat-time">${item1.date}</p>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    remark += `
                                        <div class="ms-chat-bubble ms-chat-message ms-chat-outgoing media clearfix">
                                            <div class="ms-chat-status ms-status-online ms-chat-img">
                                                <img src="{{ url('assets/img/client.png') }}" class="ms-img-round" alt="people">
                                            </div>
                                            <div class="media-body">
                                                <div class="ms-chat-text">
                                                    <p> ${item1.chat_msg}</p>
                                                </div>
                                                <p class="ms-chat-time">${item1.date}</p>
                                            </div>
                                        </div>
                                    `;
                                }
                            } else {
                                if (item1.chat_msg == null) {
                                    remark += `
                                    <div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
                                    <div class="ms-chat-status ms-status-online ms-chat-img">
                                        <img
                                        src="{{ url('assets/img/main_logo.png') }}"
                                        class="ms-img-round"
                                        alt="people"
                                        />
                                    </div>
                                    <div class="media-body">
                                        <div class="ms-chat-text">
                                            <p>
                                                <a class="text-dark" href="/file-download/${item1.chat_id}" download="${item1.chat_file}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                </svg> ${item1.chat_file_name}</a>
                                                </p>
                                        </div>
                                        <p class="ms-chat-time">${item1.date}</p>
                                    </div>
                                    </div>
                                    `;

                                } else {
                                    remark += `
                                    <div class="ms-chat-bubble ms-chat-message ms-chat-incoming media clearfix">
                                    <div class="ms-chat-status ms-status-online ms-chat-img">
                                        <img
                                        src="{{ url('assets/img/main_logo.png') }}"
                                        class="ms-img-round"
                                        alt="people"
                                        />
                                    </div>
                                    <div class="media-body">
                                        <div class="ms-chat-text">
                                        <p>${item1.chat_msg}</p>
                                        </div>
                                        <p class="ms-chat-time">${item1.date}</p>
                                    </div>
                                    </div>
                                    `;

                                }
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
        if (custID.length != 0) {
            GetChatMsg(custID);
            scrollToBottom();
        }
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
                    GetChatMsg(custID)
                    // $("#LeadDetails").modal('hide')
                    document.getElementById('sendChatMsg').reset();
                    // Show a success toast
                },
                error: function(error) {
                    // console.log(error.responseJSON.message);
                    // Handle the error response, if needed
                }
            });
        });
    });
</script>
