@include('ui.header')


<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget bg-gradient-primary">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 3.2%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Toatal Sales</strong></span>
                        <h2>78, 512</h2>
                    </div>
                </div>
                <canvas id="line-chart-1"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget bg-gradient-secondary">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 4.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Total Customers</strong></span>
                        <h2>3,973</h2>
                    </div>
                </div>
                <canvas id="line-chart-2"></canvas>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget bg-gradient-success">
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
            <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget bg-gradient-danger">
                <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 9.5%</span>
                <div class="ms-card-body media">
                    <div class="media-body">
                        <span class="black-text"><strong>Total Orders</strong></span>
                        <h2>48,973</h2>
                    </div>
                </div>
                <canvas id="line-chart-4"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Total Sale</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Line Chart</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Pie Chart</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="pie-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Polar Chart</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="polar-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Dougnut Chart</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="doughnut-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Grouped Bar Chart</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="bar-chart-grouped"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Mixed Chart</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="mixed-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@include('ui.footer')
<script>
    (function($) {
        'use strict';
        //Pie Chart
        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
                labels: ["Hunger House", "Food Lounge", "Delizious", "Red Resturant", "Hunger Lounge"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#ff0018", "#f7b11b", "#ff6c60", "#8663e1", "#08bf6f"],
                    data: [2478, 5267, 734, 784, 433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predicted Resturant Ratings (millions) in 2050'
                }
            }
        });



        // Bar chart
        var barChart = new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "sa",
                    backgroundColor: ["#ff0018", "#f7b11b", "#ff6c60", "#8663e1", "#08bf6f"],
                    data: [4000, 5267, 1734, 3384, 1433]
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2024'
                }
            }
        });

        //Line Chart
        var ctx = document.getElementById('line-chart').getContext("2d");
        var gradientStroke = ctx.createLinearGradient(0, 0, 0, 450);
        gradientStroke.addColorStop(0, '#ff0018');

        var gradientFill = ctx.createLinearGradient(0, 0, 0, 450);
        gradientFill.addColorStop(0, "rgba(53,127,250,0.4)");
        gradientFill.addColorStop(1, "rgba(255,255,255,0)");

        // all data
        var data_1 = [1800, 1600, 2300, 2800, 3600, 2900, 3000, 3800, 3600];
        var data_2 = [4100, 3800, 3200, 3400, 2700, 2600, 3300, 3000, 2900];
        var labels = ["Jan-11", "Jan-12", "Jan-13", "Jan-14", "Jan-15", "Jan-16", "Jan-17", "Jan-18", "Jan-19"];

        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Data",
                    borderColor: gradientStroke,
                    pointBorderColor: gradientStroke,
                    pointBackgroundColor: gradientStroke,
                    pointHoverBackgroundColor: gradientStroke,
                    pointHoverBorderColor: gradientStroke,
                    pointBorderWidth: 1,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 2,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 1,
                    data: data_1
                }]
            },
            options: {
                legend: {
                    display: false,
                    position: "bottom"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 200,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });




        //Polar Chart
        new Chart(document.getElementById("polar-chart"), {
            type: 'polarArea',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#ff0018", "#f7b11b", "#ff6c60", "#8663e1", "#08bf6f"],
                    data: [2478, 5267, 734, 784, 433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });

        //Doughnut Chart
        new Chart(document.getElementById("doughnut-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#ff0018", "#f7b11b", "#ff6c60", "#8663e1", "#08bf6f"],
                    data: [2478, 5267, 734, 784, 433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });

        //Group Bar Chart
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: ["1900", "1950", "1999", "2050"],
                datasets: [{
                    label: "Africa",
                    backgroundColor: "#3e95cd",
                    data: [133, 221, 783, 2478]
                }, {
                    label: "Europe",
                    backgroundColor: "#8e5ea2",
                    data: [408, 547, 675, 734]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                }
            }
        });

        //Mixed Chart
        new Chart(document.getElementById("mixed-chart"), {
            type: 'bar',
            data: {
                labels: ["1900", "1950", "1999", "2050"],
                datasets: [{
                    label: "Europe",
                    type: "line",
                    borderColor: "#8e5ea2",
                    data: [408, 547, 675, 734],
                    fill: false
                }, {
                    label: "Africa",
                    type: "line",
                    borderColor: "#3e95cd",
                    data: [133, 221, 783, 2478],
                    fill: false
                }, {
                    label: "Europe",
                    type: "bar",
                    backgroundColor: "#ff6c60",
                    data: [408, 547, 675, 734],
                }, {
                    label: "Africa",
                    type: "bar",
                    backgroundColor: "#f7b11b",
                    backgroundColorHover: "#3e95cd",
                    data: [133, 221, 783, 2478]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions): Europe & Africa'
                },
                legend: {
                    display: false
                }
            }
        });

    })(jQuery);
</script>
