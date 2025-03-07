<div class="main-content">
    @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.hotel_enquiry') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hotelInquary.index') }}"
                        wire:navigate>{{ __('tablevars.hotel_enquiry') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.list') }}</div>
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
                                    <label class="label-header" for="hotel_id">
                                        {{ __('tablevars.hotel') }}</label>
                                    <input type="text" name="hotel_id" id="hotel_id" class="form-control"
                                        wire:model='hotel_id' wire:keyup="filterHotel" placeholder="Search Hotel"
                                        autocomplete="off">
                                </div>

                                <div class="col-3">
                                    <label class="label-header" for="cust_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="cust_name" id="cust_name" class="form-control"
                                        wire:model='cust_name' wire:keyup="filterHotel" placeholder="Search Name"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.hotel_enquiry') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }} </th>
                                            <th>{{ __('tablevars.hotel') }} </th>
                                            <th>{{ __('tablevars.country') }} </th>
                                            <th>{{ __('tablevars.mobile_number') }} </th>
                                            <th>{{ __('tablevars.inq_no') }}</th>
                                            <th>{{ __('tablevars.support_team') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($hotelEnquirys as $key => $hotelEnquiry)
                                            <tr>
                                                <td>{{ $key + $hotelEnquirys->firstItem() }}</td>
                                                <td>{{ $hotelEnquiry->cust_name ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->hotel->hotel_name ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->country->countryname ?? '-' }}</td>
                                                <td>{{ $hotelEnquiry->mob_num ?? '-' }}</td>
                                                <td>{{ Helper::uppercase($hotelEnquiry->unique_id ?? '') }}</td>
                                                <td>
                                                    @if ($hotelEnquiry->staffmaster)
                                                        {{ $hotelEnquiry->staffmaster->first_name . ' ' . $hotelEnquiry->staffmaster->last_name }}
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
                                                    @if (array_key_exists($hotelEnquiry->status, $statusLabels))
                                                        <div
                                                            class="badge {{ $statusLabels[$hotelEnquiry->status]['class'] }}">
                                                            {{ $statusLabels[$hotelEnquiry->status]['label'] }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="getModalContent({{ $hotelEnquiry->id }})">View</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click='isDelete({{ $hotelEnquiry->id }})'>Trash</a>

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item"
                                                                data-bs-target="#relationshipModal"
                                                                data-toggle="tooltip"
                                                                title="Assign Relationship Manager"
                                                                wire:click="getModalRelationship({{ $hotelEnquiry->id }})">Assign
                                                                Relationship Manager</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" align="center" class="v-msg">
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
                                        wire:change='filterHotel'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $hotelEnquirys->links(data: ['scrollTo' => false]) }}
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
                                <th>{{ __('tablevars.name') }} </th>
                                <td>{{ $modalData->cust_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.hotel') }} </th>
                                <td>{{ $modalData->hotel->hotel_name ?? '' }}</td>

                            </tr>
                            <tr>
                                <th>{{ __('tablevars.country') }} </th>
                                <td>{{ $modalData->country->countryname ?? '' }}</td>

                            </tr>
                            <tr>
                                <th>{{ __('tablevars.mobile_number') }} </th>
                                <td>{{ $modalData->mob_num }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.message') }} </th>
                                <td>{{ $modalData->message }}</td>
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
