<div class="content-wrapper">
    <div class="row">
        <!-- Total Booking Requests -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Total Booking Requests</p>   
                    <hr>
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-book icon-lg" style="color: #4e73df; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{ $tot_booking_requests }}</h3>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
          <!-- Agent Wallet -->
          <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Total Agent Wallet</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-wallet icon-lg" style="color: #4e73df; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">₹ 0.00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Agents -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Total Agents</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-account icon-lg" style="color: #ffbf36; font-size: 2rem;"></i>

                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$agents_counts}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Users -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Total Users</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-account icon-lg" style="color: #dc3545; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$user_count}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Confirmed Bookings -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Confirmed Bookings</p>  
                    <hr>
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-book-multiple-variant icon-lg" style="color: #4e73df; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{ $tot_confirmed_bookings }}</h3>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <!-- Pending Bookings -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Pending Bookings</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-book-open icon-lg" style="color: #4e73df; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$tot_Pending_bookings}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Active Agents -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Active Agents</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-account-check icon-lg" style="color: #ffbf36; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$active_agents_counts}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Active users -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Active Users</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-account-check icon-lg" style="color: #dc3545; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$active_user_count}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmed Payments -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Confirmed Payments</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-cash icon-lg" style="color: #4e73df; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">₹ {{number_format($confirmed_payments,2)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Payments -->
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Pending Payments</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-cash-multiple icon-lg" style="color: #4e73df; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">₹ {{number_format($pending_payments,2)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

       
        
        
       
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Non Active Agents</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-account-off icon-lg" style="color: #ffbf36; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$inactive_agents_counts}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
       
        <div class="col-3 grid-margin stretch-card">
            <div class="card" style="border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="text-align: left;">
                    <p class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #6c757d;">Non Active Users</p>  
                    <hr> 
                    <div class="row">
                        <div class="col-2">
                            <i class="mdi mdi-account-off icon-lg" style="color: #dc3545; font-size: 2rem;"></i>
                        </div>
                        <div class="col-10">
                            <h3 class="pt-2" style="padding-top: 1.5rem; font-size: 1.4rem; color: #343a40;">{{$inactive_user_count}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Booking By Service</h4>
                    <canvas id="doughnutChart" height="113"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pacakge By Service</h4>
                    <canvas id="pieChart" height="113"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">      
       
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Booking By Service Type</h4>
                <canvas id="barChartBooking"></canvas>
            </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Monthly Sales Figure By Service Type</h4>
                <canvas id="barChartSales"></canvas>
            </div>
            </div>
        </div>

        <div class="col-lg-6 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enquiry Management Review</h4>
                    <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Enquiry Type
                                    </th>
                                    <th>
                                        Progress
                                    </th>
                                    <th>
                                        Total Enquiry
                                    </th>
                                    <th>
                                        Accepted
                                    </th>

                                    <th>
                                        Rejected
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    
                                    <td>
                                        Customized Umrah
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $acceptedEnquiryUmrah }}%;"
                                                aria-valuenow="{{ $acceptedEnquiryUmrah }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>


                                        {{-- <div class="text-center mt-1">
                                            {{ $acceptedEnquiryUmrah }}%
                                        </div> --}}
                                    </td>

                                    <td>
                                        {{ $totalEnquiryUmrah }}
                                    </td>
                                    <td>
                                        {{ $acceptedEnquiryUmrah }}
                                    </td>

                                    <td>
                                        {{ $rejectedEnquiryUmrah }}
                                    </td>
                                </tr>
                                <tr>
                                   
                                    <td>
                                        Tourist Visa Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width: {{ $totalacceptetouristvisa }}%;"
                                                aria-valuenow="{{ $totalacceptetouristvisa }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $totaltouristvisa }}
                                    </td>
                                    <td>
                                        {{ $totalacceptetouristvisa }}
                                    </td>

                                    <td>
                                        {{ $rejectedtouristvisa }}
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        Tour Call Us Back
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $totaltouracceptecallusback }}%;"
                                                aria-valuenow="{{ $totaltouracceptecallusback }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $totaltourcallusback }}
                                    </td>
                                    <td>
                                        {{ $totaltouracceptecallusback }}
                                    </td>
                                    <td>
                                        {{ $rejectedtourcallusback }}
                                    </td>
                                </tr>
                                <tr>
                                  
                                    <td>
                                        Call Us Back
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $totalacceptecallusback }}%;"
                                                aria-valuenow="{{ $totalacceptecallusback }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $totalcallusback }}
                                    </td>
                                    <td>
                                        {{ $totalacceptecallusback }}
                                    </td>
                                    <td>
                                        {{ $rejectedcallusback }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Publication Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width: {{ $acceptedCount }}%;"
                                                aria-valuenow="{{ $acceptedCount }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $totalEnquiries }}
                                    </td>
                                    <td>
                                        {{ $acceptedCount }}
                                    </td>

                                    <td>
                                        {{ $rejectedCount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Hotel Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ $acceptedhotelenquiries }}%;"
                                                aria-valuenow="{{ $acceptedhotelenquiries }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $hotelenquiries }}
                                    </td>
                                    <td>
                                        {{ $acceptedhotelenquiries }}
                                    </td>
                                    <td>
                                        {{ $rejecthotelenquiries }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Forex Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $acceptedforexenquiry }}%;"
                                                aria-valuenow="{{ $acceptedforexenquiry }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $forexenquiry }}
                                    </td>
                                    <td>
                                        {{ $acceptedforexenquiry }}
                                    </td>
                                    <td>
                                        {{ $rejectforexenquiry }}
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        Laundry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $totalacceptelaundry }}%;"
                                                aria-valuenow="{{ $totalacceptelaundry }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $totallaundry }}
                                    </td>
                                    <td>
                                        {{ $totalacceptelaundry }}
                                    </td>

                                    <td>
                                        {{ $rejectedlaundry }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Booking Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $acceptedbookingenquiry }}%;"
                                                aria-valuenow="{{ $acceptedbookingenquiry }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $bookingenquiry }}
                                    </td>
                                    <td>
                                        {{ $acceptedbookingenquiry }}
                                    </td>
                                    <td>
                                        {{ $rejectbookingenquiry }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Shopping
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ $acceptedshoppingenquiry }}%;"
                                                aria-valuenow="{{ $acceptedshoppingenquiry }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $shoppingenquiry }}
                                    </td>
                                    <td>
                                        {{ $acceptedshoppingenquiry }}
                                    </td>
                                    <td>
                                        {{ $rejectshoppingenquiry }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Umrah & Hajj Kit Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width: {{ $acceptedhajjKitenquiry }}%;"
                                                aria-valuenow="{{ $acceptedhajjKitenquiry }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $hajjKitenquiry }}
                                    </td>
                                    <td>
                                        {{ $acceptedhajjKitenquiry }}
                                    </td>
                                    <td>
                                        {{ $rejecthajjKitenquiry }}
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        Food Enquiry
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $acceptedfoodenquiry }}%;"
                                                aria-valuenow="{{ $acceptedfoodenquiry }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $foodenquiry }}
                                    </td>
                                    <td>
                                        {{ $acceptedfoodenquiry }}
                                    </td>
                                    <td>
                                        {{ $rejectfoodenquiry }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Top Five Packages</h4>
                    <!-- <p class="card-description">
                    Add class <code>.table-hover</code>
                    </p> -->
                    <div class="table-responsive" >
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Package Name</th>
                            <!-- <th>Product</th>
                            <th>Sale</th>
                            <th>Status</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topFivePackages as $key => $topPackage)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$topPackage->name}}</td>
                            <!-- <td>Photoshop</td>
                            <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                            <td><label class="badge badge-danger">Pending</label></td> -->
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
       
    </div>
    <!-- row end -->
</div>


@push('extra_js')
    <script src="{{ asset('js/staff/template.js') }}"></script>
    <script>
        //Bar chart Starts
        // Booking By Service Type Starts
        var bookingbarData = {
            labels: @json(array_values($bookingByServiceType['months'])),
            datasets: [
                {
                    label: 'Hajj',
                    data: @json($bookingByServiceType['data']['hajj']),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                
                {
                   label: 'Umrah',
                    data: @json($bookingByServiceType['data']['umrah']),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ramzan',
                    data: @json($bookingByServiceType['data']['ramzan']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ziyarat',
                    data: @json($bookingByServiceType['data']['ziarat']),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
                
            ]
        };

       

        if ($("#barChartBooking").length) {
            var barChartCanvas = $("#barChartBooking").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: bookingbarData,
                options: barOptions
            });
        }
        // Booking By Service Type Ends

        // Monthly Sales Figures with Service Type Ends
        var barData = {
            labels: @json(array_values($bookingByServiceType['months'])),
            datasets: [
                {
                    label: 'Hajj',
                    data: @json($bookingByServiceType['data']['hajj_sales']),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                
                {
                   label: 'Umrah',
                    data: @json($bookingByServiceType['data']['umrah_sales']),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ramzan',
                    data: @json($bookingByServiceType['data']['ramzan_sales']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ziyarat',
                    data: @json($bookingByServiceType['data']['ziarat_sales']),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
                
            ]
        };

        // Bar chart options
        var barOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true
        };

        if ($("#barChartSales").length) {
            var barChartCanvas = $("#barChartSales").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barData,
                options: barOptions
            });
        }
        // Monthly Sales Figures with Service Type Ends

        //Bar chart Ends

        //Area chart
        var areaData = {
            labels: ["2013", "2014", "2015", "2016", "2017"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            }]
        };

        var areaOptions = {
            plugins: {
                filler: {
                    propagate: true
                }
            }
        }
        if ($("#areaChart").length) {
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
        }


        var doughnutPieData = {
            datasets: [{
                data: @json($packagesByServiceType['counts']),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Hajj',
                'Umrah',
                'Ramzan',
                'Ziarat',
            ]
        };

        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        //Doughnut Chart
        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }


        //Pie chart
          var pieData = {
            datasets: [{
                data: @json($bookingShare),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
           
            labels: [
                'Hajj',
                'Umrah',
                'Ramzan',
                'Ziarat',
            ]
        };

        var pieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        //Pie Chart
        if ($("#pieChart").length) {
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            });
        }


        
    </script>
@endpush
