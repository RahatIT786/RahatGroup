    <div class="main-content">
        @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
        <section class="section">
            <div class="section-header">
                <h1>{{ __('tablevars.CustomizedUmrah') }}</h1>
                <div class="section-header-button">

                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">{{ __('tablevars.ManageEnquiry') }}

                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.umrah.index') }}"
                            wire:navigate>{{ __('tablevars.CustomizedUmrahPackages') }}</a></div>

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
                                            for="search_sharingtype">{{ __('tablevars.sharingtype') }}</label>
                                        <input type="text" name="search_sharingtype" id="search_sharingtype"
                                            class="form-control" wire:model='search_sharingtype'
                                            placeholder="Search Sharing Type" autocomplete="off"
                                            wire:keyup="filterUmrah">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('tablevars.CustomizedUmrahPackages') }} </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('tablevars.#') }}</th>
                                                <th>{{ __('tablevars.inq_no') }}</th>
                                                {{-- <th>{{ __('tablevars.category') }}</th> --}}
                                                <th>{{ __('tablevars.name') }} </th>
                                                <th>{{ __('tablevars.phone') }}</th>

                                                <th>{{ __('tablevars.supportteam') }}</th>
                                                <th>{{ __('tablevars.status') }}</th>
                                                <th>{{ __('tablevars.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Customizedumrah as $key => $umrah)
                                                <tr>
                                                    <td>{{ $key + $Customizedumrah->firstItem() }}</td>
                                                    <td>{{ Helper::uppercase($umrah->unique_id ?? '') }}</td>
                                                    <td>{{ $umrah->name ?? '' }}</td>
                                                    <td>{{ $umrah->mobile ?? '' }}</td>

                                                    <td>
                                                        @if ($umrah->staffmaster)
                                                            {{ $umrah->staffmaster->first_name . ' ' . $umrah->staffmaster->last_name }}
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
                                                        @if (array_key_exists($umrah->status, $statusLabels))
                                                            <div
                                                                class="badge {{ $statusLabels[$umrah->status]['class'] }}">
                                                                {{ $statusLabels[$umrah->status]['label'] }}
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
                                                                    data-toggle="tooltip" title="View Itinerary"
                                                                    wire:click="getModalContent({{ $umrah->id }})">View</a>
                                                                {{-- <a class="dropdown-item"
                                                                href="{{ route('admin.umrah.edit', $umrah->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a> --}}
                                                                <a class="dropdown-item text-danger"
                                                                    href="javascript:void(0)" data-toggle="tooltip"
                                                                    class="text-danger" title="Trash"
                                                                    wire:click='isDelete({{ $umrah->id }})'>Trash</a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    class="dropdown-item"
                                                                    data-bs-target="#relationshipModal"
                                                                    data-toggle="tooltip"
                                                                    title="Assign Relationship Manager"
                                                                    wire:click="getModalRelationship({{ $umrah->id }})">Assign
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
                                <div
                                    class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                        <select name="per_page" id="per_page" class="form-control">
                                            wire:model='perPage' wire:change='filterUmrah'>
                                            @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{ $Customizedumrah->links(data: ['scrollTo' => false]) }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- View Modal -->
        <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view') }} {{ 'itinerary' }}
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        @if ($modalData)
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ __('tablevars.name') }}</th>
                                    <td>{{ $modalData->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.mobile') }}</th>
                                    <td>{{ $modalData->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.email') }}</th>
                                    <td>{{ $modalData->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.nightsmakkah') }}</th>
                                    <td>{{ $modalData->nights_makkah }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.nightsmedina') }}</th>
                                    <td>{{ $modalData->nights_medina }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.hoteltype') }}</th>
                                    <td>{{ $modalData->hotel_type }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.adults') }}</th>
                                    <td>{{ $modalData->adults }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('tablevars.children') }}</th>
                                    <td>{{ $modalData->children }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('tablevars.infants') }}</th>
                                    <td>{{ $modalData->infants }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('tablevars.departure_country') }}</th>
                                    <td>{{ $modalData->country->countryname }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('tablevars.departure_city') }}</th>
                                    <td>{{ $modalData->city->city_name }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('tablevars.sharingtype') }}</th>
                                    <td>{{ $modalData->sharing_type }}</td>
                                </tr>


                                <tr>
                                    <th>{{ __('tablevars.dateoftravel') }}</th>
                                    <td>{{ $modalData->travel_date }}</td>
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
