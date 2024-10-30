<div class="bg-warning" style="padding: 10px; border-radius: 10px">
    <center style="margin-bottom: 15px">
        <h2>Inquiry Now</h2>
    </center>
    <form id="ajax-form">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="contact" placeholder="Your Mobile Number" required>
                    <label for="contact">Mobile No</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="service" class="form-control" id="service" required>
                        <option value="" disabled selected>Select Service</option>
                        <option value="Business Consultation">Business Consultation</option>
                        <option value="Private Limited Registration">Private Limited Registration</option>
                        <option value="LLP/OPC Registration">LLP/OPC Registration</option>
                        <option value="Multi-state Registration">Multi-state Registration</option>
                        <option value="Credit Co-operative Registration">Credit Co-operative Registration</option>
                        <option value="Micro Finance (Section 8) Registration">Micro Finance (Section 8) Registration</option>
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
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="state" placeholder="Your State" required>
                    <label for="state">State</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="city" placeholder="Your City" required>
                    <label for="city">City</label>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
                        text: 'Inquiry submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $("#ajax-form")[0].reset(); // Clear the form
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
