@include('ui.header')
<style>
    #service-price {
        display: none;
    }
</style>
<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">

                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Customer's Inquries</h6>

                </div>

                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Service</th>
                                    <th>Query</th>

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('ui.footer')
<script type="text/javascript">


    $(function() {



        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('franchise-partner-customer-inquries') }}",

            columns: [{
                    data: 'name',
                    "className": "text-center",
                    "searchable": false,
                    "orderable": true,
                },
                {
                    data: 'email',
                    name: 'email',
                    "orderable": false,
                },
                {
                    data: 'contact',
                    name: 'contact',
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
                    "orderable": false,
                },
                {
                    data: 'service_name',
                    name: 'service_name',
                    "orderable": false,
                },
                {
                    data: 'cust_query',
                    name: 'cust_query',
                    "searchable": true,
                    "orderable": false,
                },



            ]
        });


    });

</script>
