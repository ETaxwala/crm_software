<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link href="{{ url('assets/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ url('assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Costic styles -->
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
</head>
{{-- <style>
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        outline: none;
    }

    a,
    a:active,
    a:focus {
        color: #333;
        text-decoration: none;
        transition-timing-function: ease-in-out;
        -ms-transition-timing-function: ease-in-out;
        -moz-transition-timing-function: ease-in-out;
        -webkit-transition-timing-function: ease-in-out;
        -o-transition-timing-function: ease-in-out;
        transition-duration: .2s;
        -ms-transition-duration: .2s;
        -moz-transition-duration: .2s;
        -webkit-transition-duration: .2s;
        -o-transition-duration: .2s;
    }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    /*--blog----*/

    .sec-title {
        position: relative;
        margin-bottom: 70px;
    }

    .sec-title .title {
        position: relative;
        display: block;
        font-size: 16px;
        line-height: 1em;
        color: #ff8a01;
        font-weight: 500;
        background: rgb(247, 0, 104);
        background: -moz-linear-gradient(to left, rgba(247, 0, 104, 1) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
        background: -webkit-linear-gradient(to left, rgba(247, 0, 104, 1) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
        background: linear-gradient(to left, rgba(247, 0, 104) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F70068', endColorstr='#441066', GradientType=1);
        color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-transform: uppercase;
        letter-spacing: 5px;
        margin-bottom: 15px;
    }

    .sec-title h2 {
        position: relative;
        display: inline-block;
        font-size: 48px;
        line-height: 1.2em;
        color: #1e1f36;
        font-weight: 700;
    }

    .sec-title .text {
        position: relative;
        font-size: 16px;
        line-height: 28px;
        color: #888888;
        margin-top: 30px;
    }

    .sec-title.light h2,
    .sec-title.light .title {
        color: #ffffff;
        -webkit-text-fill-color: inherit;
    }

    .pricing-section {
        position: relative;
        padding: 100px 0 80px;
        overflow: hidden;
    }

    .pricing-section .outer-box {
        max-width: 1100px;
        margin: 0 auto;
    }


    .pricing-section .row {
        margin: 0 -30px;
    }

    .pricing-block {
        position: relative;
        padding: 0 30px;
        margin-bottom: 40px;
    }

    .pricing-block .inner-box {
        position: relative;
        background-color: #ffffff;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        padding: 0 0 30px;
        max-width: 370px;
        margin: 0 auto;
        border-bottom: 20px solid #40cbb4;
    }

    .pricing-block .icon-box {
        position: relative;
        padding: 50px 30px 0;
        background-color: #40cbb4;
        text-align: center;
    }

    .pricing-block .icon-box:before {
        position: absolute;
        left: 0;
        bottom: 0;
        height: 75px;
        width: 100%;
        border-radius: 50% 50% 0 0;
        background-color: #ffffff;
        content: "";
    }


    .pricing-block .icon-box .icon-outer {
        position: relative;
        height: 150px;
        width: 150px;
        background-color: #ffffff;
        border-radius: 50%;
        margin: 0 auto;
        padding: 10px;
    }

    .pricing-block .icon-box i {
        position: relative;
        display: block;
        height: 130px;
        width: 130px;
        line-height: 120px;
        border: 5px solid #40cbb4;
        border-radius: 50%;
        font-size: 50px;
        color: #40cbb4;
        -webkit-transition: all 600ms ease;
        -ms-transition: all 600ms ease;
        -o-transition: all 600ms ease;
        -moz-transition: all 600ms ease;
        transition: all 600ms ease;
    }

    .pricing-block .inner-box:hover .icon-box i {
        transform: rotate(360deg);
    }

    .pricing-block .price-box {
        position: relative;
        text-align: center;
        padding: 10px 20px;
    }

    .pricing-block .title {
        position: relative;
        display: block;
        font-size: 24px;
        line-height: 1.2em;
        color: #222222;
        font-weight: 600;
    }

    .pricing-block .price {
        display: block;
        font-size: 30px;
        color: #222222;
        font-weight: 700;
        color: #40cbb4;
    }


    .pricing-block .features {
        position: relative;
        max-width: 200px;
        margin: 0 auto 20px;
    }

    .pricing-block .features li {
        position: relative;
        display: block;
        font-size: 14px;
        line-height: 30px;
        color: #848484;
        font-weight: 500;
        padding: 5px 0;
        padding-left: 30px;
        border-bottom: 1px dashed #dddddd;
    }

    .pricing-block .features li:before {
        position: absolute;
        left: 0;
        top: 50%;
        font-size: 16px;
        color: #2bd40f;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        content: "\f058";
        font-family: "Font Awesome 5 Free";
        margin-top: -8px;
    }

    .pricing-block .features li.false:before {
        color: #e1137b;
        content: "\f057";
    }

    .pricing-block .features li a {
        color: #848484;
    }

    .pricing-block .features li:last-child {
        border-bottom: 0;
    }

    .pricing-block .btn-box {
        position: relative;
        text-align: center;
    }

    .pricing-block .btn-box a {
        position: relative;
        display: inline-block;
        font-size: 14px;
        line-height: 25px;
        color: #ffffff;
        font-weight: 500;
        padding: 8px 30px;
        background-color: #40cbb4;
        border-radius: 10px;
        border-top: 2px solid transparent;
        border-bottom: 2px solid transparent;
        -webkit-transition: all 400ms ease;
        -moz-transition: all 400ms ease;
        -ms-transition: all 400ms ease;
        -o-transition: all 400ms ease;
        transition: all 300ms ease;
    }

    .pricing-block .btn-box a:hover {
        color: #ffffff;
    }

    .pricing-block .inner-box:hover .btn-box a {
        color: #40cbb4;
        background: none;
        border-radius: 0px;
        border-color: #40cbb4;
    }

    .pricing-block:nth-child(2) .icon-box i,
    .pricing-block:nth-child(2) .inner-box {
        border-color: #1d95d2;
    }

    .pricing-block:nth-child(2) .btn-box a,
    .pricing-block:nth-child(2) .icon-box {
        background-color: #1d95d2;
    }

    .pricing-block:nth-child(2) .inner-box:hover .btn-box a {
        color: #1d95d2;
        background: none;
        border-radius: 0px;
        border-color: #1d95d2;
    }

    .pricing-block:nth-child(2) .icon-box i,
    .pricing-block:nth-child(2) .price {
        color: #1d95d2;
    }

    .pricing-block:nth-child(3) .icon-box i,
    .pricing-block:nth-child(3) .inner-box {
        border-color: #ffc20b;
    }

    .pricing-block:nth-child(3) .btn-box a,
    .pricing-block:nth-child(3) .icon-box {
        background-color: #ffc20b;
    }

    .pricing-block:nth-child(3) .icon-box i,
    .pricing-block:nth-child(3) .price {
        color: #ffc20b;
    }

    .pricing-block:nth-child(3) .inner-box:hover .btn-box a {
        color: #ffc20b;
        background: none;
        border-radius: 0px;
        border-color: #ffc20b;
    }
</style> --}}

<style>
    body {
        padding: 0;
        margin: 0;
        background: #1E1E21;
        color: #fff;
    }

    h2 {
        font-size: 30px;
        color: #fff;
    }

    p {
        color: rgb(238, 231, 231);
    }

    .has-tooltip:not(.tooltip-disabled) {
        cursor: help;
        position: relative;
    }

    .has-tooltip:not(.tooltip-disabled):hover .tooltip-container {
        display: block;
    }

    .has-tooltip .tooltip-container {
        display: none;
        position: absolute;
        background-color: #BE3760;
        color: #fff;
        z-index: 20;
        bottom: calc(100% + 13px);
        left: -10px;
        right: -10px;
        padding: 16px 20px;
        border-radius: 8px;

    }

    .has-tooltip .tooltip-container:after {
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #BE3760;
        font-size: 0;
        line-height: 0;
        content: "";
        position: absolute;
        bottom: -10px;
    }

    .has-tooltip .tooltip-container h6 {
        font-weight: 600;
        font-size: 16px;
        margin: 0px;
    }

    .has-tooltip .tooltip-container {
        color: #555;
        margin-top: 4px;
    }

    /* - - - - - - - End Tooltips - - - */





    #pricing-container * {
        box-sizing: border-box;
    }

    #pricing-container {
        font-family: "Open Sans", Helvetica, Arial, Lucida, sans-serif;
        -webkit-font-smoothing: antialiased;
        max-width: 1080px;
        margin: 0 auto 50px;
        justify-content: center;
        line-height: 1;
        color: #000;
    }



    /* Cards */

    #pricing-cards {
        display: flex;
        font-size: 14px;
    }

    #pricing-container .price-card {
        background-color: #33333a;
        color: #fff;
        font-family: "Open Sans", Helvetica, Arial, Lucida, sans-serif;
        display: block;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
        transition: all 0.25s;
        position: relative;
        margin: 0 6px;
        flex-grow: 1;
        flex-shrink: 1;
    }

    #pricing-container .price-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.14),
            0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
    }


    /* - - - - - - - - - Header Section - - - */

    #pricing-container .price-card--header {

        margin: 0;
        padding: 20px 0;
        text-align: center;
    }

    #pricing-container .price-card--header h4 {
        margin: 0;
        padding: 0;
        font-size: 28px;
        color: #fff;
        font-family: "Raleway", Helvetica, Arial, Lucida, sans-serif;
        font-weight: 700;
    }


    /* - - - - - - - - - Price Section - - - */

    #pricing-container .price-card--price {
        text-align: center;
        padding: 28px 0 6px 0;
    }

    #pricing-container .price-card--price-text {
        font-size: 48px;
    }

    #pricing-container .price-card--price-number {
        font-weight: 500;
        opacity: 0.89;
    }

    .odometer div {
        display: inline-block;
    }

    #pricing-container .price-card--price-number:before {
        content: "$";
        font-size: 24px;
        top: -16px;
        display: inline-block;
        position: relative;
    }

    #pricing-container .price-card--price-number:after {
        content: "/month";
        font-size: 12px;
        display: inline-block;
        color: grey;
    }

    #pricing-container .price-card--price-conditions {
        padding: 14px 0;
        color: #888;
        line-height: 1.5;
    }




    /* - - - - - - - - - CTA Button Section - - - */

    #pricing-container .price-card--cta {
        padding: 0 20px 24px;
        text-align: center;
    }

    #pricing-container .price-card--cta--button.btn {
        min-width: 20px;
        display: block;
        max-width: 183px;
        margin: 0 auto;
    }





    /* - - - - - - - - - Features Section - - - */

    #pricing-container .price-card--features {

        padding: 16px 0 20px;
    }

    #pricing-container ul.price-card--features--list {
        padding: 0 32px;
        list-style: none;
        margin: 0;
    }

    #pricing-container li.price-card--features--item {
        margin: 8px 0;
        padding-left: 8px;
        line-height: 1.5;
        position: relative;
    }

    #pricing-container li.price-card--features--item:not(.features-disabled):before {
        content: "✓";
        color: #BE3760;
        display: block;
        position: absolute;
        left: -8px;
    }

    #pricing-container li.price-card--features--item.features-highlight {
        /* 	font-weight: 600; */
    }

    #pricing-container li.price-card--features--item.features-disabled {
        opacity: 0.1;
        /* 	text-decoration: line-through; */
    }




    /* - - - - - - - - - Mobile Features Toggle - - - */

    #pricing-container .price-card--mobile-features-toggle {
        text-align: center;
        margin: 24px 0 0;
        padding: 16px 0;
        cursor: pointer;
        display: none;
        color: green;
    }

    #pricing-container .price-card--mobile-features-toggle:after {
        content: "Show All Features ▾";
    }

    #pricing-container .price-card--mobile-features-toggle.hideall:after {
        content: "Hide Features ▴";
    }

    /* - - - - - - - - - Hero Card Styles - - - */

    #pricing-container .price-card--hero {
        margin: -38px 6px 0;
        /* 	width:31%; */
        z-index: 10;
    }

    #pricing-container .price-card--hero-text {
        background-color: #BE3760;
        height: 38px;
        color: white;
        line-height: 38px;
        text-align: center;
        font-weight: 600;
    }

    /* - - - - - - - - - Only Yearly Basic Styles - - - */

    #pricing-container .only-yearly {
        position: relative;
    }

    #pricing-container .only-yearly .price-card--price-number {
        transition: opacity 0.2s;
    }

    #pricing-container .only-yearly .only-yearly--text {
        position: absolute;
        top: -0.2em;
        left: 0;
        right: 0;
        display: none;
    }

    #pricing-container .only-yearly .only-yearly--text span {
        font-size: 14px;
    }

    #pricing-container .only-yearly.if-monthly .price-card--price-number {
        opacity: 0;
    }

    #pricing-container .only-yearly.if-monthly .only-yearly--text {
        display: block;
    }

    /* - - - - - - - - - Switch Section - - - */

    #pricing-switch {
        margin: 80px auto 100px;
        text-align: center;
        line-height: 1.4;
        position: relative;
        max-width: 1080px;
    }

    #pricing-switch .switch-label {
        display: inline-block;
        width: 200px;
        text-align: center;
        opacity: 0.4;
        font-size: 16px;
        cursor: pointer;
        padding: 0 20px;
    }

    #pricing-switch .switch-label .save-money {
        color: #4caf50;
        font-style: italic;
        padding-left: 8px;
    }

    #pricing-switch .save-money--mobile {
        color: #4caf50;
        font-style: italic;
        padding-top: 22px;
        display: none;
    }

    #pricing-switch .switch-label.active {
        font-size: 18px;
        opacity: 1;
    }

    #pricing-switch .switch-label-monthly {
        text-align: right;
    }

    #pricing-switch .switch-label-yearly {
        text-align: left;
    }

    #pricing-switch .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        vertical-align: -50%;
        margin: 0;
    }

    #pricing-switch .switch input {
        display: none;
    }

    #pricing-switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #BE3760;
        border-radius: 34px;
        -webkit-transition: 0.1s;
        transition: 0.1s;
    }

    #pricing-switch .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        border-radius: 50%;
        -webkit-transition: 0.1s;
        transition: 0.1s;
    }

    .btn {
        width: 200px;
        height: 45px;
        background: transparent;
        border: 1px solid #BE3760;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        margin: 2em 5em;
    }

    .btn-pro {
        width: 200px;
        height: 45px;
        background: #BE3760;
        border: none;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        margin: 2em 5em;
    }

    .switch-label {
        color: #fff;
    }

    .active {
        color: #BE3760;
    }

    strong {
        color: #fff;
    }
</style>


<body>


    <section id="pricing-container">
        <br><br><br><br>

        <div id="pricing-cards">

            <!-- ============================= -->
            <!-- = Premium Subscription Card = -->
            <!-- ============================= -->
            <div class="price-card">

                <div class="price-card--header">
                    <h4>Premium</h4>
                    <!-- <p>for growing your business</p> -->
                </div>

                <div class="price-card--price">
                    <div class="price-card--price-text">
                        <div class="price-card--price-number toggle-price-content odometer" data-price-monthly="2,499"
                            data-price-yearly="2,250">2,250</div>
                    </div>
                    <div class="price-card--price-conditions">
                        <div class="toggle-price-content" data-price-monthly="Billed Monthly"
                            data-price-yearly="Billed Annually">Billed Annually</div>

                    </div>
                </div>



                <div class="price-card--features">

                    <ul class="price-card--features--list">
                        <li class="price-card--features--item has-tooltip">Sales & Marketing Platform
                            <div class="tooltip-container"><strong>Sales & Marketing Platform</strong>
                                <p>Vendasta's end-to-end sales solution for companies that serve local businesses, and
                                    want to grow digital revenue.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Snapshot & Campaigns
                            <div class="tooltip-container"><strong>Snapshot & Campaigns</strong>
                                <p>Access to award-winning automated needs-assessment and email marketing automation.
                                    Unlimited emails sent to unlimited accounts.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Marketplace
                            <div class="tooltip-container"><strong>Marketplace</strong>
                                <p>Access to world-class resellable products & services, aimed to fulfilling the digital
                                    marketing needs of your small & medium sized business clients.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Business Center & Store
                            <div class="tooltip-container"><strong>Business Center & Store</strong>
                                <p>Portal for your local business clients, featuring your agency’s branding. They can
                                    access the products purchased from your Marketplace.</p>
                            </div>
                        </li>

                        <li class="price-card--features--item has-tooltip">Tech support
                            <div class="tooltip-container"><strong>Tech support</strong>
                                <p>Phone, Email and Web Chat support, <br />9am-9pm EST Mon-Fri, <br />2pm-7pm EST
                                    Sat-Sun</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Partner Success Manager
                            <div class="tooltip-container"><strong>Partner Success Manager</strong>
                                <p>One-on-one with a Vendasta Success Manager, who will provide sales training so you
                                    reach your goals quickly.</p>
                            </div>
                        </li>


                    </ul>
                    <button class="btn">Get started</button>
                </div>

                <div class="price-card--mobile-features-toggle"></div>

            </div>
            <!-- End of Card -->

            <!-- ================================ -->
            <!-- = Enterprise Subscription Card = -->
            <!-- ================================ -->
            <div class="price-card price-card--hero">

                <div class="price-card--header">
                    <h4>Enterprise</h4>

                </div>
                <div class="price-card--hero-text">
                    Most Popular Plan
                </div>

                <div class="price-card--price">
                    <div class="price-card--price-text">
                        <div class="price-card--price-number toggle-price-content odometer" data-price-monthly="999"
                            data-price-yearly="900">900</div>
                    </div>
                    <div class="price-card--price-conditions">
                        <div class="toggle-price-content" data-price-monthly="Billed Monthly"
                            data-price-yearly="Billed Annually">Billed Annually</div>

                    </div>
                </div>

                <div class="price-card--features">
                    <ul class="price-card--features--list">

                        <li class="price-card--features--item has-tooltip">Sales & Marketing Platform
                            <div class="tooltip-container"><strong>Sales & Marketing Platform</strong>
                                <p>Vendasta's end-to-end sales solution for companies that serve local businesses, and
                                    want to grow digital revenue.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Snapshot & Campaigns
                            <div class="tooltip-container"><strong>Snapshot & Campaigns</strong>
                                <p>Access to award-winning automated needs-assessment and email marketing automation.
                                    Unlimited emails sent to unlimited accounts.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Marketplace
                            <div class="tooltip-container"><strong>Marketplace</strong>
                                <p>Access to world-class resellable products & services, aimed to fulfilling the digital
                                    marketing needs of your small & medium sized business clients.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Business Center & Store
                            <div class="tooltip-container"><strong>Business Center & Store</strong>
                                <p>Portal for your local business clients, featuring your agency’s branding. They can
                                    access the products purchased from your Marketplace.</p>
                            </div>
                        </li>

                        <li class="price-card--features--item has-tooltip">Tech support
                            <div class="tooltip-container"><strong>Tech support</strong>
                                <p>Phone, Email and Web Chat support, <br />9am-9pm EST Mon-Fri, <br />2pm-7pm EST
                                    Sat-Sun</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Partner Success Manager
                            <div class="tooltip-container"><strong>Partner Success Manager</strong>
                                <p>One-on-one with a Vendasta Success Manager, who will provide sales training so you
                                    reach your goals quickly.</p>
                            </div>
                        </li>


                    </ul>
                    <button class="btn-pro">Get started</button>
                </div>

                <div class="price-card--mobile-features-toggle"></div>

            </div>

            <div class="price-card">

                <div class="price-card--header">
                    <h4>Basic</h4>

                </div>

                <div class="price-card--price">
                    <div class="price-card--price-text only-yearly">
                        <div class="price-card--price-number odometer">249</div>
                        <div class="only-yearly--text"><span>Only Available Yearly</span></div>
                    </div>
                    <div class="price-card--price-conditions">
                        <div>Billed Annually</div>

                    </div>
                </div>



                <div class="price-card--features">
                    <ul class="price-card--features--list">

                        <li class="price-card--features--item has-tooltip">Sales & Marketing Platform
                            <div class="tooltip-container"><strong>Sales & Marketing Platform</strong>
                                <p>Vendasta's end-to-end sales solution for companies that serve local businesses, and
                                    want to grow digital revenue.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Snapshot & Campaigns
                            <div class="tooltip-container"><strong>Snapshot & Campaigns</strong>
                                <p>Access to award-winning automated needs-assessment and email marketing automation.
                                    Unlimited emails sent to unlimited accounts.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Marketplace
                            <div class="tooltip-container"><strong>Marketplace</strong>
                                <p>Access to world-class resellable products & services, aimed to fulfilling the digital
                                    marketing needs of your small & medium sized business clients.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Business Center & Store
                            <div class="tooltip-container"><strong>Business Center & Store</strong>
                                <p>Portal for your local business clients, featuring your agency’s branding. They can
                                    access the products purchased from your Marketplace.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Tech support (limited)
                            <div class="tooltip-container"><strong>Tech support (limited)</strong>
                                <p>Email and Web Chat support, <br />9am-9pm EST Mon-Fri, <br />2pm-7pm EST Sat-Sun</p>
                            </div>
                        </li>

                        <li class="price-card--features--item has-tooltip tooltip-disabled features-disabled">Partner
                            Success Manager
                            <div class="tooltip-container"><strong>Partner Success Manager</strong>
                                <p>One-on-one with a Vendasta Success Manager, who will provide sales training so you
                                    reach your goals quickly.</p>
                            </div>
                        </li>

                    </ul>
                    <button class="btn">Get started</button>
                </div>

                <div class="price-card--mobile-features-toggle"></div>

            </div>
            <!-- End of Card -->

        </div>
        <!--    end of pricing-cards -->


    </section>
    <section id="pricing-container">
        <br><br><br><br>

        <div id="pricing-cards">

            <!-- ============================= -->
            <!-- = Premium Subscription Card = -->
            <!-- ============================= -->
            <div class="price-card">

                <div class="price-card--header">
                    <h4>Premium</h4>
                    <!-- <p>for growing your business</p> -->
                </div>

                <div class="price-card--price">
                    <div class="price-card--price-text">
                        <div class="price-card--price-number toggle-price-content odometer" data-price-monthly="2,499"
                            data-price-yearly="2,250">2,250</div>
                    </div>
                    <div class="price-card--price-conditions">
                        <div class="toggle-price-content" data-price-monthly="Billed Monthly"
                            data-price-yearly="Billed Annually">Billed Annually</div>

                    </div>
                </div>



                <div class="price-card--features">

                    <ul class="price-card--features--list">
                        <li class="price-card--features--item has-tooltip">Sales & Marketing Platform
                            <div class="tooltip-container"><strong>Sales & Marketing Platform</strong>
                                <p>Vendasta's end-to-end sales solution for companies that serve local businesses, and
                                    want to grow digital revenue.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Snapshot & Campaigns
                            <div class="tooltip-container"><strong>Snapshot & Campaigns</strong>
                                <p>Access to award-winning automated needs-assessment and email marketing automation.
                                    Unlimited emails sent to unlimited accounts.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Marketplace
                            <div class="tooltip-container"><strong>Marketplace</strong>
                                <p>Access to world-class resellable products & services, aimed to fulfilling the digital
                                    marketing needs of your small & medium sized business clients.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Business Center & Store
                            <div class="tooltip-container"><strong>Business Center & Store</strong>
                                <p>Portal for your local business clients, featuring your agency’s branding. They can
                                    access the products purchased from your Marketplace.</p>
                            </div>
                        </li>

                        <li class="price-card--features--item has-tooltip">Tech support
                            <div class="tooltip-container"><strong>Tech support</strong>
                                <p>Phone, Email and Web Chat support, <br />9am-9pm EST Mon-Fri, <br />2pm-7pm EST
                                    Sat-Sun</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Partner Success Manager
                            <div class="tooltip-container"><strong>Partner Success Manager</strong>
                                <p>One-on-one with a Vendasta Success Manager, who will provide sales training so you
                                    reach your goals quickly.</p>
                            </div>
                        </li>


                    </ul>
                    <button class="btn">Get started</button>
                </div>

                <div class="price-card--mobile-features-toggle"></div>

            </div>
            <!-- End of Card -->

            <!-- ================================ -->
            <!-- = Enterprise Subscription Card = -->
            <!-- ================================ -->
            <div class="price-card price-card--hero">

                <div class="price-card--header">
                    <h4>Enterprise</h4>

                </div>
                <div class="price-card--hero-text">
                    Most Popular Plan
                </div>

                <div class="price-card--price">
                    <div class="price-card--price-text">
                        <div class="price-card--price-number toggle-price-content odometer" data-price-monthly="999"
                            data-price-yearly="900">900</div>
                    </div>
                    <div class="price-card--price-conditions">
                        <div class="toggle-price-content" data-price-monthly="Billed Monthly"
                            data-price-yearly="Billed Annually">Billed Annually</div>

                    </div>
                </div>

                <div class="price-card--features">
                    <ul class="price-card--features--list">

                        <li class="price-card--features--item has-tooltip">Sales & Marketing Platform
                            <div class="tooltip-container"><strong>Sales & Marketing Platform</strong>
                                <p>Vendasta's end-to-end sales solution for companies that serve local businesses, and
                                    want to grow digital revenue.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Snapshot & Campaigns
                            <div class="tooltip-container"><strong>Snapshot & Campaigns</strong>
                                <p>Access to award-winning automated needs-assessment and email marketing automation.
                                    Unlimited emails sent to unlimited accounts.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Marketplace
                            <div class="tooltip-container"><strong>Marketplace</strong>
                                <p>Access to world-class resellable products & services, aimed to fulfilling the digital
                                    marketing needs of your small & medium sized business clients.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Business Center & Store
                            <div class="tooltip-container"><strong>Business Center & Store</strong>
                                <p>Portal for your local business clients, featuring your agency’s branding. They can
                                    access the products purchased from your Marketplace.</p>
                            </div>
                        </li>

                        <li class="price-card--features--item has-tooltip">Tech support
                            <div class="tooltip-container"><strong>Tech support</strong>
                                <p>Phone, Email and Web Chat support, <br />9am-9pm EST Mon-Fri, <br />2pm-7pm EST
                                    Sat-Sun</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Partner Success Manager
                            <div class="tooltip-container"><strong>Partner Success Manager</strong>
                                <p>One-on-one with a Vendasta Success Manager, who will provide sales training so you
                                    reach your goals quickly.</p>
                            </div>
                        </li>


                    </ul>
                    <button class="btn-pro">Get started</button>
                </div>

                <div class="price-card--mobile-features-toggle"></div>

            </div>

            <div class="price-card">

                <div class="price-card--header">
                    <h4>Basic</h4>

                </div>

                <div class="price-card--price">
                    <div class="price-card--price-text only-yearly">
                        <div class="price-card--price-number odometer">249</div>
                        <div class="only-yearly--text"><span>Only Available Yearly</span></div>
                    </div>
                    <div class="price-card--price-conditions">
                        <div>Billed Annually</div>

                    </div>
                </div>



                <div class="price-card--features">
                    <ul class="price-card--features--list">

                        <li class="price-card--features--item has-tooltip">Sales & Marketing Platform
                            <div class="tooltip-container"><strong>Sales & Marketing Platform</strong>
                                <p>Vendasta's end-to-end sales solution for companies that serve local businesses, and
                                    want to grow digital revenue.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Snapshot & Campaigns
                            <div class="tooltip-container"><strong>Snapshot & Campaigns</strong>
                                <p>Access to award-winning automated needs-assessment and email marketing automation.
                                    Unlimited emails sent to unlimited accounts.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Marketplace
                            <div class="tooltip-container"><strong>Marketplace</strong>
                                <p>Access to world-class resellable products & services, aimed to fulfilling the digital
                                    marketing needs of your small & medium sized business clients.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Business Center & Store
                            <div class="tooltip-container"><strong>Business Center & Store</strong>
                                <p>Portal for your local business clients, featuring your agency’s branding. They can
                                    access the products purchased from your Marketplace.</p>
                            </div>
                        </li>
                        <li class="price-card--features--item has-tooltip">Tech support (limited)
                            <div class="tooltip-container"><strong>Tech support (limited)</strong>
                                <p>Email and Web Chat support, <br />9am-9pm EST Mon-Fri, <br />2pm-7pm EST Sat-Sun</p>
                            </div>
                        </li>

                        <li class="price-card--features--item has-tooltip tooltip-disabled features-disabled">Partner
                            Success Manager
                            <div class="tooltip-container"><strong>Partner Success Manager</strong>
                                <p>One-on-one with a Vendasta Success Manager, who will provide sales training so you
                                    reach your goals quickly.</p>
                            </div>
                        </li>

                    </ul>
                    <button class="btn">Get started</button>
                </div>

                <div class="price-card--mobile-features-toggle"></div>

            </div>
            <!-- End of Card -->

        </div>
        <!--    end of pricing-cards -->


    </section>
</body>

</html>
