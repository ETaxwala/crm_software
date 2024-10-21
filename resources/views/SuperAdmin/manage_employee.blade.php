@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>SA</h6>
                </div>
                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Date</th>

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

@include('ui.footer')
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
            ajax: "{{ route('admin-dashboard') }}",
            columns: [{
                    data: 'name',
                    name: 'name',
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
                    data: 'mobile',
                    name: 'mobile',
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
                    data: 'date',
                    name: 'date',
                    "searchable": true,
                    "orderable": false,
                },



            ]
        });

    });
</script>
