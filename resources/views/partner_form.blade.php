<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Inquiry Form</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
    * {
        font-family: "Poppins", sans-serif;
    }

    /* body {
        background-image: linear-gradient(to left bottom,
                #051937,
                #05162f,
                #ffd000 ,
                #040f1f,
                #010a18);

        background-size: 800%;
        animation: animateClr 1s infinite cubic-bezier(0.62, 0.28, 0.23, 0.99);
    } */
    body {
        background-color: #ffd000;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    select,
    textarea {
        border: none;
        border-bottom: 2px solid rgb(128, 126, 126);
        background: transparent;
        outline: none;
        width: 100%;
        padding: 1rem 0.4rem;
    }

    .aside {
        background-image: linear-gradient(to left bottom,
                #050505,
                #050505,
                #050505,
                #050505,
                #050505);
        background-size: 400%;
    }

    @keyframes animateClr {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    ion-icon:not([name="logo-codepen"]) {
        border: 1px solid currentColor;
        border-radius: 20%;
        padding: 1rem;
    }

    btn-outline-dark {
        background-color: black !important;
    }
</style>

<body>
    <br>
    <div class="container">
        <div class="bg-light">

            <div class="row">
                <div class="col-lg-8 col-md-12 px-5 bg-white rounded-3">
                    <div class="">
                        <center>
                            <h1>
                                <img class="" height="100" width="200"
                                    src="{{ url('public/assets/img/logo_black.png') }}" alt="ETaxwala">
                            </h1>
                        </center>
                        <h1 class="h5 text-capitalize my-2">Fill Your Details To Join The Webinar.</h1>

                    </div>
                    <form id="ajax-form" class="row">
                        @csrf
                        <div class="col-md-6 p-3">
                            <input required placeholder="Enter Name" type="text" name="name" id="name" />
                        </div>
                        <div class="col-md-6 p-3">
                            <input required placeholder="E-mail" type="email" name="email" id="email" />
                        </div>
                        <div class="col-md-6 p-3">
                            <input required placeholder="Phone No" type="number" name="contact" id="contact" />
                        </div>

                        <div class="col-md-6 p-3">
                            <select name="service" id="service">
                                <option>ETaxwala Business Clinic</option>
                            </select>
                        </div>

                        <div class="col-md-8 p-3 text-start" id="response-message"></div>
                        <div class="col-md-4 p-3 text-end mt-4">
                            <input class="btn px-4 py-3 btn-warning" type="submit" value="Submit & Join Webinar" />
                        </div>
                    </form>

                </div>
                <div class="col-lg-4 col-md-12 text-white aside px-4 py-5">
                    <center>
                        <h1>
                            <img class="" height="50" width="200"
                                src="{{ url('public/assets/img/logo_white.png') }}" alt="ETaxwala">
                        </h1>
                    </center>
                    <br>
                    <div class="mb-5">
                        <h1 class="h3">Contact Information</h1>
                        <p class="opacity-50">
                            <small>
                                Contact below no if you have any technical issues to join the webinar.
                            </small>
                        </p>
                    </div>
                    <div class="d-flex flex-column px-0">
                        <ul class="m-0 p-0">
                            <li class="d-flex justify-content-start align-items-center mb-4">
                                <span class="opacity-50 d-flex align-items-center me-3 fs-2">
                                    <i class="bi-telephone"></i>
                                </span>
                                <span>+91 7071 070707</span>
                            </li>
                            <li class="d-flex align-items-center r mb-4">
                                <span class="opacity-50 d-flex align-items-center me-3 fs-2">
                                    <i class="bi-envelope"></i>
                                </span>
                                <span>support@etaxwala.com</span>
                            </li>
                            <li class="d-flex justify-content-start align-items-center mb-4">
                                <span class="opacity-50 d-flex align-items-center me-3 fs-2">
                                    <i class="bi-geo-alt"></i>
                                </span>
                                <span>150 Jalna Road,<br /> beside Bhagwati Traders,<br /> Ambad, Maharashtra 431204
                                </span>
                            </li>
                        </ul>
                        <div class="text-muted text-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
<script>
    $(document).ready(function() {
        $("#ajax-form").submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = {
                'name': $("#name").val(),
                'email': $("#email").val(),
                'contact': $("#contact").val(),
                'service': $("#service").val(),
                '_token': $("input[name=_token]").val() // CSRF token
            };

            $.ajax({
                type: "POST",
                url: "{{ route('partner-inquiry') }}", // Your endpoint URL
                data: formData,
                success: function(response) {
                    console.log(response);
                    // $("#response-message").innerHTML(response.message);
                    var targetElement = document.getElementById('response-message');
                    $("#ajax-form")[0].reset();
                    window.open(response.message, "_blank");
                    // Display the message with HTML
                    // targetElement.innerHTML = response.message;
                },
                error: function(xhr, status, error) {
                    $("#response-message").text("An error occurred: " + error);
                }
            });
        });
    });

    
</script>