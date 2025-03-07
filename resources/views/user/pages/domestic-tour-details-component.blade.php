<div>
    <main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
            <div class="container">
            </div>
        </section>
        <section class="detial-headercls">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="banner-title-details">{{ $tours->name }}</div>
                        <div class="banner-sub-title-details">
                            5 days, 4 nights, <span><i class="fa fa-map-marker"></i> {{ $tours->state->name }}
                                ,
                                India</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                 <h6>Category</h6>
                                <select class="custom-select">
                                    <option categoryname="Deluxe" value="3" selected="">Silver</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="startingbox startingbox-right">
                                    <div class="startingbox startingbox-right text-right">
                                        <p class="service_subheading text-right">STARTING FROM</p>
                                        INR <span id="pkgprice_paste2" class="similar_package-price pkgprice_html_274">
                                            16,500</span>
                                        <a class="gotohotel" href="javascript:void(0);">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <span class="service_subheading text-right"> Per Person</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                                <div class="details-btn-box text-right">
                                    <a href="" id=""
                                        class="view-packages-btn-inner sendRateEnuiryPackagetour">Send Enquiry</a>
                                    <a href="#" id="estinamtebtnid"
                                        class="estimate-btn sendRateEnuiryPackagetour">Get Offer</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="detail-sec detail-secbox">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-6 col-12">
                        <div class="galleryslider swiper swiper-gallery">
                            <div class="swiper-wrapper">
                                @foreach($tours->tourImages as $images)
                                <div class="swiper-slide shadow">
                                    <div class="slider_details_wrap">
                                        <img src="{{ asset('storage/domestic_tour_image/' . $images->tour_img) }}"
                                            title="" border="0">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="detail-tabbing-whitesec">
                            <div class="dt-subtitle banner-title-details">Package Includes</div>
                            <div class="mobile_scrolling">
                                <ul class="nav nav-tabs packages-included">
                                    <li class="nav-item package-icons-item">
                                        <a href="javascript:void(0);" onclick="pakagetabFunc(this, 'Hotelstab')"><i
                                                class="flaticon-hotel"></i> <br>Hotels</a>
                                    </li>
                                    <li class="nav-item package-icons-item">
                                        <a href="javascript:void(0);" onclick="pakagetabFunc(this, 'mealstab')"><i
                                                class="flaticon-dinner"></i> <br>Meals</a>
                                    </li>
                                    <li class="nav-item package-icons-item">
                                        <a id="itinerary" href="javascript:void(0);"><i
                                                class="flaticon-terms-and-conditions-1"></i> <br>Itinerary</a>
                                    </li>
                                    <li class="nav-item package-icons-item">
                                        <a id="termscondition" href="javascript:void(0);"><i
                                                class="flaticon-terms-and-conditions"></i> <br>Terms & conditions</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <div id="Hotelstab" class="hidden">
                                    <label class="radio-inline">
                                        <input class="hotelbuttonCategoryStandard" type="radio" name="optradio"
                                            autocomplete="off" checked="">
                                        Standard
                                    </label>
                                    <div class="table-responsive HotelstabDiv HotelstabDivStandard274" style="">
                                        <table class="table tab-title-content-bg table-sm">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="tab-title-txt-cls day-pt">Location</div>
                                                    </th>
                                                    <th>
                                                        <div class="tab-title-txt-cls">Hotel Name</div>
                                                    </th>
                                                    <th>
                                                        <div class="tab-title-txt-cls">Room Category</div>
                                                    </th>
                                                    <th>
                                                        <div class="tab-title-txt-cls">Meal Plan</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $tours->tourDetails as $details)
                                                    @if($details->tour_type_id == 6)
                                                    <tr>
                                                        <td>
                                                            <div class="tab-title-txt-cls-inner day-pt">{{ $details->destination->name }} ({{ $details->nights }} Nights)
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tab-title-txt-cls-inner">{{ $details->hotel->hotel_name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tab-title-txt-cls-inner">{{ $details->hotel->star_rating }} {{ is_numeric($details->hotel->star_rating) ? 'Star' : '' }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="tab-title-txt-cls-inner">Breakfast (CP)</div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                {{-- <tr>
                                                    <td>
                                                        <div class="tab-title-txt-cls-inner day-pt">Madinah (5 Nights)
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="tab-title-txt-cls-inner">Durrat Al Madina</div>
                                                    </td>
                                                    <td>
                                                        <div class="tab-title-txt-cls-inner">Standard</div>
                                                    </td>
                                                    <td>
                                                        <div class="tab-title-txt-cls-inner">Breakfast (CP)</div>
                                                    </td>
                                                </tr> --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dt-tabbing-sec">
                            <div id="itenary"></div>
                            <div class="arrive-box">
                                <div class="dt-box-1 shadow">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="dt-rt">
                                                <div class="dt-subtitle">Itinerary</div>
                                                {{-- <div class="col-md-3">
                                                    <div class="fl-img fl-img-new">
                                                        <img src="https://b2bzend.s3.ap-south-1.amazonaws.com/img/111380/package/images/explore-andaman_1723534862"
                                                            title="" alt="" border="0">
                                                    </div>
                                                    <div class="activities-content-title">Cruise To Havelock Island And Port Blair</div>
                                                </div> --}}
                                                <div class="addReadMore showlesscontent">
                                                    <p>
                                                        {!! $tours->itinerary !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="arrive-box">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-12">
                                        <div class="dt-title">Inclusions</div>
                                        <div class="dt-box-1 shadow inclusion_heightsame">
                                            <ul>
                                                <li>Airfare (Optional)</li>
                                                <li>Taxes included GST 5%</li>
                                                <li>Umrah Visa Fees &amp; Insurance</li>
                                                <li>Stay in Makkah - 5 Nights</li>
                                                <li>Stay in Medina - 5 Nights&nbsp;</li>
                                                <li>Internal Transportation by bus in groups</li>
                                                <li>Daily Meals-Breakfast, Lunch &amp; Dinner</li>
                                                <li>Laundry facility</li>
                                                <li>Ziyarat tour of Makkah &amp; Madina</li>
                                                <li>Complimentary items provided by the Tour operator</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-12">
                                        <div class="dt-title">Exclusions</div>
                                        <div class="dt-box-1 shadow inclusion_heightsame">
                                            <ul>
                                                <li>TCS 5%</li>
                                                <li>Room Service</li>
                                                <li>Individual Transfers</li>
                                                <li>Extra luggage other than mentioned on ticket would be paid by the
                                                    pilgrim</li>
                                                <li>No refund in case of unused services or lesser duration of stay</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="terms_condition"></div>
                            <div class="dt-title">Terms & Conditions</div>
                            <div class="dt-box-1 shadow">
                                <div class="tabnav">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li>
                                            <a href="#terms_conditions" class="active"
                                                aria-controls="terms_conditions" role="tab" data-toggle="tab"
                                                aria-expanded="true" aria-selected="true">Terms &amp; Conditions</a>
                                        </li>
                                        <li>
                                            <a href="#details_tab2" class="" aria-controls="details_tab2"
                                                role="tab" data-toggle="tab" aria-expanded="false"
                                                aria-selected="false">Booking Terms</a>
                                        </li>
                                        <li>
                                            <a href="#details_tab3" class="" aria-controls="details_tab3"
                                                role="tab" data-toggle="tab" aria-expanded="false"
                                                aria-selected="false">Cancellation Policy</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" style="padding-top: 20px;">
                                    <div role="tabpanel" class="tab-pane active" id="terms_conditions">
                                        <div class="terms_list">
                                            <ul>
                                                <li>All Prices quoted are per person and include airfare (optional).
                                                </li>
                                                <li>In case of package booked without umrah visa through us, than
                                                    transportation will be subject to availability.</li>
                                                <li>Peak season groups will have an additional surcharge of Rs.3000/ per
                                                    person.</li>
                                                <li>Flight Tickets can be availed at an approximate additional cost of
                                                    INR 40,000. The final price, however, is subject to the fare at the
                                                    time of ticket issuance.</li>
                                                <li>Extra luggage other than mentioned on ticket would be paid by the
                                                    pilgrim.</li>
                                                <li>Unutilized services are Non-refundable.</li>
                                                <li>Hotel Distance may vary. Distances given are from the outer border
                                                    of Haram Shareef & Masjid-E-Nabvi. Hotel Direction are Google
                                                    Verified.</li>
                                                <li>Rooms Allotment as per hotel management, no room choice will be
                                                    entertained.</li>
                                                <li>Rooms in Makkah & Madina Hotels are normally as follows:</li>
                                                <li>Double Room = 2 Normal Beds, Triple Room = 2 Normal Beds + 1 Extra
                                                    Bed</li>
                                                <li>Quad Room = 2 Normal Beds + 2 Extra Beds</li>
                                                <li>Food provided will be on Full/Board basis by the hotel management.
                                                </li>
                                                <li>No refund in case of unused services or lesser duration of stay.
                                                </li>
                                                <li>The tour dates and tour programs are provisional and subject to
                                                    change without notice.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="details_tab2">
                                        <div class="terms_list">
                                            <ul>
                                                <li>Pay minimum Rs 40,000/- amount to book your package</li>
                                                <li>Final amount 100% to be paid 20 days before departure or the booking
                                                    will get cancelled without prior notice.</li>
                                                <li>Book through NEFT/RTGS or Cheque.</li>
                                                <li>if your booking is routed through any of our booking center the cost
                                                    of the land package shall remain the same. Atlas Tours & Travels Pvt
                                                    Ltd is not responsible for any cash transactions at any booking
                                                    centres.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="details_tab3">
                                        <div class="terms_list">
                                            <ul>
                                                <li>Package is 100% non-refundable</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>

</div>

@push('extra_css')
    <style>
        .custom-select {
        display: inline-block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem 1.75rem .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        vertical-align: middle;
        background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        }
    </style>
@endpush
