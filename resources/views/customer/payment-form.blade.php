<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>
<style>
    *,
    html,
    body {
        box-sizing: border-box;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: Inter, Roboto, "Helvetica Neue", "Arial Nova", "Nimbus Sans",
            Arial, sans-serif;
        font-weight: normal;
        background-color: gray;
        color: #505151;
        background-image: url("https://assets-global.website-files.com/62e3ee10882dc50bcae8d07a/631a5d4631d4c55a475f3e34_noise-50.png");

    }

    a {
        text-decoration: none;
        color: #ffd000;
    }



    /* Genric styles */

    button svg {
        stroke-width: 3px;
        width: 15px;
        height: 15px;
    }

    /** components **/

    .btn {
        display: inline-block;
        outline: 0;
        border: none;
        border: 1.5px solid rgba(1, 1, 1, 0.4);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.19), 0 1px 1px rgba(0, 0, 0, 0.23),
            inset 1px 1px 1px 0 rgba(255, 255, 255, 0.05);
        cursor: pointer;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.2s ease-out;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn:hover {
        /* box-shadow: 0 8px 22px 0 rgb(231 63 34 / 15%),
            0 4px 6px 0 rgb(231 63 34 / 20%); */

        box-shadow: 0 8px 22px 0 rgb(80 81 81 / 15%),
            0 4px 6px 0 rgb(80 81 81 / 20%);
    }

    .btn__round {
        padding: 8px;
        border-radius: 100%;
        border: none;
        flex: 0 1 0%;
    }

    .btn__secondary {
        background-color: #686868;
        color: #686868;
        font-weight: 600;
    }

    .btn__primary {
        background-color: #ffd000;
        color: #505151;
    }

    .item__icon {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        border-radius: 100%;
        background-color: #3b3b3b;
        border: 2px solid #333;
        color: #333;
        font-size: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .special-icon {
        font-size: 1.5rem;
        color: transparent;
        text-shadow: 0 0 0 #333;
    }

    .item__icon.premium_item {
        background-color: whitesmoke;
        border: 2px solid white;
        color: rgb(51 51 51 / 50%);
    }

    /* CSS noobiness */

    .container {
        /* border: 3px solid rgb(80 81 81 / 50%); */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23),
            inset 1px 1px 1px 0 rgba(255, 255, 255, 0.05),
            inset -1px -1px 1px 0 rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        margin: 2rem;
        max-width: 500px;
        /* background-image: url("https://assets-global.website-files.com/62e3ee10882dc50bcae8d07a/631a5d4631d4c55a475f3e34_noise-50.png"); */
        background-size: 20px 20px;
        background-color: #ffd000;
    }

    .form {
        padding: 1rem 1rem 0rem 1rem;
    }

    .checkout__header {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #checkout__title {
        font-size: 1rem;
    }

    .checkout__info,
    .checkout__summary {
        box-shadow: 0 1px 0 0 rgba(255, 255, 255, 0.1);
    }

    .checkout__info,
    .checkout__items,
    .checkout__summary {
        display: flex;
        flex-direction: column;
    }

    .checkout__info {
        padding: 0.5rem 0rem;
    }

    .checkout__item {
        display: flex;
        padding: 8px 0px;
        gap: 12px;
    }

    .item__text {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .item__price {
        margin-left: auto;
    }

    .checkout__coupon {
        padding: 1rem 0rem;
        display: flex;
        gap: 8px;
        justify-content: space-between;
    }

    .checkout__coupon input {
        flex-grow: 1;
        overflow: hidden;
        box-shadow: inset 2.5px 2.5px 2px 1px rgba(0, 0, 0, 0.04),
            inset -2.5px 0px 2px 1px rgba(1, 1, 1, 0.04);
        padding: 8px 12px;
        background: #686868;

        border: none;
        border-radius: 8px;

        white-space: nowrap;
        font-size: 15px;
        color: white;

        appearance: none;
        transition: border 0.15s ease 0s;
    }

    .checkout__coupon input:focus {
        outline: none;
        border: 1px solid;
        box-shadow: none;
        border-color: #505151;
    }

    .checkout__coupon input::placeholder {
        color: white;
    }

    .checkout__summary {
        padding: 10px 0;
    }

    .summary_container {
        display: flex;
        padding: 8px 0px;
    }

    .summary_container span:nth-child(2) {
        margin-left: auto;
    }

    .checkout__buttons {
        box-shadow: 0 -1px 2px 0 rgba(255, 255, 255, 0.1),
            0 -3px 0 0 rgba(20, 20, 20, 1);
        padding: 1rem;
        display: flex;
        gap: 8px;
    }

    .checkout__buttons button {
        flex: 1 1 0%;
    }

    .checkout__total {
        padding: 20px 0;
    }

    .total__container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .text-grey {
        color: #505151;
        font-size: 0.8rem;
    }

    .razorpay-payment-button {
        border: 0;
        background-color: #ffd000;
        color: #505151;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .w-full {
        width: 225px !important;
    }

</style>

<body>
    <div class="container">
        <div class="form">
            <header class="checkout__header">

                <span class="text-grey" id="checkout__title">Checkout</span>

            </header>
            <section class="checkout__info">
                <div class="checkout__items">
                    <div class="checkout__item">
                        <div class="item__text">
                            <span>{{$details['package_name']}}</span>
                            @switch($details['package_type'])
                                @case(1)
                                    <span class="text-grey">Basic</span>
                                @break

                                @case(2)
                                    <span class="text-grey">Standard</span>
                                @break

                                @case(3)
                                    <span class="text-grey">Premium</span>
                                @break

                                @case(4)
                                    <span class="text-grey">Diamond</span>
                                @break
                            @endswitch
                        </div>
                        <div class="item__price">Rs {{$order->amount/100}}<span class="text-grey">/ only</span></div>
                        <input type="hidden" name="" value="{{$order->amount/100}}" id="total_price">
                    </div>
                </div>
            </section>
            <section class="checkout__summary">
                <div class="summary_container"><span class="text-grey">Subtotal</span><span>Rs {{$order->amount/100}}</span></div>
                <div class="summary_container"><span class="text-grey">Discount</span><span id="discount">0</span></div>
            </section>
            <section class="checkout__total">
                <div class="total__container"><span>TOTAL</span><span id="total">{{$order->amount/100}}</span></div>
                <span class="text-grey">
                    If the price changes, we'll notify you beforehand. You can check your renewal date or cancel anytime
                    via your.
                </span>
            </section>
        </div>
        <footer class="checkout__buttons">
            <button class="btn btn__secondary"><a href="{{ route('customer-all-services') }}">Cancel</a></button>
            <button class="btn btn__primary">
                <form id="paymentForm" action="{{ route('rx-pay') }}" method="POST">
                    @csrf
                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ config('services.razorpay.key') }}"
                        data-amount="{{$order->amount}}"
                        data-currency="INR"
                        data-order_id="{{$order->id}}"
                        data-buttontext="Pay Now"
                        data-name="ETaxwala Business Solutions Pvt Ltd"
                        data-description="Payment for your order"
                        data-image="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://etaxwala.com/wp-content/uploads/elementor/thumbs/cropped-Untitled-design-qbkbv6xuw0luo8ojriil3vigwa1g2fidapvvvur6hc.png"
                        data-prefill.name="{{$details['name']}}"
                        data-prefill.email="{{$details['email']}}"
                        data-prefill.contact="{{$details['contact']}}"
                        data-theme.color="#fea837"
                    ></script>
                    <input type="hidden" custom="Hidden Element" name="hidden">
                </form>
            </button>
        </footer>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
