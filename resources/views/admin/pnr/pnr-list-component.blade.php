<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>PNR</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.pnr') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.pnr.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.pnr') }}
                        {{ __('tablevars.list') }}</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Search</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header" for="pnr_code">{{ __('tablevars.pnr_code') }}</label>
                                    <input type="text" name="pnr_code" id="pnr_code" class="form-control"
                                        placeholder="Search PNR" wire:model='pnr_code' wire:keyup="filterPnr"
                                        autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="flight_name">{{ __('tablevars.airlines') }}</label>
                                    <input type="text" name="flight_name" id="flight_name" class="form-control"
                                        placeholder="Search Airlines" autocomplete="off" wire:model='flight_name'
                                        wire:keyup="filterPnr">
                                </div>
                                <div class="col-3 ">
                                    <label class="label-header"
                                        for="search_dept_date">{{ __('tablevars.date') }}</label>
                                    <input type="date" name="search_dept_date" id="search_dept_date"
                                        class="form-control" placeholder="Search Booking Id" autocomplete="off"
                                        wire:model='search_dept_date' wire:change="filterPnr">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            {{-- <div class="d-flex flex-start">
                                <h4>PNR {{ __('tablevars.list') }}</h4>
                                <div class="badge badge-success mr-2"><span
                                        class="text-bold text-dark">{{ __('tablevars.available') }}</span>
                                </div>
                                <div class="badge badge-warning mr-2"><span
                                        class="text-bold text-dark">{{ __('tablevars.filling') }} </span>
                                </div>
                                <div class="badge badge-danger mr-2"><span
                                        class="text-bold text-dark">{{ __('tablevars.sold_out') }}</span>
                                </div>

                            </div> --}}

                            <div>
                                <a href="{{ route('admin.pnr.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }}
                                    {{ __('tablevars.new') }}</a>
                                <a href="javascript:void(0);" class="btn btn-warning" style="color: white;"
                                    wire:click="downloadPnr">
                                    <i class="fas fa-file-excel"></i> Print
                                </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.pnr_code') }}</th>
                                            <th>{{ __('tablevars.airlines') }}</th>
                                            <th>{{ __('tablevars.dept_date') }}</th>
                                            <th>{{ __('tablevars.return_date') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.days') }}</th>
                                            <th>{{ __('tablevars.avail_seats') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pnrData as $key => $RtpnrData)
                                            <tr>
                                                <td>{{ $key + $pnrData->firstItem() }}</td>
                                                <td> <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#bookingModal"
                                                        wire:click="getBookingContent({{ $RtpnrData->id }})">{{ $RtpnrData->pnr_code ?? '' }}</a>
                                                </td>

                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/flight_image/' . $RtpnrData->flight->flight_logo) }}"
                                                        alt="Flight Image"
                                                        style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover;" />
                                                    <br>{{ $RtpnrData->flight->flight_name }}({{ $RtpnrData->flight->flight_code }})
                                                </td>
                                                <td>{{ $RtpnrData->dept_date ? Helper::formatCarbonDate($RtpnrData->dept_date) : '' }}
                                                </td>
                                                <td>{{ $RtpnrData->return_date ? Helper::formatCarbonDate($RtpnrData->return_date) : '' }}
                                                </td>
                                                <td>{{ $RtpnrData->city->city_name ?? '' }}</td>
                                                <td>{{ $RtpnrData->days }}</td>
                                                <td>{{ $RtpnrData->seats }} / {{ $RtpnrData->avai_seats }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $RtpnrData->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $RtpnrData->id }})">
                                                        {{ $RtpnrData->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; right: 0px; will-change: transform;">
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click="getModalContent({{ $RtpnrData->id }})"
                                                                data-bs-target="#viewModal"
                                                                data-bs-toggle="modal">View</a>

                                                            {{-- <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click="getpassangerModalContent({{ $RtpnrData->id }}){{ $RtpnrData->booking_id ?? '' }}"
                                                                data-bs-target="#viewpassangerModal"
                                                                data-bs-toggle="modal">View Passanger Details</a> --}}

                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click="getpassangerModalContent({{ $RtpnrData->id }})"
                                                                data-bs-target="#viewpassangerModal"
                                                                data-bs-toggle="modal">View Passanger Details</a>


                                                            <div class="dropdown-divider"></div>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.pnr.edit', $RtpnrData->id) }}">Edit</a>

                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $RtpnrData->id }})'>{{ __('tablevars.trash') }}</a>

                                                            <a href="javascript:void(0)"
                                                                wire:click='isDupicate({{ $RtpnrData->id }})'
                                                                class="dropdown-item">{{ __('tablevars.duplicate') }}</a>

                                                            {{-- <a href="javascript:void(0)" class="dropdown-item"
                                                                wire:click="Fairandticket({{ $RtpnrData->id }})">{{ __('tablevars.fair_and_ticket') }}</a>
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                wire:click="Airlineformat({{ $RtpnrData->id }})">{{ __('tablevars.airlines_format') }}</a>
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                wire:click="Roomplan({{ $RtpnrData->id }})">{{ __('tablevars.room_plan') }}</a> --}}
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                wire:click="downloadTransportVoucher({{ $RtpnrData->id }})">{{ __('tablevars.transport_voucher') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                        wire:change='filterPnr'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $pnrData->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ 'View Pnr' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.pnr_code') }}</th>
                                <td>{{ $modalData->pnr_code ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.package_name') }}</th>
                                <td>{{ $package_names ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.group_name') }}</th>
                                <td>{{ $modalData->group_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.flight_name') }}</th>
                                <td>{{ $modalData->flight->flight_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.popular_flight') }}</th>
                                <td>{{ $modalData->is_popular == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.departure_city') }}</th>
                                <td>{{ $modalData->city->city_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.pnr') }} {{ __('tablevars.package_type') }}</th>
                                <td>{{ $modalData->pnr_pack_type ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.departure_sector') }}</th>
                                <td>{{ $modalData->departuresector->sector_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.return_sector') }}</th>
                                <td>{{ $modalData->returnsector->sector_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.airlines') }}</th>
                                <td>{{ $modalData->flight->flight_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.avail_seats') }}</th>
                                <td>{{ $modalData->avai_seats ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.departure_date') }} & Time</th>
                                <td>{{ $modalData->dept_date ?? '---' }} , {{ $modalData->dept_time ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.return_date') }} & Time</th>
                                <td>{{ $modalData->return_date ?? '---' }} , {{ $modalData->return_time ?? '---' }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.no_of_days') }}</th>
                                <td>{{ $modalData->days ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.no_of_seats') }}</th>
                                <td>{{ $modalData->seats ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.available_seats') }}</th>
                                <td>{{ $modalData->avai_seats ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Tour Leader') }}</th>
                                <td>{{ $modalData->tour_leader ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Group Number') }}</th>
                                <td>{{ $modalData->group_no ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Contact Number') }}</th>
                                <td>{{ $modalData->contact_no ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('SubAgent Name') }}</th>
                                <td>{{ $modalData->sub_agent_name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Rawda Permit') }}</th>
                                <td>{{ $modalData->rawda_permit ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.adult_price') }}</th>
                                <td>₹{{ number_format($modalData->adult_cost ?? '---') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.child_price') }}</th>
                                <td>₹{{ number_format($modalData->child_cost ?? '---') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.infant_price') }}</th>
                                <td>₹{{ number_format($modalData->infant_cost ?? '---') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.itinerary') }}</th>
                                <td>{{ $modalData->itenary ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.baggage_details') }}</th>
                                <td>{{ $modalData->baggage ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.cancellation_fee') }} </th>
                                <td>{{ $modalData->cancel_fee ?? '---' }}</td>
                            </tr>
                        </table>
                    @else
                        {{ __('tablevars.loading') }}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.booking') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    @if ($booking_modal_data)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Booking Id</th>
                                    {{-- <th>Request Id</th>
                                    <th>Service Type</th> --}}
                                    <th>Agency Name</th>
                                    {{-- <th>Departure City</th> --}}
                                    {{-- <th>Package Type</th> --}}
                                    {{-- <th>Package PNR</th>
                                    <th>Sharing Type</th>
                                    <th>Package Days</th>
                                    <th>Passenger Name</th>
                                    <th>Number of Adults</th>
                                    <th>Number of Child With Bed</th>
                                    <th>Number of Child Without Bed</th>
                                    <th>Number of Infants</th>
                                    <th>Total PAX (Adults+Children+Infants)</th>
                                    <th>Total Beds</th> --}}
                                    <th>Total Cost</th>

                                </tr>
                            </thead>
                            <tbody>

                                <td>{{ $booking_modal_data->booking_id ?? 'N/A' }}</td>


                                {{-- <td>{{ $booking_modal_data->request_id }}</td>


                                    <td>{{ $booking_modal_data->servicetype->name }}</td> --}}

                                <td>{{ $booking_modal_data->agency ? $booking_modal_data->agency->agency_name : 'website' }}
                                </td>

                                {{-- <td>{{ $booking_modal_data->city ? $booking_modal_data->city->city_name : '-' }}
                                    </td> --}}


                                {{-- <td>{{ Helper::formatCarbonDate($booking_modal_data->travel_date) }}</td>

                                    <td>{{ $booking_modal_data->pnr ? $booking_modal_data->pnr->pnr_code : '-' }}</td>

                                    <td>{{ $booking_modal_data->package->name }}</td> --}}

                                {{-- <td>{{ $booking_modal_data->packagetype->package_type }}</td>

                                    <td>{{ $booking_modal_data->shairing_type != null ? $booking_modal_data->sharingtype->name : '-' }}
                                    </td>

                                    <td>{{ $booking_modal_data->days }}</td>

                                    <td>{{ $booking_modal_data->mehram_name }}</td>

                                    <td>{{ $booking_modal_data->adult }}</td>

                                    <td>{{ $booking_modal_data->child_bed }}</td>

                                    <td>{{ $booking_modal_data->child }}</td>

                                    <td>{{ $booking_modal_data->infant }}</td>

                                    <td>{{ $booking_modal_data->adult + $booking_modal_data->child + $booking_modal_data->child_bed + $booking_modal_data->infant }}

                                    <td>{{ $booking_modal_data->adult + $booking_modal_data->child_bed }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Contact</td>
                                    <td>{{ $booking_modal_data->contact }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $booking_modal_data->email_id }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Is Paid</td>
                                    <td>{{ $booking_modal_data->is_paid == 1 ? 'Yes' : 'No' }}</td>
                                </tr> --}}


                                <td>₹ {{ Helper::properDecimals($booking_modal_data->tot_cost) }}</td>

                                {{-- <tr>
                                    <td>Cost Breakup</td>
                                    <td>{{ $booking_modal_data->cost_breackup }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Created Date</td>
                                    <td>{{ Helper::appDateFormat($booking_modal_data->created_at) }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Updated Date</td>
                                    <td>{{ Helper::appDateFormat($booking_modal_data->updated_at) }}</td>
                                </tr>
                                <tr>
                                    <td>Special Request (If Any)</td>
                                    <td>{{ $booking_modal_data->special_request }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    @else
                        <p>No booking details found.</p>
                    @endif

                </div>
            </div>
            {{-- <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div> --}}

        </div>
    </div>



    <div wire:ignore.self class="modal fade" id="viewpassangerModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ 'View Passenger Details' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($passenger_modaldata)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Nationality</th>
                                    <th>Passport Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passenger_modaldata as $passenger)
                                <tr>
                                    <td>{{ $passenger->guest_first_name . ' ' . $passenger->guest_last_name ?? '---' }}
                                    <td>{{ $passenger->gender ?? '---' }}</td>
                                    <td>{{ $passenger->age ?? '---'  }}</td>
                                    <td>{{ $passenger->nationality ?? '---' }}</td>
                                    <td>{{ $passenger->passport_number ?? '---' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No passenger details found.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .table-responsive {
            min-height: 250px;
        }
    </style>

</div>
