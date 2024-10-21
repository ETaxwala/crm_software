@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">
        {{-- <div class="col-md-12">
        <h1 class="db-header-title">Welcome, {{Session::get('user_name')}}</h1>
      </div> --}}
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 3.2%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Sells Graph</strong></span>
                        <h2>$8,451</h2>
                    </div>
                </div>
                <canvas id="line-chart"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-red"><i class="material-icons">arrow_downward</i> 4.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Total Visitors</strong></span>
                        <h2>3,973</h2>
                    </div>
                </div>
                <canvas id="line-chart-2"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 12.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>New Users</strong></span>
                        <h2>7,333</h2>
                    </div>
                </div>
                <canvas id="line-chart-3"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                <span class="ms-chart-label bg-red"><i class="material-icons">arrow_upward</i> 9.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Total Orders</strong></span>
                        <h2>48,973</h2>
                    </div>
                </div>
                <canvas id="line-chart-4"></canvas>
            </div>
        </div>


        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header new">
                    <h6>Monthly Revenue</h6>
                    <select class="form-control new" id="exampleSelect">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="1">June</option>
                        <option value="2">July</option>
                        <option value="3">August</option>
                        <option value="4">September</option>
                        <option value="5">October</option>
                        <option value="4">November</option>
                        <option value="5">December</option>
                    </select>
                </div>
                <div class="ms-panel-body"> <span class="progress-label"> <strong>week 1</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div> <span class="progress-label"> <strong>week 2</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100">50%</div>
                    </div> <span class="progress-label"> <strong>week 3</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div> <span class="progress-label"> <strong>week 4</strong> </span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100">40%</div>
                    </div>
                </div>
            </div>
        </div>





        <!-- Recent Support Tickets -->
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel ms-panel-fh">
                <div class="ms-panel-header">
                    <div class="d-flex justify-content-between">
                        <div class="align-self-center align-left">
                            <h6>Recent Support Tickets</h6>
                        </div>
                        <a href="#" class="btn btn-primary"> View All</a>
                    </div>
                </div>
                <div class="ms-panel-body p-0">
                    <ul class="ms-list ms-feed ms-twitter-feed ms-recent-support-tickets">
                        <li class="ms-list-item">
                            <a href="#" class="media clearfix">
                                <img src="https://via.placeholder.com/270x270" class="ms-img-round ms-img-small"
                                    alt="This is another feature">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">Lorem ipsum dolor</h6>
                                        <span class="badge badge-success"> Open </span>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i> February 24,
                                        2019</span>
                                    <p class="d-block"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                        luctus lectus a facilisis bibendum. Duis quis convallis sapien ... </p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="ms-feed-controls">
                                            <span>
                                                <i class="material-icons">chat</i> 16
                                            </span>
                                            <span>
                                                <i class="material-icons">attachment</i> 3
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="ms-list-item">
                            <a href="#" class="media clearfix">
                                <img src="https://via.placeholder.com/270x270" class="ms-img-round ms-img-small"
                                    alt="This is another feature">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">Lorem ipsum dolor</h6>
                                        <span class="badge badge-success"> Open </span>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i> February 24,
                                        2019</span>
                                    <p class="d-block"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                        luctus lectus a facilisis bibendum. Duis quis convallis sapien ... </p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="ms-feed-controls">
                                            <span>
                                                <i class="material-icons">chat</i> 11
                                            </span>
                                            <span>
                                                <i class="material-icons">attachment</i> 1
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="ms-list-item">
                            <a href="#" class="media clearfix">
                                <img src="https://via.placeholder.com/270x270" class="ms-img-round ms-img-small"
                                    alt="This is another feature">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="ms-feed-user mb-0">Lorem ipsum dolor</h6>
                                        <span class="badge badge-danger"> Closed </span>
                                    </div>
                                    <span class="my-2 d-block"> <i class="material-icons">date_range</i> February 24,
                                        2019</span>
                                    <p class="d-block"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                        luctus lectus a facilisis bibendum. Duis quis convallis sapien ... </p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="ms-feed-controls">
                                            <span>
                                                <i class="material-icons">chat</i> 21
                                            </span>
                                            <span>
                                                <i class="material-icons">attachment</i> 5
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Recent Support Tickets -->

    </div>
</div>

@include('ui.footer')
