{{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            @livewire('admin.components.status-box-component')
            <div class="col-3 col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4> Total Agents: {{$agents_counts}} <br>
                            Active: {{ $active_agents_counts }} <br>
                            Inactive: {{ $inactive_agents_counts }}</h4>

                            {{-- <h4> Total Agents: 30 <br>
                                Active: 25 <br>
                                Inactive: 5</h4> --}}

                    </div>
                    <div class="card-header">
                        <h4>Booking Share</h4>
                    </div>
                    <div class="card-body" wire:ignore>
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Booking Inquiries v/s Actual Bookings</h4>
                    </div>
                    <div class="card-body" wire:ignore>
                        <canvas id="myChart" height="158"></canvas>
                    </div>
                </div>
            </div>
            @livewire('admin.components.top-package-component')
        </div>
        <div class="row">
            @livewire('admin.components.customer-feedback-component')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Booking By Service Type</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" height="158"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                @livewire('admin.components.invoices-component')
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Packages By Service</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myDonutChart" height="335"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('extra_js')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script>
        $(function() {
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json(array_values($inqBookings['months'])),
                    datasets: [{
                            label: 'Booking Inquiries',
                            data: @json($inqBookings['inquiries']),
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
                                // stepSize: 10000,
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
                type: 'bar',
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
                        },
                        {
                            label: 'Ziyarat',
                            data: @json($bookingByServiceType['data']['ziarat']),
                            backgroundColor: 'rgba(255, 206, 86, 0.5)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ]
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
                            // 'rgba(153, 102, 255, 0.5)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
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

            var ctx = document.getElementById("myChart4").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: @json($bookingShare['data']),
                        backgroundColor: [
                            '#191d21',
                            '#63ed7a',
                            '#ffa426',
                            '#fc544b',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: @json($bookingShare['labels']),
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        display: false,
                    },
                }
            });
        })
    </script>
@endpush
