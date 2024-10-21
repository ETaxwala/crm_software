@include('ui.header')

<style>
    .card {
        margin: 1em auto;
        border: 1px solid #E4A11B;
    }

    .card-title,
    .card-text {
        color: white !important;
    }

    #upload_docs {
        display: none;
    }


    .card {
        max-width: 34em;
        flex-direction: row;
        background-color: #ffd000;
        border: 0;
        box-shadow: 0 7px 7px rgba(0, 0, 0, 0.18);
        /* margin: 3em auto; */
    }

    .card.dark {
        color: black;
    }
    .text-dark{
        color: black !important;
    }

    .card.card.bg-light-subtle .card-title {
        color: dimgrey;
    }

    .card img {
        max-width: 25%;
        margin: auto;
        padding: 0.5em;
        border-radius: 0.7em;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .text-section {
        max-width: 100%;
    }

    .cta-section {
        max-width: 100%;
        display: flex;
        flex-direction: row;
        align-items: flex-end;
        justify-content: space-between;
    }

    .cta-section .btn {
        padding: 0.3em 0.5em;
        /* color: #696969; */
    }

    .card.bg-light-subtle .cta-section .btn {
        background-color: #898989;
        border-color: #898989;
    }

    @media screen and (max-width: 475px) {
        .card {
            font-size: 0.9em;
        }
    }
</style>
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>My Services</h6>

                    @if (session('success'))
                        <div id="flash-message" class="alert alert-success col-md-6">
                            <p>{{ session('success') }} <button type="button" class="close"
                                    onclick="closeFlashMessage()">&times;</button></p>

                        </div>
                    @endif
                </div>
                <div class="ms-panel-body">
                    <div class="row">

                        @foreach ($orders as $order)
                            @php
                                $due_date = $order->emi_due_date ? $order->emi_due_date : 'Not required';
                                $unpaid_amount = $order->emi_unpaid_amount
                                    ? 'RS ' . $order->emi_unpaid_amount
                                    : 'No Pending Payment';

                            @endphp
                            <div class="col-md-6">
                                <div class="card dark ">

                                    <div class="card-body">
                                        <div class=" cta-section">
                                            <h5 class="card-title text-dark">{{ $order->service_name }}</h5>
                                            <p class="">
                                                @switch($order->cp_type)
                                                    @case(1)
                                                        <span class="badge badge-dark">Basic</span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge badge-dark">Standard</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge badge-dark">Premium</span>
                                                    @break

                                                    @case(4)
                                                        <span class="badge badge-dark">Diamond</span>
                                                    @break
                                                @endswitch
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="cta-section">
                                            <div><b>Total Amount</b></div>
                                            <div><b>Paid Amount</b></div>
                                            <div><b>Unpaid Amount</b></div>
                                        </div>
                                        <div class="cta-section">
                                            <div>Rs {{ $order->emi_total_amount }} /-</div>
                                            <div>Rs {{ $order->emi_paid_amount }} /-</div>
                                            <div>Rs {{ $unpaid_amount }} /-</div>
                                        </div>
                                        <hr>
                                        <div class="cta-section">
                                            @php
                                                $current_date = date('Y-m-d');
                                                if ($current_date >= $due_date) {
                                                    echo "<div class='text-danger'><b>Next Due Date</b> <br>" . $due_date . "</div>";
                                                } else {
                                                    echo "<div><b>Next Due Date</b> <br>" . $due_date . "</div>";
                                                }

                                            @endphp

                                            <a href="{{ route('Single-Service', ['service_id' => $order->cp_title]) }}"
                                                class="btn btn-dark">Know more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('ui.footer')
    <script>
        function addDynamicField(v) {
            console.log(v);
            var dynamicFieldsDiv = document.getElementById(`dynamic-fields${v}`);

            // Create a new input element
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'cd_names[]'; // Use an array for dynamic fields
            newInput.placeholder = 'Document Name';
            newInput.className = 'form-control col-md-5 mt-2';
            newInput.accept = '.pdf, .jpeg, .jpg, .png';
            newInput.required = true;
            newInput.multiple = true;

            var newInput2 = document.createElement('input');
            newInput2.type = 'file';
            newInput2.name = 'cd_docs[]'; // Use an array for dynamic fields
            newInput2.placeholder = 'Dynamic Field';
            newInput2.className = 'form-control col-md-5 mt-2';
            newInput2.accept = '.pdf, .jpeg, .jpg, .png';
            newInput2.required = true;
            newInput2.multiple = true;

            // Create a button to remove the dynamic field
            var removeButton = document.createElement('span');
            removeButton.type = '';
            removeButton.textContent = '';
            removeButton.className = 'fas fa-trash-alt text-danger col-md-2 mt-2';
            removeButton.style.cursor = 'pointer';
            removeButton.onclick = function() {
                dynamicFieldsDiv.removeChild(newInput);
                dynamicFieldsDiv.removeChild(newInput2);
                dynamicFieldsDiv.removeChild(removeButton);
            };

            // Append the new input and remove button to the dynamic fields div
            dynamicFieldsDiv.appendChild(newInput);
            dynamicFieldsDiv.appendChild(newInput2);
            dynamicFieldsDiv.appendChild(removeButton);

            var numberOfChildren = dynamicFieldsDiv.children.length;
            console.log(numberOfChildren);
            if (numberOfChildren >= 3) {
                document.getElementById("upload_docs").style.display = "block";

            } else {
                document.getElementById("upload_docs").style.display = "none";
            }
        }
    </script>
    <script>
        // Function to close the flash message
        function closeFlashMessage() {
            document.getElementById('flash-message').style.display = 'none';
        }

        // Automatically close the flash message after 5000 milliseconds (5 seconds)
        setTimeout(function() {
            closeFlashMessage();
        }, 5000);
    </script>
