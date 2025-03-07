<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.agent') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.agent') }}
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
                                    <label class="label-header" for="search_agency">{{ __('tablevars.agency') }}</label>
                                    <input type="text" name="search_agency" id="search_agency" class="form-control"
                                        wire:model='search_agency' wire:keyup="filterAgent" placeholder="Search Agency"
                                        autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        wire:model='search_name' wire:keyup="filterAgent"
                                        placeholder="Search Agent Name" autocomplete="off">
                                </div>

                                <div class="col-3">
                                    <label class="label-header" for="search_mobile">{{ __('tablevars.mobile') }}</label>
                                    <input type="text" mobile="search_mobile" id="search_mobile" class="form-control"
                                        wire:model='search_mobile' wire:keyup="filterAgent"
                                        placeholder="Search Agent mobile" autocomplete="off"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>

                                <div class="col-3">
                                    <label class="label-header" for="search_email">{{ __('tablevars.email') }}</label>
                                    <input type="text" email="search_email" id="search_email" class="form-control"
                                        wire:model='search_email' wire:keyup="filterAgent"
                                        placeholder="Search Agent mobile" autocomplete="off">
                                </div>

                                <div class="col-3">
                                    <label class="label-header" for="search_status">Status</label>
                                    <select class="form-control" name='search_status' id="search_status"
                                        wire:model='search_status' wire:change="filterAgent">
                                        <option value="">All</option>
                                        @foreach (Helper::status() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.agent') }} {{ __('tablevars.list') }}</h4>

                            <div>
                                <a href="{{ route('admin.agentlist.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a href="javascript:void(0)" wire:click="exportToExcel()" style="color: white"
                                    class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                                <a wire:click="downloadAgentList()" href="javascript:void(0)" style="color: white"
                                    class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.state') }}</th>
                                            {{-- <th>{{ __('tablevars.city') }}</th> --}}
                                            <th>{{ __('tablevars.mobile') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            {{-- <th>{{ __('tablevars.email') }}</th>
                                            <th>{{ __('tablevars.is_paid') }}</th>
                                            <th>{{ __('tablevars.expired') }}</th> --}}
                                            <th>{{ __('tablevars.supportteam') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{ dd($agentLists) }} --}}
                                        @forelse ($agentLists as $key => $agent)
                                            <tr>
                                                <td>{{ $key + $agentLists->firstItem() }}</td>
                                                <td>
                                                    @if ($agent->agency_name)
                                                        <a href="{{ route('admin.payment.index', ['id' => $agent->id]) }}"
                                                            target="_blank">{{ $agent->agency_name }}</a>
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($agent->owner_name)
                                                        <a href="javascript:void(0)"data-bs-toggle="modal"
                                                            data-bs-target="#ownermodal" data-toggle="tooltip"
                                                            title="View"
                                                            wire:click="getownerContent({{ $agent->id }})">{{ $agent->owner_name }}</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $agent->state->state_name ?? '---' }}</td>
                                                {{-- <td>{{ $agent->city ?? '---' }}</td> --}}
                                                <td>{{ $agent->mobile ?? '---' }}</td>
                                                <td>{{ $agent->email ?? '---' }}</td>
                                                <td>
                                                    @if ($agent->staffmaster)
                                                        {{ $agent->staffmaster->first_name . ' ' . $agent->staffmaster->last_name }}
                                                    @else
                                                        {{ 'Not Assigned' }}
                                                    @endif
                                                </td>


                                                {{-- <td>{{ $agent->email ?? '---' }}</td>
                                                <td>{{ $agent->is_paid ?? '---' }}</td>
                                                <td>{{ $agent->valid_upto ?? '---' }}</td> --}}
                                                <td>
                                                    <div class="pointer badge badge-{{ $agent->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $agent->id }})">
                                                        {{ $agent->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            <a class="dropdown-item"
                                                                href="javascript:void(0)"data-bs-toggle="modal"
                                                                data-bs-target="#agentModal" data-toggle="tooltip"
                                                                title="View"
                                                                wire:click="getAgentContent({{ $agent->id }})">View</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.agentlist.edit', $agent->id) }}"
                                                                wire:navigate data-bs-toggle="modal"
                                                                data-bs-target="#editModal" data-toggle="tooltip"
                                                                title="Edit">Edit</a>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item"
                                                                data-bs-target="#relationshipModal"
                                                                data-toggle="tooltip"
                                                                title="Assign Relationship Manager"
                                                                wire:click="getModalRelationship({{ $agent->id }})">Assign
                                                                Relationship Manager</a>
                                                            <a href="javascript:void(0)" class="dropdown-item" data-toggle="tooltip"
                                                                title="Agent Login"
                                                                wire:click='askToLogin({{ $agent->id }})'>Agent
                                                                Login</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click='isDelete({{ $agent->id }})'>{{ __('tablevars.trash') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" align="center" class="v-msg">
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
                                    <select name="per_page" id="per_page" class="form-control"wire:model='perPage'
                                        wire:change='filterAgent'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $agentLists->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="agentModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.agent') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($agent_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.agency') }}</label>
                                                <div>{{ $agent_modal_data->agency_name ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.name') }}</label>
                                                <div>{{ $agent_modal_data->owner_name ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.state') }}</label>
                                                <div>{{ $agent_modal_data->state->state_name ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.city') }}</label>
                                                <div>{{ $agent_modal_data->city ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.mobile') }}</label>
                                                <div>{{ $agent_modal_data->mobile ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.email') }}</label>
                                                <div>{{ $agent_modal_data->email ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.is_paid') }}</label>
                                                <div>{{ $agent_modal_data->is_paid == 1 ? 'Paid' : 'Unpaid' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.expired') }}</label>
                                                <div>
                                                    {{ !empty($agent_modal_data->valid_upto) ? Helper::appDateFormat($agent_modal_data->valid_upto) : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.profile_image') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->profile_img)
                                                        <a href="{{ asset('storage/profile_image/' . $agent_modal_data->profile_img) }}"
                                                            download="{{ $agent_modal_data->profile_img }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/profile_image/' . $agent_modal_data->profile_img) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.company_logo') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->company_logo)
                                                        <a href="{{ asset('storage/company_logo/' . $agent_modal_data->company_logo) }}"
                                                            download="{{ $agent_modal_data->company_logo }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/company_logo/' . $agent_modal_data->company_logo) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.passport_copy') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->owners_passport)
                                                        <a href="{{ asset('storage/owners_passport/' . $agent_modal_data->owners_passport) }}"
                                                            download="{{ $agent_modal_data->owners_passport }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/owners_passport/' . $agent_modal_data->owners_passport) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.owners_adhaar') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->owners_adhaar)
                                                        <a href="{{ asset('storage/owners_adhaar/' . $agent_modal_data->owners_adhaar) }}"
                                                            download="{{ $agent_modal_data->owners_adhaar }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/owners_adhaar/' . $agent_modal_data->owners_adhaar) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.owners_pancard') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->owners_pancard)
                                                        <a href="{{ asset('storage/owners_pancard/' . $agent_modal_data->owners_pancard) }}"
                                                            download="{{ $agent_modal_data->owners_pancard }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/owners_pancard/' . $agent_modal_data->owners_pancard) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.bank_proof') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->cancelled_cheque)
                                                        <a href="{{ asset('storage/cancelled_cheque/' . $agent_modal_data->cancelled_cheque) }}"
                                                            download="{{ $agent_modal_data->cancelled_cheque }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/cancelled_cheque/' . $agent_modal_data->cancelled_cheque) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.office_address_proof') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->office_address_proof)
                                                        <a href="{{ asset('storage/office_address_proof/' . $agent_modal_data->office_address_proof) }}"
                                                            download="{{ $agent_modal_data->office_address_proof }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/office_address_proof/' . $agent_modal_data->office_address_proof) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.company_name_proof') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->company_name_proof)
                                                        <a href="{{ asset('storage/company_name_proof/' . $agent_modal_data->company_name_proof) }}"
                                                            download="{{ $agent_modal_data->company_name_proof }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/company_name_proof/' . $agent_modal_data->company_name_proof) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.outside_board_and_entrance') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->office_board)
                                                        <a href="{{ asset('storage/office_board/' . $agent_modal_data->office_board) }}"
                                                            download="{{ $agent_modal_data->office_board }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/office_board/' . $agent_modal_data->office_board) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.reception_and_waiting_area') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->reception)
                                                        <a href="{{ asset('storage/reception/' . $agent_modal_data->reception) }}"
                                                            download="{{ $agent_modal_data->reception }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/reception/' . $agent_modal_data->reception) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.boss_cabin_/_entrance') }}</label>
                                                <div>
                                                    @if ($agent_modal_data->boss_cabin)
                                                        <a href="{{ asset('storage/boss_cabin/' . $agent_modal_data->boss_cabin) }}"
                                                            download="{{ $agent_modal_data->boss_cabin }}"
                                                            class="btn btn-success">
                                                            Download
                                                        </a>
                                                        <a href="{{ asset('storage/boss_cabin/' . $agent_modal_data->boss_cabin) }}"
                                                            target="_blank" class="btn btn-primary">
                                                            View
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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


    <div wire:ignore.self class="modal fade" id="ownermodal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="ownermodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form wire:submit.prevent="update">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($owner_modal_data)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Agency</strong></td>
                                    <td>{{ $owner_modal_data->agency_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Owner</strong></td>
                                    <td>{{ $owner_modal_data->owner_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City</strong></td>
                                    <td>{{ $owner_modal_data->city ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile</strong></td>
                                    <td>{{ $owner_modal_data->mobile ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $owner_modal_data->email ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">

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


{{-- @push('extra_js')
    <script>
        $(function() {
            $wire.on('agent-logged-in', (event) => {
                var url = event.detail.url;
                window.open(url, '_blank');
            });
        })
    </script>
@endpush --}}

@script
    <script>
        $wire.on('agent-logged-in', (event) => {
            var url = event.url;
            window.open(url, '_blank');
        });
    </script>
@endscript
