<div class="main-content">
    @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
    <div wire:loading>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.booking') }} {{ __('tablevars.enquiry') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageEnquiry') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.bookingEnquiry.index') }}"
                        wire:navigate>{{ __('tablevars.booking') }} {{ __('tablevars.enquiry') }}</a></div>

            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header  d-flex justify-content-between">Search
                            <div>
                                <span class="mr-2">Total Enquiry : {{ $total }}</span>  <span class="mr-2">Complete Enquiry : {{ $complete }}</span> <span class="mr-2">Pending Enquiry : {{ $pending }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header"
                                        for="service_type">{{ __('tablevars.category') }}</label>
                                    <select name="service_type" id="service_type" class="form-control"
                                        wire:model="service_type" wire:change="filterBooking">
                                        <option value="">
                                            {{ __('tablevars.select') }}{{ __('tablevars.category') }}</option>
                                        @foreach ($serviceTypes as $id => $service_name)
                                            <option value="{{ $id }}">{{ $service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        wire:model='search_name' placeholder="Search name" autocomplete="off"
                                        wire:keyup="filterBooking">
                                </div>
                                {{-- <div class="col-3">
                                    <label class="label-header"
                                        for="search_category">{{ __('tablevars.category') }}</label>
                                    <input type="text" name="search_category" id="search_category"
                                        class="form-control" wire:model='search_category' placeholder="Search Category"
                                        autocomplete="off" wire:keyup="filterBooking">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.booking') }} {{ __('tablevars.enquiry') }}
                                {{ __('tablevars.list') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.inq_no') }}</th>
                                            <th>{{ __('tablevars.category') }}</th>
                                            <th>{{ __('tablevars.package') }} </th>
                                            <th>{{ __('tablevars.packagetype') }} </th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.support_team') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Bookingumrah as $key => $bookingumrah)
                                            <tr>
                                                <td>{{ $key + $Bookingumrah->firstItem() }}</td>
                                                <td>{{ Helper::uppercase($bookingumrah->unique_id ?? '') }}</td>
                                                <td>{{ $bookingumrah->servicetype->name ?? '-' }}</td>
                                                <td>{{ $bookingumrah->packagemaster->name ?? '' }}</td>
                                                <td>{{ $bookingumrah->packagetype->package_type ?? '' }}</td>
                                                <td>{{ $bookingumrah->cust_name ?? '' }}</td>
                                                <td>
                                                    @if ($bookingumrah->staffmaster)
                                                        {{ $bookingumrah->staffmaster->first_name . ' ' . $bookingumrah->staffmaster->last_name }}
                                                    @else
                                                        {{ '-' }}
                                                    @endif
                                                </td>
                                                <td> @php
                                                    $statusLabels = [
                                                        0 => ['label' => 'Not Assigned', 'class' => 'badge-info'],
                                                        1 => ['label' => 'Assigned', 'class' => 'badge-primary'],
                                                        2 => ['label' => 'Completed', 'class' => 'badge-success'],
                                                        3 => ['label' => 'Rejected', 'class' => 'badge-danger'],
                                                    ];
                                                @endphp
                                                    @if (array_key_exists($bookingumrah->status, $statusLabels))
                                                        <div
                                                            class="badge {{ $statusLabels[$bookingumrah->status]['class'] }}">
                                                            {{ $statusLabels[$bookingumrah->status]['label'] }}
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="ticket-grp mb-2 has-submenu">
                                                        <button
                                                            class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="fas fa-cog" data-toggle="tooltip"
                                                                title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="getModalContent({{ $bookingumrah->id }})">View</a>

                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title="Trash"
                                                                wire:click='isDelete({{ $bookingumrah->id }})'>Trash</a>

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item"
                                                                data-bs-target="#relationshipModal"
                                                                data-toggle="tooltip"
                                                                title="Assign Relationship Manager"
                                                                wire:click="getModalRelationship({{ $bookingumrah->id }})">Assign
                                                                Relationship Manager</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" align="center" class="v-msg text-danger">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                        wire:change='filterBooking'>
                                        @foreach (Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Bookingumrah->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- view modal --}}
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view') }} {{ 'enquiry' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.category') }}</th>
                                <td>{{ $modalData->servicetype->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.package') }}</th>
                                <td>{{ $modalData->packagemaster->name ?? '' }}</td>

                            </tr>
                            <tr>
                                <th>{{ __('tablevars.packagetype') }}</th>
                                <td>{{ $modalData->packagetype->package_type ?? '' }}</td>

                            </tr>
                            <tr>
                                <th>{{ __('tablevars.name') }}</th>
                                <td>{{ $modalData->cust_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.email') }}</th>
                                <td>{{ $modalData->cust_email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.phone') }}</th>
                                <td>{{ $modalData->cust_num }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.traveldate') }}</th>
                                <td>{{ $modalData->travel_date }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.food') }}</th>
                                <td>{{ $modalData->food == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.visa') }}</th>
                                <td>{{ $modalData->visa == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.airticket') }}</th>
                                <td>{{ $modalData->air_ticket == 1 ? 'Yes' : 'No' }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('tablevars.supportteam') }}</th>
                                <td>
                                    @if ($modalData->staffmaster)
                                        {{ $modalData->staffmaster->first_name . ' ' . $modalData->staffmaster->last_name }}
                                    @else
                                        {{ '-' }}
                                    @endif
                                </td>
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

    <!--Relationship Manager CRUD Modal -->
    <div wire:ignore.self class="modal fade" id="relationshipModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="relationshipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form wire:submit.prevent="update">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="relationshipModalLabel">Assign Relationship Manager</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('tablevars.relationship_manager') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name='support_team' id="support_team"
                                        autocomplete="off" wire:model='support_team' readonly>
                                        <option value="">Select Relationship Manager</option>
                                        @foreach ($staffMaster as $StaffmasterId => $StaffMasterName)
                                            <option value="{{ $StaffmasterId }}"
                                                {{ $StaffmasterId == $support_team ? 'selected' : '' }}>
                                                {{ $StaffMasterName }}</option>
                                        @endforeach
                                    </select>
                                    @error('support_team')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
