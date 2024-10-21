
<!DOCTYPE html>
<html>

<head>
    <title>Book An Appointment</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&family=Montserrat:wght@600&display=swap');

    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    body {
        background-color: #686868;
        align-content: center;
        text-align: center;
    }

    .credit-card-form {
        
        margin-top: 5%;
        /*margin-left: 10%;*/
        max-width: 800px;
        height: 80vh;
        padding: 1em;
        border-radius: 10px;
        box-shadow: 0px 6px 10px rgba(255, 255, 255, 0.1);
        font-family: 'Montserrat', sans-serif;
        background-color: #dbdbdb;
        text-align: center;
        color: #424242;
        align-content: center;
    }

    .credit-card-form h2 {
        margin-bottom: 10%;
        font-size: 24px;
    }

    .credit-card-form .form-group {
        margin-bottom: 15px;

    }

    .credit-card-form label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #777;
    }

    .credit-card-form input[type="text"],
    .credit-card-form select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 1rem;
        font-size: 16px;
        font-family: 'Montserrat', sans-serif;
    }

    .credit-card-form .form-row {
        display: flex;
    }


    .credit-card-form button[type="submit"] {
        width: 75%;
        padding: 14px;
        background-color: #ffd000;
        color: #fff;
        border: none;
        border-radius: 1rem;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        font-family: 'Montserrat', sans-serif;
    }

    .razorpay-payment-button{

        width: 75%;
        padding: 14px;
        background-color: #ffd000;
        color: #fff;
        border: none;
        border-radius: 1rem;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        font-family: 'Montserrat', sans-serif;
    }

    .credit-card-form button[type="submit"]:hover {
        background-color: #808080;
        color: #424242;
        font-family: 'Montserrat', sans-serif;
        box-shadow: 0px 6px 10px rgba(255, 255, 255, 0.1);
    }

    .razorpay-payment-button:hover {
        background-color: #808080;
        color: #424242;
        font-family: 'Montserrat', sans-serif;
        box-shadow: 0px 6px 10px rgba(255, 255, 255, 0.1);
    }

    .credit-card-form button[type="submit"]:focus {
        outline: none;
        font-family: 'Montserrat', sans-serif;
    }

    p {
        color: white;
        margin-top: 6%;
        font-family: 'Montserrat', sans-serif;
        text-align: center;
        margin-bottom: 45px;
        font-size: 70%;
        text-shadow: 0 0 5px #cacaca;
    }

    .Image1 {
        margin-top: 0;
        width: 220px;
    }

    .h2 {
        margin: 0px;
    }

    .website-link {
        color: #424242
    }
</style>

<body>
    <center>
        <div class="credit-card-form">
            <img class="Image1" src="https://system.etaxwala.com/public/assets/img/logo_black.png"
                alt="6375aad33dbabc9c424b5713-card-mockup-01" border="0"></a>

            <h2>Confirm Payment</h2>
            <h4>For</h4>
            <br>
            <h5>Appointment Booking</h5>
            <br>

            {{-- <button type="submit" class="click-button" onclick="showLoading(event, this)"> --}}
                <form id="paymentForm" action="{{ route('appointment.pay.now') }}" method="POST">
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('services.razorpay.key') }}"
                        data-amount="{{ $data['amount'] }}" data-currency="INR" data-order_id="{{ $data['order_id'] }}"
                        data-buttontext="Pay 499 Only" data-name="ETaxwala Business Solutions Pvt Ltd" data-description="Payment for your order"
                        data-image="https://system.etaxwala.com/public/assets/img/logo_black.png" data-prefill.name="{{ $data['name'] }}"
                        data-prefill.email="{{ $data['email'] }}" data-prefill.contact="{{ $data['mobile'] }}" data-theme.color="#fea837">
                    </script>
                    <input type="hidden" custom="Hidden Element" name="hidden">
                </form>
            {{-- </button> --}}
            <br><br>
            <p class="website-link">Website: - <a class="website-link"
                    href="https://etaxwala.com/">https://etaxwala.com/</a>

                <br><br>
                Contact: - +91 70710 70707
                </p>
        </div>
    </center>

</body>

</html>
<script>
    function showLoading(event, button) {
        event.preventDefault(); // Prevent form submission

        button.innerHTML = "Processing Payment...";

        setTimeout(function() {
            button.innerHTML = "Payment completed.";
        }, 3000); // Change to the desired duration in milliseconds
    }
</script>
