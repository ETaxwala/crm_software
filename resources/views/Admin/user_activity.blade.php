@include('ui.header')
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">


            <div class="ms-panel">
                <div class="ms-panel-header d-flex justify-content-between">
                    <h6>Users Activity</h6>
                    <ul class="nav nav-tabs d-flex tabs-round has-gap nav-justified mb-4" role="tablist">
                        <li role="presentation"><a href="#tab16" aria-controls="tab16" class="active" role="tab"
                                data-toggle="tab">Todays Activity</a></li>
                        <li role="presentation"><a href="#tab17" aria-controls="tab17" role="tab"
                                data-toggle="tab">OverAll Activity</a></li>
                    </ul>
                </div>

                <div class="ms-panel-body">

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active show fade in" id="tab16">
                            <div class="table-responsive">
                                <table class="table w-100 thead-primary">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Last Activity</th>
                                            <th>Status</th>
                                            <th>1st Login</th>
                                            <th>Hours</th>
                                            <th>Percentage</th>
                                            <th>Remark</th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->user_name }}</td>
                                                <td>
                                                    @switch ($item->user_type)
                                                        @case(2)
                                                            <span class="badge badge-success">Admin</span>
                                                        @break;
                                                        @case(3)
                                                            <span class="badge badge-success">Sales Manager</span>
                                                        @break;
                                                        @case(4)
                                                            <span class="badge badge-success">Operation Manager</span>
                                                        @break;
                                                        @case(5)
                                                            <span class="badge badge-success">Franchise Manager</span>
                                                        @break;
                                                        @case(6)
                                                            <span class="badge badge-success">Sales Executive</span>
                                                        @break;
                                                        @case(7)
                                                            <span class="badge badge-success">Operation Executive</span>
                                                        @break;
                                                        @case(8)
                                                            <span class="badge badge-success">Franchise partner</span>
                                                        @break;
                                                        @case(9)
                                                            <span class="badge badge-success">Operation Assistent</span>
                                                        @break;
                                                        @case(10)
                                                            <span class="badge badge-success">HR Manager</span>
                                                        @break;
                                                    @endswitch
                                                </td>
                                                <td>
                                                    
                                                    @php
                                                        $time = strtotime($item->last_activity_time);
                                                        $new_time = date('H:i A', $time);
                                                    @endphp
                                                    
                                                    {{ $new_time }}</td>
                                                <td>
                                                @if ($item->is_online == 'online')
                                                    <span class="badge badge-success">Online</span>
                                                @else
                                                    <span class="badge badge-danger">Offline</span>
                                                @endif
                                                
                                                </td>
                                                <td>
                                                    
                                                    @php
                                                        $time = strtotime($item->first_login_time);
                                                        $new_time = date('H:i A', $time);
                                                    @endphp
                                                    
                                                    {{ $new_time }}</td>
                                                
                                                <td>{{ number_format($item->total_hours_difference, 2) }}</td>

                                                <td>
                                                    @switch ($item->user_type)
                                                        @case(3)
                                                            <span>{{ number_format(($item->total_hours_difference / 4) * 100, 2) }}</span>
                                                        @break
                                                        @case(4)
                                                            <span>{{ number_format(($item->total_hours_difference / 6) * 100, 2) }}</span>
                                                        @break
                                                        @case(5)
                                                            <span>{{ number_format(($item->total_hours_difference / 4) * 100, 2) }}</span>
                                                        @break
                                                        @case(6)
                                                            <span>{{ number_format(($item->total_hours_difference / 7) * 100, 2) }}</span>
                                                        @break
                                                        @case(7)
                                                            <span>{{ number_format(($item->total_hours_difference / 6) * 100, 2) }}</span>
                                                        @break
                                                        @case(8)
                                                            <span>{{ number_format(($item->total_hours_difference / 7) * 100, 2) }}</span>
                                                        @break
                                                        @case(9)
                                                            <span>{{ number_format(($item->total_hours_difference / 6) * 100, 2) }}</span>
                                                        @break
                                                        @case(10)
                                                            <span>{{ number_format(($item->total_hours_difference / 4) * 100, 2) }}</span>
                                                        @break
                                                        @default
                                                            <span>{{ number_format(($item->total_hours_difference / 8) * 100, 2) }}</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                
                                                <td>
                                                    @switch ($item->user_type)
                                                        @case(3)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 4) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(4)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 6) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(5)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 4) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(6)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 7) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(7)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 6) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(8)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 7) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(9)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 6) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @case(10)
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 4) * 100, 2);
                                                            @endphp
                                                        @break
                                                        @default
                                                            @php
                                                                $remark = number_format(($item->total_hours_difference / 8) * 100, 2);
                                                            @endphp
                                                        @break
                                                    @endswitch
                                                
                                                    @if ($remark >= 90)
                                                        <span>Excellent</span>
                                                    @elseif($remark >= 75 && $remark < 90)
                                                        <span>Good</span>
                                                    @elseif($remark >= 50 && $remark < 75)
                                                        <span>Weak</span>
                                                    @elseif($remark >= 35 && $remark < 50)
                                                        <span>Bad</span>
                                                    @else
                                                        <span>Very Bad</span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab17">
                            <div class="row d-flex justify-content-end">
                                <div>
                                    <label>From Date</label>
                                    <input class="form-control" type="date" id="from_date">
                                </div>
                                <div>
                                    <label>To Date</label>
                                    <input class="form-control" type="date" id="to_date">
                                </div>
                                <div>
                                    <label>.</label>
                                    <button class="btn-sm btn-info form-control" onclick="getOverallData()">Filter</button>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">

                                <table id="table2" class="table w-100 thead-primary data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Hours</th>
                                            <th>Percentage</th>
                                            <th>Remark</th>

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

    </div>
</div>
@include('ui.footer')
<script>
    // $(function() {
    //     var table = $('.data-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         dom: 'lBfrtip',
    //         lengthMenu: [
    //             [10, 25, 50, -1],
    //             [10, 25, 50, 'All'],
    //         ],
    //         ajax: "{{ route('user-activity') }}",

    //         columns: [{
    //                 data: 'user_name',
    //                 name: 'user_name',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },
    //             {
    //                 data: 'user_type',
    //                 name: 'user_type',
    //                 render: function(data) {

    //                     if (data == Number(
    //                             "{{ config('global.a') }}")) {
    //                         return "<span class='badge bg-info me-1 text-white'>Admin</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.sm') }}")) {
    //                         return "<span class='badge bg-info me-1 text-white'>Sales Manager</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.om') }}")) {
    //                         return "<span class='badge bg-warning me-1 text-white'>Operation Manager</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.fm') }}")) {
    //                         return "<span class='badge bg-success me-1 text-white'>Franchise Manager</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.se') }}")) {
    //                         return "<span class='badge bg-secondary me-1 text-white'>Sales Executive</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.oe') }}")) {
    //                         return "<span class='badge bg-danger me-1 text-white'>Operation Executive</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.fe') }}")) {
    //                         return "<span class='badge bg-success me-1 text-white'>Franchise Partner</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.oa') }}")) {
    //                         return "<span class='badge bg-success me-1 text-white'>Operation Assistant</span>"
    //                     }
    //                     if (data == Number(
    //                             "{{ config('global.hr') }}")) {
    //                         return "<span class='badge bg-success me-1 text-white'>HR</span>"
    //                     }

    //                 },
    //                 "searchable": true,
    //                 "orderable": false,
    //             },
    //             {
    //                 data: 'first_login_time',
    //                 name: 'first_login_time',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },
    //             {
    //                 data: 'total_hours_difference',
    //                 name: 'total_hours_difference',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },
    //             {
    //                 data: 'percentages',
    //                 name: 'percentages',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },
    //             {
    //                 data: 'remark',
    //                 name: 'remark',
    //                 "searchable": true,
    //                 "orderable": false,
    //             },





    //         ]
    //     });

    // });

    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: "{{ route('user-activity-overall') }}",

            columns: [{
                    data: 'user_name',
                    name: 'user_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'user_type',
                    name: 'user_type',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.a') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Admin</span>"
                        }
                        if (data == Number(
                                "{{ config('global.sm') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Sales Manager</span>"
                        }
                        if (data == Number(
                                "{{ config('global.om') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Operation Manager</span>"
                        }
                        if (data == Number(
                                "{{ config('global.fm') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Franchise Manager</span>"
                        }
                        if (data == Number(
                                "{{ config('global.se') }}")) {
                            return "<span class='badge bg-secondary me-1 text-white'>Sales Executive</span>"
                        }
                        if (data == Number(
                                "{{ config('global.oe') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>Operation Executive</span>"
                        }
                        if (data == Number(
                                "{{ config('global.fe') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Franchise Partner</span>"
                        }
                        if (data == Number(
                                "{{ config('global.oa') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Operation Assistant</span>"
                        }
                        if (data == Number(
                                "{{ config('global.hr') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>HR</span>"
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'total_hours_difference',
                    name: 'total_hours_difference',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'percentages',
                    name: 'percentages',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'remark',
                    name: 'remark',
                    "searchable": true,
                    "orderable": false,
                },





            ]
        });

    });


    function getOverallData() {
        var from_date = document.getElementById("from_date").value
        var to_date = document.getElementById("to_date").value

        console.log(from_date);
        console.log(to_date);

        $('.data-table').DataTable().destroy();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: {
                url: "{{ route('get-overall-user-activity') }}",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                },
            },

            columns: [{
                    data: 'user_name',
                    name: 'user_name',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'user_type',
                    name: 'user_type',
                    render: function(data) {

                        if (data == Number(
                                "{{ config('global.a') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Admin</span>"
                        }
                        if (data == Number(
                                "{{ config('global.sm') }}")) {
                            return "<span class='badge bg-info me-1 text-white'>Sales Manager</span>"
                        }
                        if (data == Number(
                                "{{ config('global.om') }}")) {
                            return "<span class='badge bg-warning me-1 text-white'>Operation Manager</span>"
                        }
                        if (data == Number(
                                "{{ config('global.fm') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Franchise Manager</span>"
                        }
                        if (data == Number(
                                "{{ config('global.se') }}")) {
                            return "<span class='badge bg-secondary me-1 text-white'>Sales Executive</span>"
                        }
                        if (data == Number(
                                "{{ config('global.oe') }}")) {
                            return "<span class='badge bg-danger me-1 text-white'>Operation Executive</span>"
                        }
                        if (data == Number(
                                "{{ config('global.fe') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Franchise Partner</span>"
                        }
                        if (data == Number(
                                "{{ config('global.oa') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>Operation Assistant</span>"
                        }
                        if (data == Number(
                                "{{ config('global.hr') }}")) {
                            return "<span class='badge bg-success me-1 text-white'>HR</span>"
                        }

                    },
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'total_hours_difference',
                    name: 'total_hours_difference',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'percentages',
                    name: 'percentages',
                    "searchable": true,
                    "orderable": false,
                },
                {
                    data: 'remark',
                    name: 'remark',
                    "searchable": true,
                    "orderable": false,
                },





            ]
        });
    }
</script>
