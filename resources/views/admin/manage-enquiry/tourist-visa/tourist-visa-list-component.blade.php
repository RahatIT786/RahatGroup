<div>
    <!-- Main Content -->
    <div class="main-content">
        @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
        <section class="section">
            <div class="section-header">
                <h1>{{ __('tablevars.tourist-visa') }}</h1>
                <div class="section-header-button">
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}</div>
                    <div class="breadcrumb-item">
                        <a href="{{ route('admin.touristVisa.index') }}" wire:navigate>
                            {{ __('tablevars.tourist-visa') }}
                        </a>
                    </div>
                    <div class="breadcrumb-item">{{ __('tablevars.list') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <!-- Search Card -->
                        <div class="card">
                            <div class="card-header  d-flex justify-content-between">Search
                                <div>
                                    <span class="mr-2">Total Enquiry : {{ $total }}</span>  <span class="mr-2">Complete Enquiry : {{ $complete }}</span> <span class="mr-2">Pending Enquiry : {{ $pending }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="label-header" for="visa_type">{{ __('tablevars.visa') }}
                                            {{ __('tablevars.type') }}</label>
                                        <input type="text" name="visa_type" id="visa_type" class="form-control"
                                            wire:model='visa_type' wire:keyup="filterTouristVisa"
                                            placeholder="Search Visa Type" autocomplete="off">
                                    </div>
                                    <div class="col-3">
                                        <label class="label-header" for="cust_name">{{ __('tablevars.name') }}</label>
                                        <input type="text" name="cust_name" id="cust_name" class="form-control"
                                            wire:model='cust_name' wire:keyup="filterTouristVisa"
                                            placeholder="Search Name" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visa List Card -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('tablevars.visa') }} {{ __('tablevars.list') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('tablevars.#') }}</th>
                                                <th>{{ __('tablevars.name') }}</th>
                                                <th>{{ __('tablevars.email') }} </th>
                                                <th>{{ __('tablevars.Visa Type') }} </th>
                                                {{-- <th>{{ __('tablevars.Country Name') }} </th>
                                                <th>{{ __('tablevars.mobile') }} </th>
                                                <th>{{ __('tablevars.nationality') }}</th> --}}
                                                <th>{{ __('tablevars.inq_no') }}</th>
                                                <th>{{ __('tablevars.support_team') }}</th>
                                                <th>{{ __('tablevars.status') }} </th>
                                                <th>{{ __('tablevars.action') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($touristVisa as $key => $touristvisa)
                                                <tr>
                                                    <td>{{ $key + $touristVisa->firstItem() }}</td>
                                                    <td>{{ Helper::uppercase($touristvisa->unique_id ?? '') }}</td>
                                                    <td>{{ $touristvisa->cust_name ?? '' }}</td>
                                                    <td>{{ $touristvisa->cust_email ?? '' }}</td>
                                                    <td>{{ $touristvisa->visa_type ?? '' }}</td>
                                                    {{-- <td>{{ $touristvisa->country->countryname ?? '-' }}</td>
                                                    <td>{{ $touristvisa->cust_mob ?? '' }}</td>
                                                    <td>{{ $touristvisa->cust_nationality ?? '' }}</td> --}}
                                                    {{-- <td>{{ $touristvisa->support_team ?? '-' }}</td> --}}
                                                    {{-- @manas --}}
                                                    <td>
                                                        @if ($touristvisa->staffmaster)
                                                            {{ $touristvisa->staffmaster->first_name . ' ' . $touristvisa->staffmaster->last_name }}
                                                        @else
                                                            {{ '-' }}
                                                        @endif
                                                    </td>
                                                    {{-- //nibedita --}}
                                                    <td> @php
                                                        $statusLabels = [
                                                            0 => ['label' => 'Not Assigned', 'class' => 'badge-info'],
                                                            1 => ['label' => 'Assigned', 'class' => 'badge-primary'],
                                                            2 => ['label' => 'Completed', 'class' => 'badge-success'],
                                                            3 => ['label' => 'Rejected', 'class' => 'badge-danger'],
                                                        ];
                                                    @endphp

                                                        @if (array_key_exists($touristvisa->status, $statusLabels))
                                                            <div
                                                                class="badge {{ $statusLabels[$touristvisa->status]['class'] }}">
                                                                {{ $statusLabels[$touristvisa->status]['label'] }}
                                                            </div>
                                                        @endif
                                                        {{-- {{$touristvisa->status}} --}}
                                                    </td>
                                                    {{-- @end --}}
                                                    <td>
                                                        <div class="btn-group mb-2">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                type="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"><i
                                                                    class="fas fa-cog" data-toggle="tooltip"
                                                                    title="Options"></i></button>
                                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                                style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    wire:click="getModalContent({{ $touristvisa->id }})"
                                                                    data-bs-target="#viewModal" data-toggle="tooltip"
                                                                    data-bs-toggle="modal" title="View">View</a>
                                                                {{-- @manas --}}
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    class="dropdown-item"
                                                                    data-bs-target="#relationshipModal"
                                                                    data-toggle="tooltip"
                                                                    title="Assign Relationship Manager"
                                                                    wire:click="getModalRelationship({{ $touristvisa->id }})">Assign
                                                                    Relationship Manager</a>
                                                                {{-- @end --}}
                                                                <a href="javascript:void(0)" data-toggle="tooltip"
                                                                    class="dropdown-item text-danger" title="Trash"
                                                                    wire:click='isDelete({{ $touristvisa->id }})'>Trash</a>
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
                                <div
                                    class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                        <select name="per_page" id="per_page" class="form-control" wire:model='perPage'
                                            wire:change='filterTouristVisa'>
                                            @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{ $touristVisa->links(data: ['scrollTo' => false]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal for Viewing Details -->
        <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">{{ 'View Itinerary' }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <!-- Nav tabs -->
                        <div class="nav nav-tabs" id="myTabs" role="tablist">
                            <div class="nav-item">
                                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info"
                                    role="tab" aria-controls="info" aria-selected="true">Information</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" id="document-tab" data-bs-toggle="tab" href="#document"
                                    role="tab" aria-controls="document" aria-selected="false">Document</a>
                            </div>
                        </div>
                        <!-- Tab content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel"
                                aria-labelledby="info-tab">
                                @if ($modalData)
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <td>{{ $modalData->cust_name ?? '---' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <td>{{ $modalData->cust_email ?? '---' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.Visa Type') }}</th>
                                            <td>{{ $modalData->visa_type ?? '---' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.Country Name') }}</th>
                                            <td>{{ $modalData->country->countryname ?? '---' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.mobile') }}</th>
                                            <td>{{ $modalData->cust_mob ?? '---' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.nationality') }}</th>
                                            <td>{{ $modalData->cust_nationality ?? '---' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.support_team') }}</th>
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
                            <div class="tab-pane fade" id="document" role="tabpanel"
                                aria-labelledby="document-tab">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('tablevars.passport_front') }}</th>
                                            <td>
                                                @php
                                                    if ($modalData && $modalData->cust_pp_front) {
                                                        $file_path = public_path(
                                                            '/storage/tourist-visa/' . $modalData->cust_pp_front,
                                                        );
                                                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                                                    }
                                                @endphp

                                                @if ($modalData && $modalData->cust_pp_front && file_exists($file_path))
                                                    @if (in_array($file_extension, ['jpg', 'jpeg', 'png']))
                                                        <!-- Button to download the image -->
                                                        <a href="{{ asset('/storage/tourist-visa/' . $modalData->cust_pp_front) }}"
                                                            download="{{ $modalData->cust_pp_front }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-download"></i> Download Image
                                                        </a>
                                                    @elseif ($file_extension === 'pdf')
                                                        <a href="{{ asset('/storage/tourist-visa/' . $modalData->cust_pp_front) }}"
                                                            target="_blank">
                                                            Open PDF
                                                        </a>
                                                    @else
                                                        Unknown file type
                                                    @endif
                                                @else
                                                    No image found
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>{{ __('tablevars.passport_back') }}</th>
                                            <td>
                                                @php
                                                    if ($modalData && $modalData->cust_pp_back) {
                                                        $file_path = public_path(
                                                            '/storage/tourist-visa/' . $modalData->cust_pp_back,
                                                        );
                                                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                                                    }
                                                @endphp

                                                @if ($modalData && $modalData->cust_pp_back && file_exists($file_path))
                                                    @if (in_array($file_extension, ['jpg', 'jpeg', 'png']))
                                                        <img class="p-4"
                                                            src="{{ asset('/storage/tourist-visa/' . $modalData->cust_pp_back) }}"
                                                            alt="Passport Back" style="height: 100px">
                                                    @elseif ($file_extension === 'pdf')
                                                        <a href="{{ asset('/storage/tourist-visa/' . $modalData->cust_pp_back) }}"
                                                            target="_blank">Open PDF</a>
                                                    @else
                                                        Unknown file type
                                                    @endif
                                                @else
                                                    No image found
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('tablevars.emirate_id') }}</th>
                                            <td>
                                                @php
                                                    if ($modalData && $modalData->cust_emirate_id) {
                                                        $file_path = public_path(
                                                            '/storage/tourist-visa/' . $modalData->cust_emirate_id,
                                                        );
                                                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                                                    }
                                                @endphp

                                                @if ($modalData && $modalData->cust_emirate_id && file_exists($file_path))
                                                    @if (in_array($file_extension, ['jpg', 'jpeg', 'png']))
                                                        <img class="p-4"
                                                            src="{{ asset('/storage/tourist-visa/' . $modalData->cust_emirate_id) }}"
                                                            alt="Emirate ID" style="height: 100px">
                                                    @elseif ($file_extension === 'pdf')
                                                        <a href="{{ asset('/storage/tourist-visa/' . $modalData->cust_emirate_id) }}"
                                                            target="_blank">Open PDF</a>
                                                    @else
                                                        Unknown file type
                                                    @endif
                                                @else
                                                    No image found
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"
                            title="Close">{{ __('tablevars.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Relationship Manager CRUD Modal -->
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
</div>
{{-- @end --}}
