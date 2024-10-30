<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Etaxwala</title>

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body,
    input {
        font-family: 'Montserrat', sans-serif;
    }

    .container {
        position: relative;
        width: 100%;
        background-color: #fff;
        min-height: 100vh;
        overflow: hidden;
    }

    .forms-container {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .signin-signup {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        left: 75%;
        width: 50%;
        transition: 1s 0.7s ease-in-out;
        display: grid;
        grid-template-columns: 1fr;
        z-index: 5;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0rem 5rem;
        transition: all 0.2s 0.7s;
        overflow: hidden;
        grid-column: 1 / 2;
        grid-row: 1 / 2;
    }

    form.sign-up-form {
        opacity: 0;
        z-index: 1;
    }

    form.sign-in-form {
        z-index: 2;
    }

    .title {
        font-size: 2.2rem;
        color: #444;
        margin-bottom: 10px;
    }

    .input-field {
        max-width: 380px;
        width: 100%;
        background-color: #f0f0f0;
        margin: 10px 0;
        height: 55px;
        border-radius: 5px;
        display: grid;
        grid-template-columns: 15% 70% 15%;
        padding: 0 0.4rem;
        position: relative;
    }

    .input-field i {
        text-align: center;
        line-height: 55px;
        color: #acacac;
        transition: 0.5s;
        font-size: 1.1rem;
    }

    .input-field input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 400;
        font-size: 1.1rem;
        color: #333;
    }

    .input-field select {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 400;
        font-size: 1.1rem;
        color: #333;
    }


    .input-field input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .social-text {
        padding: 0.7rem 0;
        font-size: 1rem;
    }

    .social-media {
        display: flex;
        justify-content: center;
    }

    .social-icon {
        height: 46px;
        width: 46px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 0.45rem;
        color: #333;
        border-radius: 50%;
        border: 1px solid #333;
        text-decoration: none;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    .social-icon:hover {
        color: #ffd000;
        border-color: #ffd000;
    }

    .btn {
        width: 150px;
        background-color: #ffd000;
        border: none;
        outline: none;
        height: 49px;
        border-radius: 4px;
        color: black;
        text-transform: uppercase;
        font-weight: 600;
        margin: 10px 0;
        cursor: pointer;
        transition: 0.5s;
    }

    .btn:hover {
        background-color: #ffd000be;
    }

    .panels-container {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .container:before {
        content: "";
        position: absolute;
        height: 2000px;
        width: 2000px;
        top: -10%;
        right: 48%;
        transform: translateY(-50%);
        background-image: linear-gradient(-45deg, #ffd000 0%, #ffd000 100%);
        transition: 1.8s ease-in-out;
        border-radius: 50%;
        z-index: 6;
    }

    .image {
        width: 100%;
        transition: transform 1.1s ease-in-out;
        transition-delay: 0.4s;
    }

    .panel {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-around;
        text-align: center;
        z-index: 6;
    }

    .left-panel {
        pointer-events: all;
        padding: 3rem 17% 2rem 12%;
    }

    .right-panel {
        pointer-events: none;
        padding: 3rem 12% 2rem 17%;
    }

    .panel .content {
        color: black;
        transition: transform 0.9s ease-in-out;
        transition-delay: 0.6s;
    }

    .panel h3 {
        font-weight: 600;
        line-height: 1;
        font-size: 1.5rem;
    }

    .panel p {
        font-size: 0.95rem;
        padding: 0.7rem 0;
    }

    .btn.transparent {
        margin: 0;
        background: black;
        color: white !important;
        border: 2px solid black;
        width: 130px;
        height: 41px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .right-panel .image,
    .right-panel .content {
        transform: translateX(800px);
    }

    /* ANIMATION */

    .container.sign-up-mode:before {
        transform: translate(100%, -50%);
        right: 52%;
    }

    .container.sign-up-mode .left-panel .image,
    .container.sign-up-mode .left-panel .content {
        transform: translateX(-800px);
    }

    .container.sign-up-mode .signin-signup {
        left: 25%;
    }

    .container.sign-up-mode form.sign-up-form {
        opacity: 1;
        z-index: 2;
    }

    .container.sign-up-mode form.sign-in-form {
        opacity: 0;
        z-index: 1;
    }

    .container.sign-up-mode .right-panel .image,
    .container.sign-up-mode .right-panel .content {
        transform: translateX(0%);
    }

    .container.sign-up-mode .left-panel {
        pointer-events: none;
    }

    .container.sign-up-mode .right-panel {
        pointer-events: all;
    }

    @media (max-width: 870px) {
        .container {
            min-height: 800px;
            height: 100vh;
        }

        .signin-signup {
            width: 100%;
            top: 95%;
            transform: translate(-50%, -100%);
            transition: 1s 0.8s ease-in-out;
        }

        .signin-signup,
        .container.sign-up-mode .signin-signup {
            left: 50%;
        }

        .panels-container {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 2fr 1fr;
        }

        .panel {
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 2.5rem 8%;
            grid-column: 1 / 2;
        }

        .right-panel {
            grid-row: 3 / 4;
        }

        .left-panel {
            grid-row: 1 / 2;
        }

        .image {
            width: 200px;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.6s;
        }

        .panel .content {
            padding-right: 15%;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.8s;
        }

        .panel h3 {
            font-size: 1.2rem;
        }

        .panel p {
            font-size: 0.7rem;
            padding: 0.5rem 0;
        }

        .btn.transparent {
            width: 110px;
            height: 35px;
            font-size: 0.7rem;
        }

        .container:before {
            width: 1500px;
            height: 1500px;
            transform: translateX(-50%);
            left: 30%;
            bottom: 68%;
            right: initial;
            top: initial;
            transition: 2s ease-in-out;
        }

        .container.sign-up-mode:before {
            transform: translate(-50%, 100%);
            bottom: 32%;
            right: initial;
        }

        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateY(-300px);
        }

        .container.sign-up-mode .right-panel .image,
        .container.sign-up-mode .right-panel .content {
            transform: translateY(0px);
        }

        .right-panel .image,
        .right-panel .content {
            transform: translateY(300px);
        }

        .container.sign-up-mode .signin-signup {
            top: 5%;
            transform: translate(-50%, 0);
        }
    }

    @media (max-width: 570px) {
        form {
            padding: 0 1.5rem;
        }

        .image {
            display: none;
        }

        .panel .content {
            padding: 0.5rem 1rem;
        }

        .container {
            padding: 1.5rem;
        }

        .container:before {
            bottom: 72%;
            left: 50%;
        }

        .container.sign-up-mode:before {
            bottom: 28%;
            left: 50%;
        }
    }

    .toggle {
        background: none;
        border: none;
        color: #337ab7;
        /*display: none;*/
        /*font-size: .9em;*/
        font-weight: 600;
        /*padding: .5em;*/
        position: absolute;
        right: .75em;
        z-index: 9;
    }

    .alert {
        position: relative;
        top: 10;
        left: 0;
        width: auto;
        height: auto;
        padding: 10px;
        margin: 10px;
        line-height: 1.8;
        border-radius: 5px;
        cursor: hand;
        cursor: pointer;
        font-family: sans-serif;
        font-weight: 400;
    }

    .error {
        background-color: #FEE;
        border: 1px solid #EDD;
        color: #f9423c;
    }

    #error {
        color: #f9423c;
    }

    .msg {
        color: red;

    }
</style>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <form action="{{ route('customer-login') }}" method="POST" class="sign-in-form">
                    @csrf
                    <h2 class="title"><img class="ms-user-img  ms-lock-screen-user"
                            src="{{ url(env('LINK') . 'img/logo_black.png') }}" height="100" width="300" alt="ETaxwala">
                    </h2>
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Email Id" name="customer_email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="txtPassword1" name="customer_password" required />
                        <button type="button" id="btnToggle1" class="toggle"><i id="eyeIcon1"
                                class="fa fa-eye"></i></button>
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                    {{-- <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> --}}
                    @if (session('error'))
                        <div class="alert error">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>

                <form action="{{ route('customer-signup') }}" method="post" class="sign-up-form">
                    @csrf
                    <h2 class="title"><img class="ms-user-img  ms-lock-screen-user"
                        src="{{ url(env('LINK') . 'img/logo_black.png') }}" height="70" width="300" alt="ETaxwala">
                    </h2>
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Full Name" required name="customer_name"/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-mobile"></i>
                        <input type="mobile" placeholder="Mobile no" required name="customer_mobile"/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" required name="customer_email" id="customer_email" onchange="checkEmail(this.value)"/>

                    </div>
                    <div id="email-error"></div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="txtPassword2" onkeyup="checkpw()" required name="customer_password"/>
                        <button type="button" id="btnToggle2" class="toggle"><i id="eyeIcon2"
                                class="fa fa-eye"></i></button>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <select name="customer_service">
                            @foreach ($services as $service)
                                <option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="btn" value="Sign up" />
                    <p id="error">

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New to our community ?</h3>
                    <p>
                        Discover a world of possibilities! Join us and explore a vibrant
                        community where ideas flourish and connections thrive.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="{{ url('public/assets/img/Privacy-policy-rafiki.png') }}" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of Our Valued Customer</h3>
                    <p>
                        Thank you for being part of our community. Your presence enriches our
                        shared experiences. Let's continue this journey together!
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="{{ url('public/assets/img/Mobile-login-rafiki.png') }}" class="image" alt="" />
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });




    let passwordInput1 = document.getElementById('txtPassword1'),
        toggle1 = document.getElementById('btnToggle1'),
        icon1 = document.getElementById('eyeIcon1');

    let passwordInput2 = document.getElementById('txtPassword2'),
        toggle2 = document.getElementById('btnToggle2'),
        icon2 = document.getElementById('eyeIcon2');


    function togglePassword1() {
        if (passwordInput1.type === 'password') {
            passwordInput1.type = 'text';
            icon1.classList.add("fa-eye-slash");
            //toggle.innerHTML = 'hide';
        } else {
            passwordInput1.type = 'password';
            icon1.classList.remove("fa-eye-slash");
            //toggle.innerHTML = 'show';
        }
    }

    function togglePassword2() {
        if (passwordInput2.type === 'password') {
            passwordInput2.type = 'text';
            icon2.classList.add("fa-eye-slash");
            //toggle.innerHTML = 'hide';
        } else {
            passwordInput2.type = 'password';
            icon2.classList.remove("fa-eye-slash");
            //toggle.innerHTML = 'show';
        }
    }



    function checkInput() {
        //if (passwordInput.value === '') {
        //toggle.style.display = 'none';
        //toggle.innerHTML = 'show';
        //  passwordInput.type = 'password';
        //} else {
        //  toggle.style.display = 'block';
        //}
    }

    toggle1.addEventListener('click', togglePassword1, false);
    passwordInput1.addEventListener('keyup', checkInput, false);

    toggle2.addEventListener('click', togglePassword2, false);
    passwordInput2.addEventListener('keyup', checkInput, false);





    // password validation
    function checkpw() {
        var password = document.getElementById("txtPassword2").value;
        var errorMessage = document.getElementById("error");
        var errorDetail = "";
        try {
            if (password.length < 6) {
                errorDetail += "<br /> Password too short.";
            }
            if (/[A-Z]/g.test(password) == false) {
                errorDetail +=
                    "<br /> Password should include at least one capital letter.";
            }
            if (/\d/g.test(password) == false) {
                errorDetail += "<br /> Password should include at least one digit.";
            }

            throw errorDetail;
        } catch (err) {
            errorMessage.innerHTML = err;
        }
    }

    function checkEmail(v) {
        const email = v;
        // console.log(email);
            $.ajax({
                url: "{{ url('check-customer-email') }}",
                data: {
                    email: email,
                },
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        document.getElementById('customer_email').value = '';
                        $("#email-error").html(`<span class="msg text-red">${data.error}</span>`);
                    } else {
                        $("#email-error").html(
                            '');
                    }
                }
            });
    }
</script>
