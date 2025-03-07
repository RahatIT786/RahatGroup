<div>
    <section class="section pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-travel-boxes">
                        <div id="desc-tabs" class="desc-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="{{ route('customer.dashboard') }}" class="active">
                                        <i class="fas fa-fire"></i>
                                        Dashboard
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="#">
                                        <i class="fas fa-book"></i>
                                        My Bookings
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="#">
                                        <i class="fas fa-rupee-sign"></i>
                                        Accounts
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#">
                                        <i class="fas fa-calendar-check"></i>
                                        Travel Calendar
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#">
                                        <i class="fas fa-handshake"></i>
                                        Sales
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#" aria-controls="profile">
                                        <i class="fas fa-user-cog"></i>
                                        My Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PACKAGES --}}
    {{-- @livewire('agent.components.popular-packages-component') --}}
</div>
{{-- @push('extra_js')
    <script src="{{ asset('vendors\chart.js\Chart.min.js') }}"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json(array_values($inqBookings['months'])),
                datasets: [{
                        label: 'Booking Quotes',
                        data: @json($inqBookings['quotes']),
                        borderWidth: 2,
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    {
                        label: 'Actual Bookings',
                        data: @json($inqBookings['bookings']),
                        borderWidth: 2,
                        backgroundColor: 'rgba(254,86,83,.7)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                    }
                ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            // stepSize: 1500,
                            callback: function(value, index, values) {
                                return value;
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
            }
        });

        var ctx = document.getElementById("myBarChart").getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: @json(array_values($bookingByServiceType['months'])),
                datasets: [{
                    label: 'Hajj',
                    data: @json($bookingByServiceType['data']['hajj']),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Umrah',
                    data: @json($bookingByServiceType['data']['umrah']),
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Ramzan',
                    data: @json($bookingByServiceType['data']['ramzan']),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Ziyarat',
                    data: @json($bookingByServiceType['data']['ziarat']),
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                }
            }
        });

        var ctx = document.getElementById('myDonutChart').getContext('2d');
        var doughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($packagesByServiceType['service_type_names']),
                datasets: [{
                    label: 'Dataset 1',
                    data: @json($packagesByServiceType['counts']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 50
            }
        });

        var ctx = document.getElementById('myPlotChart').getContext('2d');
        var doughnutChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json(array_values($paymentsByMonth['months'])),
                datasets: [{
                    label: 'Payment Amount',
                    data: @json($paymentsByMonth['data']),
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return '₹' + value; // Add ₹ to the y-axis values
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                console.log(tooltipItem);

                                return '₹' + tooltipItem.raw; // Add ₹ to the tooltip values
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush --}}

@push('extra_css')
    <style>
        .single-travel-boxes {
            background: #fff;
            margin-bottom: 50px;
        }

        .tab-para p {
            font-size: 24px;
        }

        /* .desc-tabs */
        .desc-tabs {
            border: transparent;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .1);
        }

        .desc-tabs .nav-tabs {
            justify-content: space-between;
        }

        .desc-tabs .nav-tabs>li>a.active {
            color: #fff;
            background: #f66962;
            font-size: 20px;
            font-weight: 500;
            text-transform: capitalize;
            -webkit-transition: .5s;
            -moz-transition: .5s;
            -ms-transition: .5s;
            -o-transition: .5s;
            transition: .5s;
        }

        .desc-tabs .nav-tabs>li.active>a:focus,
        .desc-tabs .nav-tabs>li.active>a:hover {
            color: #565a5c;
            text-decoration: none;
        }

        .desc-tabs .nav-tabs>li>a {
            color: #f66962;
            display: inline-block;
            text-align: center;
            background: #fff;
            font-size: 20px;
            font-weight: 500;
            text-transform: capitalize;
            padding: 15px 35px 17px 46px;
            border: 0;
            -webkit-transition: .5s;
            -moz-transition: .5s;
            -ms-transition: .5s;
            -o-transition: .5s;
            transition: .5s;
        }



        .desc-tabs .nav-tabs>li>a>i {
            padding-right: 6px;
        }

        /* .desc-tabs */
        /*===ab-select-box===*/
        .tab-para {
            padding: 43px 42px 24px;
        }

        .single-tab-select-box h2 {
            color: #565a5c;
            font-size: 20px;
            font-weight: 500;
            text-transform: capitalize;
            margin-bottom: 17px;
        }

        /*travel-select-icon*/

        /*select*/

        /*.travel-select-icon .form-control*/
        /*.trip-circle*/
        .trip-circle {
            display: flex;
            margin-bottom: 17px;
        }

        .single-trip-circle {
            display: flex;
        }

        .single-trip-circle:nth-child(2) {
            display: flex;
            margin-left: 42px;
        }

        .single-trip-circle input[type="radio"] {
            display: none;
        }

        .single-trip-circle input[type="radio"]+label {
            color: #565a5c;
            font-size: 16px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            text-transform: capitalize;
            margin-bottom: 17px;
            margin-left: 0px;
        }

        .single-trip-circle input[type="radio"]+label span.round-boarder {
            display: inline-block;
            width: 15px;
            height: 15px;
            margin: -1px 4px 0 0;
            vertical-align: middle;
            cursor: pointer;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .single-trip-circle input[type="radio"]+label span.round-boarder1 {
            display: inline-block;
            width: 9px;
            height: 9px;
            margin: -13px 0px 0 1px;
            vertical-align: middle;
            cursor: pointer;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .single-trip-circle input[type="radio"]+label span.round-boarder {
            border: 2px solid #aaa;
        }

        .single-trip-circle input[type="radio"]+label span.round-boarder1 {
            border: 1px solid #fff;
            background-color: #fff;
        }

        .single-trip-circle input[type="radio"]:checked+label span.round-boarder1 {
            background-color: #f66962;
        }

        .single-trip-circle input[type="radio"]+label span.round-boarder1,
        .single-trip-circle input[type="radio"]:checked+label span.round-boarder1 {
            -webkit-transition: background-color 0.4s linear;
            -o-transition: background-color 0.4s linear;
            -moz-transition: background-color 0.4s linear;
            transition: background-color 0.4s linear;
        }

        /*.trip-circle*/
        /* filter */
        .travel-budget {
            margin-top: 38px;
        }

        .travel-budget h3 {
            color: #565a5c;
            font-size: 20px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            text-transform: capitalize;
        }


        /* .travel-btn */
        .about-view {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f66962;
            border: 1px solid #f66962;
            width: 200px;
            height: 60px;
            white-space: nowrap;
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            border-radius: 5px;
            box-shadow: 0 5px 20px rgba(14, 15, 18, .2);
            -webkit-transition: 0.5s ease-in-out;
            -moz-transition: 0.5s ease-in-out;
            -ms-transition: 0.5s ease-in-out;
            -o-transition: 0.5s ease-in-out;
            transition: 0.5s ease-in-out;
        }

        .about-view.travel-btn {
            width: 180px;
            margin-right: 15px;
        }

        .about-view:hover {
            color: #fff;
            background: #f66962;
            box-shadow: 0 5px 20px rgba(14, 15, 18, .7);
            border: 1px solid #f66962;
        }

        .line-chart {
            animation: fadeIn 600ms cubic-bezier(.57, .25, .65, 1) 1 forwards;
            opacity: 0;
            max-width: 640px;
            width: 100%;
        }

        .aspect-ratio {
            height: 0;
            padding-bottom: 50%; // 495h / 990w
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @media (max-width: 1400px) {
            .desc-tabs .nav-tabs>li>a {
                padding: 15px 20px 15px 20px;
                font-size: 16px;
            }

            .desc-tabs .nav-tabs>li>a.active {
                font-size: 16px;
            }
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
            background-color: #fff;
            border-radius: 3px;
            border: none;
            position: relative;
            margin-bottom: 30px;
        }

        .card.card-statistic-1,
        .card.card-statistic-2 {
            display: inline-block;
            width: 100%;
        }

        .card.card-statistic-1 .card-icon,
        .card.card-statistic-2 .card-icon {
            width: 80px;
            height: 80px;
            margin: 10px;
            border-radius: 3px;
            line-height: 94px;
            text-align: center;
            float: left;
            margin-right: 15px;
        }

        .card.card-statistic-1 .card-icon {
            line-height: 90px;
        }

        .card.card-statistic-1 .card-icon .ion,
        .card.card-statistic-1 .card-icon .fas,
        .card.card-statistic-1 .card-icon .far,
        .card.card-statistic-1 .card-icon .fab,
        .card.card-statistic-1 .card-icon .fal,
        .card.card-statistic-2 .card-icon .ion,
        .card.card-statistic-2 .card-icon .fas,
        .card.card-statistic-2 .card-icon .far,
        .card.card-statistic-2 .card-icon .fab,
        .card.card-statistic-2 .card-icon .fal {
            font-size: 22px;
            color: #fff;
        }

        .bg-temple {
            background-color: #ff793f !important;
        }

        .bg-itadori {
            background-color: #b33771 !important;
        }

        .bg-saitama {
            background-color: #EAB543 !important;
        }

        .bg-trunks {
            background-color: #1b9cfc !important;
        }

        .bg-deku {
            background-color: #3c6382 !important;
        }

        .bg-beerus {
            background-color: #2c2c54 !important;
        }

        .bg-instinct {
            background-color: #bdc3c7 !important;
        }

        .bg-ego {
            background-color: #8e44ad !important;
        }

        .card.card-statistic-1 .card-header,
        .card.card-statistic-2 .card-header {
            border-color: transparent;
            padding-bottom: 0;
            height: auto;
            min-height: auto;
            display: block;
        }

        .card.card-statistic-1 .card-header,
        .card.card-statistic-2 .card-header {
            padding-bottom: 0;
            padding-top: 25px;
        }

        .card.card-statistic-1 .card-body,
        .card.card-statistic-2 .card-body {
            padding-top: 0;
        }

        .card.card-statistic-1 .card-body,
        .card.card-statistic-2 .card-body {
            font-size: 26px;
            font-weight: 700;
            color: #34395e;
            padding-bottom: 0;
        }

        .card.card-statistic-1 .card-body {
            font-size: 20px;
        }

        .card.card-statistic-1 .card-header h4,
        .card.card-statistic-2 .card-header h4 {
            line-height: 1.2;
            color: #000000;
        }

        .card.card-statistic-1 .card-header h4,
        .card.card-statistic-2 .card-header h4 {
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .card.card-statistic-1 .card-header h4 {
            margin-bottom: 0;
        }
    </style>
@endpush
