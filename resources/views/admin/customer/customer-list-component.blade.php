<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.ManageUser') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageUser') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}"
                        wire:navigate>{{ __('tablevars.user') }} {{ __('tablevars.list') }}</a></div>
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
                                    <label class="label-header" for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        wire:model='search_name' placeholder="Search Sharing Type" autocomplete="off"
                                        wire:keyup="filterCustomer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.user') }} {{ __('tablevars.list') }} </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }} </th>
                                            <th>{{ __('tablevars.email') }} </th>
                                            <th>{{ __('tablevars.phone') }}</th>
                                            <th>{{ __('tablevars.supportteam') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Customers as $key => $customer)
                                            <tr>
                                                <td>{{ $key + $Customers->firstItem() }}</td>
                                                <td>{{ $customer->name ?? '' }}</td>
                                                <td>{{ $customer->email ?? '' }}</td>
                                                <td>{{ $customer->mobile ?? '' }}</td>
                                                <td>
                                                    @if ($customer->staffmaster)
                                                        {{ $customer->staffmaster->first_name . ' ' . $customer->staffmaster->last_name }}
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
                                                    @if (array_key_exists($customer->status, $statusLabels))
                                                        <div
                                                            class="badge {{ $statusLabels[$customer->status]['class'] }}">
                                                            {{ $statusLabels[$customer->status]['label'] }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $customer->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $customer->id }})">
                                                        {{ $customer->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                      <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View Itinerary"
                                                                wire:click="getModalContent({{ $customer->id }})">View</a>
                                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('admin.customer.edit', $customer->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a> --}}
                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title="Trash"
                                                                wire:click='isDelete({{ $customer->id }})'>Trash</a>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item"
                                                                data-bs-target="#relationshipModal"
                                                                data-toggle="tooltip"
                                                                title="Assign Relationship Manager"
                                                                wire:click="getModalRelationship({{ $customer->id }})">Assign
                                                                Relationship Manager</a>
                                                            <a href="javascript:void(0)" class="dropdown-item py-2"
                                                                data-toggle="tooltip" title="User Login"
                                                                wire:click='askToLogin({{ $customer->id }})'>
                                                                <i class="mdi mdi-check text-primary"></i> User
                                                                Login</a>
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
                                    <select name="per_page" id="per_page" class="form-control">
                                        wire:model='perPage' wire:change='filterCustomer'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Customers->links(data: ['scrollTo' => false]) }}
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
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view_user') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.name') }}</th>
                                <td>{{ $modalData->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.mobile') }}</th>
                                <td>{{ $modalData->mobile ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.email') }}</th>
                                <td>{{ $modalData->email ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.country') }}</th>
                                <td>{{ $modalData->country->countryname ?? '' }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('tablevars.city') }}</th>
                                <td>{{ $modalData->city ?? '' }}</td>
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
                                    <select class="form-control" name='rm_staff_id' id="rm_staff_id"
                                        autocomplete="off" wire:model='rm_staff_id' readonly>
                                        <option value="">Select Relationship Manager</option>
                                        @foreach ($staffMaster as $StaffmasterId => $StaffMasterName)
                                            <option value="{{ $StaffmasterId }}"
                                                {{ $StaffmasterId == $rm_staff_id ? 'selected' : '' }}>
                                                {{ $StaffMasterName }}</option>
                                        @endforeach
                                    </select>
                                    @error('rm_staff_id')
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
    <style>
        .table-responsive {
            min-height: 250px;
        }
    </style>
</div>
@script
    <script>
        $wire.on('user-logged-in', (event) => {

            var url = event.url;

            window.open(url, '_blank');

        });
    </script>
@endscript
