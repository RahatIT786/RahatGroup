<div class="section-body">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4>All Enquiries</h4>
                </div> --}}
                <div class="card-body" style="font-size: 12px;">
                    <div class="row form-row row-cols-2 row-cols-md-8">
                        <div class="col mb-2">
                            <a href="{{ route('admin.hotelInquary.index') }}">
                                <button class="btn btn-success btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Hotel
                                        Enquiry</span><span>{{ $hotelTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.umrah.index') }}">
                                <button class="btn btn-info btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Umrah
                                        Enquiry</span><span>{{ $umrahTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.complaintBox.index') }}">
                                <button class="btn btn-danger btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Complain
                                        Enquiry</span><span>{{ $complaintBoxTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.manageEnquiry.index') }}">
                                <button class="btn btn-warning btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Manage
                                        Enquiry</span><span>{{ $enquiryTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.foodenquiry.index') }}">
                                <button class="btn btn-primary btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Food
                                        Enquiry</span><span>{{ $foodTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.touristVisa.index') }}">
                                <button class="btn btn-success btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Tourist
                                        Visa</span><span>{{ $touristVisaTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.enquiryforex.index') }}">
                                <button class="btn btn-info btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Forex
                                        Enquiry</span><span>{{ $forexTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.serviceEnquiry.index') }}">
                                <button class="btn btn-danger btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Service
                                        Enquiry</span><span>{{ $serviceTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.laundry.index') }}">
                                <button class="btn btn-warning btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Laundry
                                        Enquiry</span><span>{{ $laundryTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.hajjKitEnquiry.index') }}">
                                <button class="btn btn-primary btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">HajjKit
                                        Enquiry</span><span>{{ $hajjKitTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.trnsportEnquiry.index') }}">
                                <button class="btn btn-success btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Transport
                                        Enquiry</span><span>{{ $transportTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.callusback.index') }}">
                                <button class="btn btn-info btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Request Call Us
                                        Back</span><span>{{ $callUsBackTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.shoppingenquiry.index') }}">
                                <button class="btn btn-danger btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Shopping
                                        Enquiry</span><span>{{ $shoppingTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.bookingEnquiry.index') }}">
                                <button class="btn btn-warning btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Booking
                                        Enquiries</span><span>{{ $bookingTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.tourcallusback.index') }}">
                                <button class="btn btn-primary btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Tour Call Us
                                        Back</span><span>{{ $tourCallUsBackTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.publicationEnq.index') }}">
                                <button class="btn btn-success btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Publication
                                        Enquiry</span><span>{{ $publicationEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.feedback.index') }}">
                                <button class="btn btn-info btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Feedback</span><span>{{ $feedBackTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.enquiryassistant.index') }}">
                                <button class="btn btn-danger btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">Assistant
                                        Enquiry</span><span>{{ $assistantTotalEnquiry }}</span></button>
                            </a>
                        </div>
                        <div class="col mb-2">
                            <a href="{{ route('admin.pnrEnquiry') }}">
                                <button class="btn btn-warning btn-sm menu-title w-100 font-weight-bold"><span
                                        class="mb-2 d-block">PNR
                                        Enquiry</span><span>{{ $pnrTotalEnquiry }}</span></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
