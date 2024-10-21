@include('Assistant.Operation.header')

<div class="ms-content-wrapper">

    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>All Customers</h6>
                </div>
                <div class="ms-panel-body">

                    <div class="table-responsive">
                        <table id="table" class=" table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Service</th>
                                    <th>Amount</th>
                                    <th>Added By</th>
                                    <th>Date</th>
                                    <th>Comment</th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@include('Assistant.Operation.footer')
<script>
     $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('oa-customer-details-list') }}",

            columns: [{
                    data: 'name',
                    name: 'name',
                    "searchable": true,
                    "orderable": false,
                },

                {
                    data: 'contact',
                    name: 'contact',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'email',
                    name: 'email',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'password',
                    name: 'password',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'state',
                    name: 'state',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'city',
                    name: 'city',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'service_name',
                    name: 'service_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'service_price',
                    name: 'service_price',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'username',
                    name: 'username',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'date',
                    name: 'date',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'emi_comment',
                    name: 'emi_comment',
                    "searchable": true,
                    "orderable": false,
                }


            ]
        });


    });
</script>
