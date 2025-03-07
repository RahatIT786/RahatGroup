<div class="main-content">
    @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.manage-enquiry') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageEnquiry.index') }}"
                        wire:navigate>{{ __('tablevars.manage-enquiry') }}</a></div>
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
                                    <label class="label-header" for="service_type">
                                        {{ __('tablevars.service_type') }}</label>
                                    <input type="text" name="service_type" id="service_type" class="form-control"
                                        wire:model='serviceType' wire:keyup="filterManageEnquiry"
                                        placeholder="Search Service Type" autocomplete="off">
                                </div>

                                <div class="col-3">
                                    <label class="label-header" for="name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        wire:model='name' wire:keyup="filterManageEnquiry" placeholder="Search Name"
                                        autocomplete="off">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.manage-enquiry') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.inq_no') }}</th>
                                            <th>{{ __('tablevars.service_type') }}</th>
                                            <th>{{ __('tablevars.city') }} </th>
                                            <th>{{ __('tablevars.name') }} </th>
                                            <th>{{ __('tablevars.email') }} </th>
                                            <th>{{ __('tablevars.mobile_number') }} </th>
                                            <th>{{ __('tablevars.whatsapp_number') }}</th>
                                            <th>{{ __('tablevars.support_team') }}</th>
                                            <th>{{ __('tablevars.status') }} </th>
                                            <th>{{ __('tablevars.action') }} </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($manageEnquirys as $key => $manageEnquiry)
                                            <tr>
                                                <td>{{ $key + $manageEnquirys->firstItem() }}</td>
                                                <td>{{ Helper::uppercase($manageEnquiry->unique_id ?? '') }}</td>
                                                <td>{{ $manageEnquiry->servicetype->name ?? '-' }}</td>
                                                <td>{{ $manageEnquiry->city_name ?? '-' }}</td>
                                                <td>{{ $manageEnquiry->name ?? '-' }}</td>
                                                <td>{{ $manageEnquiry->email ?? '-' }}</td>
                                                <td>{{ $manageEnquiry->mobile_num ?? '-' }}</td>
                                                <td>{{ $manageEnquiry->whatsapp_num ?? '-' }}</td>
                                                <td>
                                                    @if ($manageEnquiry->staffmaster)
                                                        {{ $manageEnquiry->staffmaster->first_name . ' ' . $manageEnquiry->staffmaster->last_name }}
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

                                                    @if (array_key_exists($manageEnquiry->status, $statusLabels))
                                                        <div
                                                            class="badge {{ $statusLabels[$manageEnquiry->status]['class'] }}">
                                                            {{ $statusLabels[$manageEnquiry->status]['label'] }}
                                                        </div>
                                                    @endif
                                                    {{-- {{$manageEnquiry->status}} --}}
                                                </td>

                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('admin.manageEnquiry.edit', $manageEnquiry->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a> --}}

                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="getModalContent({{ $manageEnquiry->id }})">View</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click='isDelete({{ $manageEnquiry->id }})'>Trash</a>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item"
                                                                data-bs-target="#relationshipModal"
                                                                data-toggle="tooltip"
                                                                title="Assign Relationship Manager"
                                                                wire:click="getModalRelationship({{ $manageEnquiry->id }})">Assign
                                                                Relationship Manager</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" align="center" class="v-msg">
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
                                        wire:change='filterManageEnquiry'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $manageEnquirys->links(data: ['scrollTo' => false]) }}
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
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view') }}
                        {{ __('tablevars.manage-enquiry') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.service_type') }}</th>
                                <td>{{ $modalData->servicetype->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.city') }} </th>
                                <td>{{ $modalData->city_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.name') }} </th>
                                <td>{{ $modalData->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.email') }} </th>
                                <td>{{ $modalData->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.mobile_number') }} </th>
                                <td>{{ $modalData->mobile_num }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.whatsapp_number') }}</th>
                                <td>{{ $modalData->whatsapp_num }}</td>
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
