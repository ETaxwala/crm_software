 <style>
     @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');

     /* Chatbot */
     .botIcon {
         bottom: 15px;
         right: 15px;
         position: fixed;
         z-index: 9999;
     }

     .iconInner {
         -webkit-align-items: center;
         -ms-align-items: center;
         align-items: center;
         background: #ffd000;
         /* background: -webkit-linear-gradient(to left, #00dbde, #fc00ff, #00dbde, #fc00ff);
         background: -o-linear-gradient(to left, #00dbde, #fc00ff, #00dbde, #fc00ff);
         background: -moz-linear-gradient(to left, #00dbde, #fc00ff, #00dbde, #fc00ff);
         background: linear-gradient(to left, #00dbde, #fc00ff, #00dbde, #fc00ff); */
         background-position: 50%;
         background-size: 300%;
         border-radius: 50%;
         color: #fff;
         cursor: pointer;
         display: -webkit-box;
         display: -ms-flexbox;
         display: flex;
         -webkit-flex-wrap: wrap;
         -ms-flex-wrap: wrap;
         flex-wrap: wrap;
         font-size: 1.7em;
         height: 2em;
         justify-content: center;
         width: 2em;
     }

     .botSubject,
     .messages,
     .showBotSubject .botIconContainer,
     .showMessenger .botIconContainer {
         display: none;
     }


     .botIcon .Messages,
     .botIcon .Messages_list {
         -webkit-box-flex: 1;
         -webkit-flex-grow: 1;
         -ms-flex-positive: 1;
         flex-grow: 1;
     }

     .chat_close_icon {
         color: #fff;
         cursor: pointer;
         font-size: 16px;
         position: absolute;
         right: 12px;
         z-index: 9;
     }

     .chat_on {
         background-color: #8a57cf;
         bottom: 20px;
         border-radius: 50%;
         box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
         color: #fff;
         cursor: pointer;
         display: block;
         height: 45px;
         padding: 9px;
         position: fixed;
         right: 15px;
         text-align: center;
         width: 45px;
         z-index: 10;
     }

     .chat_on_icon {
         color: #fff;
         font-size: 25px;
         text-align: center;
     }

     .botIcon .Layout {
         -webkit-animation: appear .15s cubic-bezier(.25, .25, .5, 1.1);
         -ms-animation: appear .15s cubic-bezier(.25, .25, .5, 1.1);
         animation: appear .15s cubic-bezier(.25, .25, .5, 1.1);
         -webkit-animation-fill-mode: forwards;
         -ms-animation-fill-mode: forwards;
         animation-fill-mode: forwards;
         background-color: rgb(63, 81, 181);
         bottom: 20px;
         border-radius: 10px;
         box-shadow: 5px 0 20px 5px rgba(0, 0, 0, .1);
         box-sizing: content-box !important;
         color: rgb(255, 255, 255);
         display: -webkit-box;
         display: -webkit-flex;
         display: -ms-flexbox;
         display: flex;
         -webkit-box-orient: vertical;
         -webkit-box-direction: normal;
         -webkit-flex-direction: column;
         -ms-flex-direction: column;
         flex-direction: column;
         -webkit-box-pack: end;
         -webkit-justify-content: flex-end;
         -ms-flex-pack: end;
         justify-content: flex-end;
         max-height: 30px;
         max-width: 300px;
         min-width: 50px;
         opacity: 0;
         pointer-events: auto;
         -webkit-transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1), min-width .2s cubic-bezier(.25, .25, .5, 1), max-width .2s cubic-bezier(.25, .25, .5, 1), min-height .2s cubic-bezier(.25, .25, .5, 1), max-height .2s cubic-bezier(.25, .25, .5, 1), border-radius 50ms cubic-bezier(.25, .25, .5, 1) .15s, background-color 50ms cubic-bezier(.25, .25, .5, 1) .15s, color 50ms cubic-bezier(.25, .25, .5, 1) .15s;
         -ms-transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1), min-width .2s cubic-bezier(.25, .25, .5, 1), max-width .2s cubic-bezier(.25, .25, .5, 1), min-height .2s cubic-bezier(.25, .25, .5, 1), max-height .2s cubic-bezier(.25, .25, .5, 1), border-radius 50ms cubic-bezier(.25, .25, .5, 1) .15s, background-color 50ms cubic-bezier(.25, .25, .5, 1) .15s, color 50ms cubic-bezier(.25, .25, .5, 1) .15s;
         transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1), min-width .2s cubic-bezier(.25, .25, .5, 1), max-width .2s cubic-bezier(.25, .25, .5, 1), min-height .2s cubic-bezier(.25, .25, .5, 1), max-height .2s cubic-bezier(.25, .25, .5, 1), border-radius 50ms cubic-bezier(.25, .25, .5, 1) .15s, background-color 50ms cubic-bezier(.25, .25, .5, 1) .15s, color 50ms cubic-bezier(.25, .25, .5, 1) .15s;
         z-index: 999999999;
     }

     .botIcon .Layout-open {
         border-radius: 10px;
         color: #fff;
         height: 500px;
         max-height: 500px;
         max-width: 300px;
         overflow: hidden;
         -webkit-transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1.1), min-width .2s cubic-bezier(.25, .25, .5, 1.1), max-width .2s cubic-bezier(.25, .25, .5, 1.1), max-height .2s cubic-bezier(.25, .25, .5, 1.1), min-height .2s cubic-bezier(.25, .25, .5, 1.1), border-radius 0ms cubic-bezier(.25, .25, .5, 1.1), background-color 0ms cubic-bezier(.25, .25, .5, 1.1), color 0ms cubic-bezier(.25, .25, .5, 1.1);
         -ms-transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1.1), min-width .2s cubic-bezier(.25, .25, .5, 1.1), max-width .2s cubic-bezier(.25, .25, .5, 1.1), max-height .2s cubic-bezier(.25, .25, .5, 1.1), min-height .2s cubic-bezier(.25, .25, .5, 1.1), border-radius 0ms cubic-bezier(.25, .25, .5, 1.1), background-color 0ms cubic-bezier(.25, .25, .5, 1.1), color 0ms cubic-bezier(.25, .25, .5, 1.1);
         transition: right .1s cubic-bezier(.25, .25, .5, 1), bottom .1s cubic-bezier(.25, .25, .5, 1.1), min-width .2s cubic-bezier(.25, .25, .5, 1.1), max-width .2s cubic-bezier(.25, .25, .5, 1.1), max-height .2s cubic-bezier(.25, .25, .5, 1.1), min-height .2s cubic-bezier(.25, .25, .5, 1.1), border-radius 0ms cubic-bezier(.25, .25, .5, 1.1), background-color 0ms cubic-bezier(.25, .25, .5, 1.1), color 0ms cubic-bezier(.25, .25, .5, 1.1);
         width: 100%;
     }

     .botIcon .Layout-expand {
         display: none;
         height: 400px;
         max-height: 100vh;
         min-height: 300px;
     }

     .showBotSubject.botIcon .Layout-expand {
         display: block;
     }

     .botIcon .Layout-mobile {
         bottom: 10px
     }

     .botIcon .Layout-mobile.Layout-open {
         min-width: calc(100% - 20px);
         width: calc(100% - 20px);
     }

     .botIcon .Layout-mobile.Layout-expand {
         border-radius: 0 !important;
         bottom: 0;
         height: 100%;
         min-height: 100%;
         min-width: 100%;
         width: 100%;
     }

     .botIcon .Messenger_messenger {
         height: 100%;
         -webkit-box-orient: vertical;
         -webkit-box-direction: normal;
         -webkit-flex-direction: column;
         -ms-flex-direction: column;
         flex-direction: column;
         position: relative;
         width: 100%;
     }

     .botIcon .Messenger_header,
     .botIcon .Messenger_messenger {
         display: -webkit-box;
         display: -webkit-flex;
         display: -ms-flexbox;
         display: flex;
     }

     .botIcon .Messenger_header {
         -webkit-box-align: center;
         -webkit-align-items: center;
         -ms-flex-align: center;
         align-items: center;
         background-color: rgb(22, 46, 98);
         color: rgb(255, 255, 255);
         -webkit-flex-shrink: 0;
         -ms-flex-negative: 0;
         flex-shrink: 0;
         height: 40px;
         padding-left: 10px;
         padding-right: 40px;
     }

     .botIcon .Messenger_header h4 {
         -webkit-animation: slidein .15s .3s;
         -ms-animation: slidein .15s .3s;
         animation: slidein .15s .3s;
         -webkit-animation-fill-mode: forwards;
         -ms-animation-fill-mode: forwards;
         animation-fill-mode: forwards;
         font-size: 16px;
         opacity: 0;
     }

     .botIcon .Messenger_prompt {
         font-size: 16px;
         font-weight: 400;
         line-height: 18px;
         margin: 0;
         overflow: hidden;
         text-overflow: ellipsis;
         white-space: nowrap;
     }

     .botIcon .Messenger_content {
         background-color: #fff;
         display: -webkit-box;
         display: -webkit-flex;
         display: -ms-flexbox;
         display: flex;
         -webkit-box-orient: vertical;
         -webkit-box-direction: normal;
         -webkit-flex-direction: column;
         -ms-flex-direction: column;
         flex-direction: column;
         -webkit-box-flex: 1;
         -webkit-flex-grow: 1;
         -ms-flex-positive: 1;
         flex-grow: 1;
         height: 80px;
     }

     .botIcon .Messages {
         background-color: #fff;
         display: -webkit-box;
         display: -webkit-flex;
         display: -ms-flexbox;
         display: flex;
         -webkit-flex-direction: column;
         -ms-flex-direction: column;
         flex-direction: column;
         -webkit-box-orient: vertical;
         -webkit-box-direction: normal;
         -webkit-flex-shrink: 1;
         -ms-flex-negative: 1;
         flex-shrink: 1;
         overflow-x: hidden;
         overflow-y: auto;
         padding: 10px;
         position: relative;
         -webkit-overflow-scrolling: touch;
     }

     .botIcon .Input {
         background-color: #fff;
         border-top: 1px solid #e6ebea;
         color: #96aab4;
         -webkit-box-flex: 0;
         -webkit-flex-grow: 0;
         -ms-flex-positive: 0;
         flex-grow: 0;
         -webkit-flex-shrink: 0;
         -ms-flex-negative: 0;
         flex-shrink: 0;
         padding-bottom: 15px;
         padding-top: 17px;
         position: relative;
         width: 100%;
     }

     .botIcon .Input-blank .Input_field {
         max-height: 20px;
     }

     .botIcon .Input_field {
         background-color: transparent;
         border: none;
         outline: none;
         padding-left: 20px;
         padding-right: 45px;
         resize: none;
         width: 100%;
         font-size: 14px;
         line-height: 20px;
         min-height: 20px !important;
     }

     .botIcon .Input_button-emoji {
         right: 45px;
     }

     .botIcon .Input_button {
         background-color: transparent;
         border: none;
         bottom: 15px;
         cursor: pointer;
         height: 25px;
         outline: none;
         padding: 0;
         position: absolute;
         width: 25px;
     }

     .botIcon .Input_button-send {
         right: 15px;
     }

     .botIcon .Input-emoji .Input_button-emoji .Icon,
     .botIcon .Input_button:hover .Icon {
         -webkit-transform: scale(1.1);
         -ms-transform: scale(1.1);
         transform: scale(1.1);
         -webkit-transition: all .1s ease-in-out;
         -ms-transition: all .1s ease-in-out;
         transition: all .1s ease-in-out;
     }

     .botIcon .Input-emoji .Input_button-emoji .Icon path,
     .botIcon .Input_button:hover .Icon path {
         fill: #2c2c46;
     }

     .Icon svg {
         height: auto;
         width: 100%;
     }

     .msg {
         display: -webkit-box;
         display: -webkit-flex;
         display: -ms-flexbox;
         display: flex;
     }

     .msg.user {
         -webkit-box-direction: row-reverse;
         -webkit-flex-direction: row-reverse;
         -ms-flex-direction: row-reverse;
         flex-direction: row-reverse;
     }

     .msg+.msg {
         margin-top: 15px;
     }

     span.responsText {
         color: #000;
         display: inline-block;
         margin-left: 10px;
         vertical-align: top;
         max-width: calc(100% - 50px);
     }

     .msg.user span.responsText {
         margin-left: 0;
         margin-right: 10px;
     }

     span.avtr {
         display: inline-block;
         width: 30px;
     }

     span.avtr figure {
         background-color: #ccc;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
         border-radius: 50%;
         display: block;
         margin: 0;
         padding-bottom: 100%;
     }

     @-webkit-keyframes appear {
         0% {
             opacity: 0;
             -webkit-transform: scale(0);
             transform: scale(0);
         }

         100% {
             opacity: 1;
             -webkit-transform: scale(1);
             transform: scale(1);
         }
     }

     @-ms-keyframes appear {
         0% {
             opacity: 0;
             -ms-transform: scale(0);
             transform: scale(0);
         }

         100% {
             opacity: 1;
             -ms-transform: scale(1);
             transform: scale(1);
         }
     }

     @keyframes appear {
         0% {
             opacity: 0;
             -webkit-transform: scale(0);
             transform: scale(0);
         }

         100% {
             opacity: 1;
             -webkit-transform: scale(1);
             transform: scale(1);
         }
     }

     @-webkit-keyframes slidein {
         0% {
             opacity: 0;
             -webkit-transform: translateX(10px);
             transform: translateX(10px);
         }

         100% {
             opacity: 1;
             -webkit-transform: translateX(0);
             transform: translateX(0);
         }
     }

     @-ms-keyframes slidein {
         0% {
             opacity: 0;
             -ms-transform: translateX(10px);
             transform: translateX(10px);
         }

         100% {
             opacity: 1;
             -ms-transform: translateX(0);
             transform: translateX(0);
         }
     }

     @keyframes slidein {
         0% {
             opacity: 0;
             -webkit-transform: translateX(10px);
             transform: translateX(10px);
         }

         100% {
             opacity: 1;
             -webkit-transform: translateX(0);
             transform: translateX(0);
         }
     }

     @media only screen and (max-width: 412px) {
         .botIcon .Layout-open {
             width: 250px;
         }
     }
 </style>



 <!-- Footer Start -->
 <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
     <div class="container py-5">
         <div class="row g-5">
             <div class="col-md-6 col-lg-6 col-xl-4">
                 <div class="footer-item d-flex flex-column">
                     <h4 class="text-secondary mb-4">Contact Info</h4>
                     <a href=""><i class="fa fa-map-marker-alt me-2"></i> 301, Ashoka Residency, In Front Of
                         Hotel
                         Modi Grate, Beside Hotel Shidori Beed Bypass Road, Ch Sambhajinagar, Maharashtra 431001</a>
                     <a href=""><i class="fas fa-envelope me-2"></i> support@etaxwala.com</a>
                     <a href=""><i class="fas fa-phone me-2"></i> +91 7071070707</a>
                     <div class="d-flex align-items-center">
                         <i class="fas fa-share fa-2x text-secondary me-2"></i>
                         <a class="btn mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                         <a class="btn mx-1" href=""><i class="fab fa-twitter"></i></a>
                         <a class="btn mx-1" href=""><i class="fab fa-instagram"></i></a>
                         <a class="btn mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                     </div>
                 </div>
             </div>
             <div class="col-md-6 col-lg-6 col-xl-4">
                 <div class="footer-item d-flex flex-column">
                     <h4 class="text-secondary mb-4">Opening Time</h4>
                     <div class="mb-3">
                         <h6 class="text-muted mb-0">Mon - Saturday:</h6>
                         <p class="text-white mb-0">10.00 am to 07.00 pm</p>
                     </div>
                     <div class="mb-3">
                         <h6 class="text-muted mb-0">Vacation:</h6>
                         <p class="text-white mb-0">All Sunday is our vacation</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-6 col-lg-6 col-xl-4">
                 <div class="footer-item d-flex flex-column">
                     <h4 class="text-secondary mb-4">Our Services</h4>
                     <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Business Registration</a>
                     <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Taxation & Returns</a>
                     <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Audit & Compliances</a>
                     <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Business Consultancy</a>
                     <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Marketing & Branding</a>
                 </div>
             </div>
             {{-- <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-secondary mb-4">Newsletter</h4>
                    <p class="text-white mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="position-relative mx-auto rounded-pill">
                        <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                        <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div> --}}
         </div>
     </div>
 </div>
 <!-- Footer End -->


 <!-- Copyright Start -->
 <div class="container-fluid copyright py-4">
     <div class="container">
         <div class="row g-4 align-items-center">
             <div class="col-md-6 text-center text-md-start mb-md-0">
                 <span class="text-white"><a href="#" class="border-bottom text-white"><i
                             class="fas fa-copyright text-light me-2"></i>ETaxwala Business Solutions Pvt Ltd</a>, All
                     right reserved.</span>
             </div>
             <div class="col-md-6 text-center text-md-end text-white">
                 Designed & Developed By <a class="border-bottom text-white" href="https://brandshastra.in/"
                     target="_blank">Team Brand-Shastra</a>
             </div>
         </div>
     </div>
 </div>
 <!-- Copyright End -->


 <!-- Back to Top -->
 {{-- <a href="#" class="btn btn-primary btn-lg-square chatbot-btn"><i class="fa fa-arrow-down"></i></a> --}}

 {{-- <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a> --}}
 <!-- Chatbot -->
 <div class="botIcon">
     <div class="botIconContainer">
         <div class="iconInner">
             <i class="fa fa-commenting" aria-hidden="true"></i>
         </div>
     </div>
     <div class="Layout Layout-open Layout-expand Layout-right">
         <div class="Messenger_messenger">
             <div class="Messenger_header">
                 <h4 class="Messenger_prompt text-white">How can we help you?</h4> <span class="chat_close_icon"><i
                         class="fa fa-window-close" aria-hidden="true"></i></span>
             </div>
             <div class="Messenger_content">
                 <div class="Messages">
                     <div class="Messages_list"></div>
                 </div>
                 <form id="messenger">
                     <div class="Input Input-blank">
                         <!-- 							<textarea name="msg" class="Input_field" placeholder="Send a message..."></textarea> -->
                         <input name="msg" class="Input_field" placeholder="Send a message...">
                         <button type="submit" class="Input_button Input_button-send">
                             <div class="Icon">
                                 <svg viewBox="1496 193 57 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">
                                     <g id="Group-9-Copy-3" stroke="none" stroke-width="1" fill="none"
                                         fill-rule="evenodd"
                                         transform="translate(1523.000000, 220.000000) rotate(-270.000000) translate(-1523.000000, -220.000000) translate(1499.000000, 193.000000)">
                                         <path
                                             d="M5.42994667,44.5306122 L16.5955554,44.5306122 L21.049938,20.423658 C21.6518463,17.1661523 26.3121212,17.1441362 26.9447801,20.3958097 L31.6405465,44.5306122 L42.5313185,44.5306122 L23.9806326,7.0871633 L5.42994667,44.5306122 Z M22.0420732,48.0757124 C21.779222,49.4982538 20.5386331,50.5306122 19.0920112,50.5306122 L1.59009899,50.5306122 C-1.20169244,50.5306122 -2.87079654,47.7697069 -1.64625638,45.2980459 L20.8461928,-0.101616237 C22.1967178,-2.8275701 25.7710778,-2.81438868 27.1150723,-0.101616237 L49.6075215,45.2980459 C5.08414042,47.7885641 49.1422456,50.5306122 46.3613062,50.5306122 L29.1679835,50.5306122 C27.7320366,50.5306122 26.4974445,49.5130766 26.2232033,48.1035608 L24.0760553,37.0678766 L22.0420732,48.0757124 Z"
                                             id="sendicon" fill="#96AAB4" fill-rule="nonzero"></path>
                                     </g>
                                 </svg>
                             </div>
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- Chatbot -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script>
     jQuery(document).ready(function($) {
         jQuery(document).on('click', '.iconInner', function(e) {
             jQuery(this).parents('.botIcon').addClass('showBotSubject');
             $("[name='msg']").focus();
         });

         jQuery(document).on('click', '.closeBtn, .chat_close_icon', function(e) {
             jQuery(this).parents('.botIcon').removeClass('showBotSubject');
             jQuery(this).parents('.botIcon').removeClass('showMessenger');
         });

         jQuery(document).on('submit', '#botSubject', function(e) {
             e.preventDefault();

             jQuery(this).parents('.botIcon').removeClass('showBotSubject');
             jQuery(this).parents('.botIcon').addClass('showMessenger');
         });

         /* Chatboat Code */
         $(document).on("submit", "#messenger", function(e) {
             e.preventDefault();

             var val = $("[name=msg]").val().toLowerCase();
             var mainval = $("[name=msg]").val();
             name = '';
             nowtime = new Date();
             nowhoue = nowtime.getHours();

             function userMsg(msg) {
                 $('.Messages_list').append(
                     '<div class="msg user"><span class="avtr"><figure style="background-image: url(https://mrseankumar25.github.io/Sandeep-Kumar-Frontend-Developer-UI-Specialist/images/avatar.png)"></figure></span><span class="responsText">' +
                     mainval + '</span></div>');
             };

             function appendMsg(msg) {
                 $('.Messages_list').append(
                     '<div class="msg"><span class="avtr"><figure style="background-image: url(https://mrseankumar25.github.io/Sandeep-Kumar-Frontend-Developer-UI-Specialist/images/avatar.png)"></figure></span><span class="responsText">' +
                     msg + '</span></div>');
                 $("[name='msg']").val("");
             };


             userMsg(mainval);
             if (val.indexOf("hello") > -1 || val.indexOf("hi") > -1 || val.indexOf("good morning") > -
                 1 || val.indexOf("good afternoon") > -1 || val.indexOf("good evening") > -1 || val
                 .indexOf("good night") > -1) {
                 if (nowhoue >= 12 && nowhoue <= 16) {
                     appendMsg('good afternoon');
                 } else if (nowhoue >= 10 && nowhoue <= 12) {
                     appendMsg('hi');
                 } else if (nowhoue >= 0 && nowhoue <= 10) {
                     appendMsg('good morning');
                 } else {
                     appendMsg('good evening');
                 }

                 appendMsg("what's you name?");

             } else if (val.indexOf("i have problem with") > -1) {
                 if (val.indexOf("girlfriend") > -1 || val.indexOf("gf") > -1) {

                     appendMsg("take out your girlfriend, for dinner or movie.");
                     appendMsg("is it helpful? (yes/no)");

                 } else if (val.indexOf("boyfriend") > -1 || val.indexOf("bf") > -1) {
                     appendMsg("bye something for him.");
                     appendMsg("is it helpful? (yes/no)");
                 } else {
                     appendMsg("sorry, i'm not able to get you point, please ask something else.");
                 }
             } else if (val.indexOf("yes") > -1) {

                 var nowtime = new Date();
                 var nowhoue = nowtime.getHours();
                 appendMsg("it's my pleaser that i can help you");

                 saybye();
             } else if (val.indexOf("no") > -1) {

                 var nowtime = new Date();
                 var nowhoue = nowtime.getHours();
                 appendMsg("it's my bad that i can't able to help you. please try letter");

                 saybye();
             } else if (val.indexOf("my name is ") > -1 || val.indexOf("i am ") > -1 || val.indexOf(
                     "i'm ") > -1 || val.split(" ").length < 2) {
                 /*|| mainval != ""*/
                 // var name = "";
                 if (val.indexOf("my name is") > -1) {
                     name = val.replace("my name is", "");
                 } else if (val.indexOf("i am") > -1) {
                     name = val.replace("i am", "");
                 } else if (val.indexOf("i'm") > -1) {
                     name = val.replace("i'm", "");
                 } else {
                     name = mainval;
                 }

                 // appendMsg("hi " + name + ", how can i help you?");
                 appendMsg("hi " + name + ", how can i help you?");
             } else {
                 appendMsg("sorry i'm not able to understand what do you want to say");
             }

             function saybye() {
                 if (nowhoue <= 10) {
                     appendMsg(" have nice day! :)");
                 } else if (nowhoue >= 11 || nowhoue <= 20) {
                     appendMsg(" bye!");
                 } else {
                     appendMsg(" good night!");
                 }
             }

             var lastMsg = $('.Messages_list').find('.msg').last().offset().top;
             $('.Messages').animate({
                 scrollTop: lastMsg
             }, 'slow');
         });
         /* Chatboat Code */
     })
 </script>
