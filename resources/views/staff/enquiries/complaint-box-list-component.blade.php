<div>
    <div class="content-wrapper">
        <div class="row">
            @livewire('staff.enquiries.enquiries-component')
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between">Search
                        <div>
                            <span class="mr-2">Total Enquiry : {{ $total }}</span>  <span class="mr-2">Complete Enquiry : {{ $complete }}</span> <span class="mr-2">Pending Enquiry : {{ $pending }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div cclass="form-group">
                                    <label class="label-header"
                                        for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name"
                                        class="form-control" wire:model='search_name'
                                        placeholder="Search Name" autocomplete="off" wire:keyup="filterComplaintBox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="display-5">{{ __('tablevars.ComplaintBox') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('tablevars.#') }}</th>
                                        <th>{{ __('tablevars.name') }} </th>
                                        <th>{{ __('tablevars.phone') }}</th>
                                        <th>{{ __('tablevars.status') }}</th>
                                        <th>{{ __('tablevars.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($ComplaintBox as $key => $complaintBox)
                                        <tr>
                                            <td>{{ $key + $ComplaintBox->firstItem() }}</td>
                                            <td>{{ $complaintBox->guest_name ?? '' }}</td>
                                            <td>{{ $complaintBox->mobile ?? '' }}</td>

                                            {{-- <td>
                                                @if ($complaintBox->staffmaster)
                                                    {{ $complaintBox->staffmaster->first_name . ' ' . $complaintBox->staffmaster->last_name }}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </td> --}}
                                            <td> @php
                                                $statusLabels = [
                                                    1 => ['label' => 'Assigned', 'class' => 'badge-primary'],
                                                    2 => ['label' => 'Completed', 'class' => 'badge-success'],
                                                    3 => ['label' => 'Rejected', 'class' => 'badge-danger'],
                                                ];
                                            @endphp
                                                @if (array_key_exists($complaintBox->status, $statusLabels))
                                                    <div class="badge {{ $statusLabels[$complaintBox->status]['class'] }}">
                                                        {{ $statusLabels[$complaintBox->status]['label'] }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <li class="nav-item list-unstyled dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#"
                                                        data-toggle="dropdown" id="optionDropdown"><i
                                                            class="mdi mdi-settings"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                                        aria-labelledby="optionDropdown">

                                                        <a class="dropdown-item py-2" href="javascript:void(0)"
                                                            data-toggle="modal"
                                                            wire:click="getModalContent({{ $complaintBox->id }})"
                                                            data-target="#enquiryListModal"><i
                                                                class="mdi mdi-check text-primary"></i> View</a>

                                                        @if ($complaintBox->status == 1)
                                                            <a class="dropdown-item py-2" href="javascript:void(0)"
                                                                wire:click="completed({{ $complaintBox->id }})">
                                                                <i class="mdi mdi-check text-primary"></i>
                                                                Complete</a>

                                                            <a class="dropdown-item py-2" href="javascript:void(0)"
                                                                wire:click="rejected({{ $complaintBox->id }})">
                                                                <i class="mdi mdi-close text-danger"></i>
                                                                Reject</a>
                                                        @endif
                                                    </div>
                                                </li>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" align="center" class="v-msg text-danger">
                                                {{ __('tablevars.no_record') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                        wire:change='filterComplaintBox'>
                                        @foreach (Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $ComplaintBox->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- view modal --}}
        <div class="modal fade" id="enquiryListModal" tabindex="-1" role="dialog"
            aria-labelledby="enquiryListModalTitle" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enquiryListModalTitle">Complaint Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                @if ($modalData)
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <td>{{ $modalData->guest_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.mobile') }}</th>
                                            <td>{{ $modalData->mobile }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>{{ __('tablevars.bookings') }}</th>
                                            <td>{{ $modalData->bookings->booking_id }}</td>
                                        </tr> --}}
                                        <tr>
                                            <th>{{ __('tablevars.hotel') }}</th>
                                            <td>{{ $modalData->hotels->hotel_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.departure_date') }}</th>
                                            <td>{{ $modalData->departure_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.airport') }}</th>
                                            <td>{{ $modalData->airport }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.room_no') }}</th>
                                            <td>{{ $modalData->room_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.description') }}</th>
                                            <td>{{ $modalData->description }}</td>
                                        </tr>
                                    </table>
                                @else
                                    {{ __('tablevars.loading') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark"
                            data-dismiss="modal">{{ __('tablevars.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
