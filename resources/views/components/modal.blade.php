<style>
    .mini-inquiry-form {
        display: block !important;
        top: 20% !important;
        left: 100% !important;
        transform: translate(-80%, -10%) !important;
    }

    .close {
        font-size: 30px;
        cursor: pointer;
    }

    .modal-content {
        max-width: 60%;
    }

    /* Small devices (landscape phones) */
    @media (min-width: 576px) {
        .mini-inquiry-form {
            left: 110% !important;
        }
    }

    /* Medium devices (tablets) */
    @media (min-width: 768px) {
        .mini-inquiry-form {
            left: 120% !important;
        }
    }

    /* Large devices (desktops) */
    @media (min-width: 992px) {
        .mini-inquiry-form {
            top: 8% !important;
            left: 120% !important;
            /* Adjusted position for larger screens */
        }
    }

    /* Extra large devices (larger desktops) */
    @media (min-width: 1200px) {
        .mini-inquiry-form {
            top: 8% !important;
            left: 125% !important;
        }
    }

    .my-modal {
        position: fixed;
    top: 0;
    left: 0;
    display: none;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
    z-index: -1;
    }
    .my-modal.active {
    display: block;
    z-index: 2000; /* Bring it to the top */
}

.form-control{
    max-height: 45px !important;
}
</style>


<div class="my-modal fade mini-inquiry-form" id="searchModal" tabindex="-1" aria-hidden="true" style="">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="">
            <div class="bg-warning" style="padding: 10px; border-radius: 10px; max-width: 100%">
                <div class="d-flex justify-content-between" style="margin-bottom: 15px">
                    <h3>Inquiry Now</h3>
                    <span class="close" onclick="closeModal()">&times;</span>

                </div>

                <form id="ajax-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 col-xl-12">
                            <div class="">
                                <input type="text" class="form-control" id="name" placeholder="Name"
                                    required>

                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="">
                                <input type="email" class="form-control" id="email" placeholder="Email"
                                    required>

                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="">
                                <input type="text" class="form-control" id="contact"
                                    placeholder="Mobile Number" required>

                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="">
                                <select name="service" class="form-control" id="service" required>
                                    <option value="" disabled selected>Select Service</option>
                                    <option value="Business Consultation">Business Consultation</option>
                                    <option value="Private Limited Registration">Private Limited Registration</option>
                                    <option value="LLP/OPC Registration">LLP/OPC Registration</option>
                                    <option value="Multi-state Registration">Multi-state Registration</option>
                                    <option value="Credit Co-operative Registration">Credit Co-operative Registration
                                    </option>
                                    <option value="Micro Finance (Section 8) Registration">Micro Finance (Section 8)
                                        Registration</option>
                                    <option value="FPC Registration">FPC Registration</option>
                                    <option value="NGO Registration">NGO Registration</option>
                                    <option value="Company Audit & Compliance">Company Audit & Compliance</option>
                                    <option value="GST Registration & Return">GST Registration & Return</option>
                                    <option value="Startup Registration">Startup Registration</option>
                                    <option value="Food Registration">Food Registration</option>
                                    <option value="Trademark Registration">Trademark Registration</option>
                                    <option value="Export/Import License">Export/Import License</option>
                                    <option value="Income Tax Return">Income Tax Return</option>
                                    <option value="Project Report">Project Report</option>
                                    <option value="Business Funding">Business Funding</option>
                                    <option value="Marketing & Branding">Marketing & Branding</option>
                                    <option value="ETaxwala partner">ETaxwala partner</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="">
                                <input type="text" class="form-control" id="state" placeholder="State"
                                    required>

                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="">
                                <input type="text" class="form-control" id="city" placeholder="City"
                                    required>

                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-black w-100 py-3" type="submit">Inquiry Now</button>
                        </div>
                        <div class="col-12" id="response-message">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Automatically display the modal on page load
        $("#searchModal").modal('show');
        document.querySelector('.my-modal').classList.add('active');
        // setInterval(function() {
        //     $("#searchModal").modal('show');
        // }, 30000);
    });

    function closeModal() {
        $("#searchModal").modal('hide');
        document.querySelector('.my-modal').classList.remove('active');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $("#ajax-form").submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = {
                'name': $("#name").val(),
                'email': $("#email").val(),
                'contact': $("#contact").val(),
                'service': $("#service").val(),
                'state': $("#state").val(),
                'city': $("#city").val(),
                '_token': $("input[name=_token]").val() // CSRF token
            };

            $.ajax({
                type: "POST",
                url: "{{ route('add-inquiry') }}", // Your endpoint URL
                data: formData,
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        html: 'For more information, join our WhatsApp Channel:<br><br><a class="btn btn-success" href="https://whatsapp.com/channel/0029VaklRIwD8SDyeJOQY043" target="_blank">Join Now</a>',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $("#ajax-form")[0].reset(); // Clear the form
                    $("#searchModal").modal('hide');
                    // $("#response-message").html('<div class="alert alert-success">' + response.message + '</div>');
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error processing your inquiry. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    // $("#response-message").html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                }
            });
        });
    });
</script>
