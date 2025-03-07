<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-primary text-white">Search</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_status">{{ __('tablevars.agency_name') }}</label>
                                <input type="text" name="search_agency_name" id="search_agency_name"
                                    wire:model='search_agency_name' wire:keyup="filterAgent" class="form-control"
                                    placeholder="Search Agency Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_status">{{ __('tablevars.name') }}</label>
                                <input type="text" name="search_name" id="search_name" wire:model='search_name'
                                    wire:keyup="filterAgent" class="form-control" placeholder="Search Name"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search_status">{{ __('tablevars.agent_code') }}</label>
                                <input type="text" name="search_agency_code" id="search_agency_code"
                                    wire:model='search_agency_code' wire:keyup="filterAgent" class="form-control"
                                    placeholder="Search Agency Code" autocomplete="off">
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
                            <h4 class="display-5">{{ __('tablevars.agent') }} {{ __('tablevars.list') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('tablevars.#') }}</th>
                                    <th>{{ __('tablevars.agent_code') }}</th>
                                    <th>{{ __('tablevars.agency') }}</th>
                                    <th>{{ __('tablevars.name') }}</th>
                                    <th>{{ __('tablevars.state') }}</th>
                                    <th>{{ __('tablevars.city') }}</th>
                                    <th>{{ __('tablevars.mobile') }}</th>
                                    {{-- <th>{{ __('tablevars.email') }}</th>
                                    <th>{{ __('tablevars.is_paid') }}</th>
                                    <th>{{ __('tablevars.expired') }}</th> --}}
                                    <th>{{ __('tablevars.status') }}</th>
                                    <th>{{ __('tablevars.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($agents as $key => $agent)
                                    <tr>
                                        <td>{{ $key + $agents->firstItem() }}</td>
                                        <td>{{ $agent->id ?? '---' }}</td>
                                        <td>{{ $agent->agency_name ?? '---' }}</td>
                                        <td>{{ $agent->owner_name ?? '---' }}</td>
                                        {{-- <td>
                                            @if ($agent->agency_name)
                                                <a href="{{ route('admin.payment.index', ['id' => $agent->id]) }}"
                                                    target="_blank">{{ $agent->agency_name }}</a>
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            @if ($agent->owner_name)
                                                <a href="{{ route('website.agent', ['agent_website' => $agent->id]) }}"
                                                    target="_blank">{{ $agent->owner_name }}</a>
                                            @else
                                                -
                                            @endif
                                        </td> --}}
                                        <td>{{ $agent->state->state_name ?? '---' }}</td>
                                        <td>{{ $agent->city ?? '---' }}</td>
                                        <td>{{ $agent->mobile ?? '---' }}</td>
                                        <td>
                                            <a class="pointer badge rounded-lg badge-{{ $agent->is_active == 1 ? 'primary' : 'danger' }}"
                                                wire:click="toggleStatus({{ $agent->id }})">
                                                {{ $agent->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </a>
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
                                                        wire:click="getModalContent({{ $agent->id }})"
                                                        data-target="#enquiryListModal"><i
                                                            class="mdi mdi-check text-primary"></i> View</a>
                                                            
                                                    <a class="dropdown-item py-2"
                                                        href="{{ route('staff.manageAgent.edit', $agent->id) }}"
                                                        wire:navigate data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-toggle="tooltip" title="Edit"> <i
                                                            class="mdi mdi-check text-primary"></i> Edit</a>

                                                    <a href="javascript:void(0)" class="dropdown-item py-2"
                                                        data-toggle="tooltip" title="Agent Login"
                                                        wire:click='askToLogin({{ $agent->id }})'>
                                                        <i class="mdi mdi-check text-primary"></i> Agent
                                                        Login</a>

                                                </div>
                                            </li>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" align="center" class="v-msg text-danger">
                                            No Records Found...
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex flex-row justify-content-between align-items-center table-pagination mt-4">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bold mr-3 flex-shrink-0">Per Page</span>
                                <select name="per_page" id="per_page" wire:model='perPage' class="form-control"
                                    wire:change='filterAgent'>
                                    @foreach (Helper::getPerPageOptions() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{ $agents->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Enquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($agent_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('tablevars.agent_code') }}</label>
                                                <div>{{ $agent->id ?? '---' }}</div>
                                            </div>
                                        </div>
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- view modal --}}
    <div class="modal fade" id="enquiryListModal" tabindex="-1" role="dialog" aria-labelledby="enquiryListModalTitle"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryListModalTitle">Manage Agent Details</h5>
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
                                        <th>{{ __('tablevars.agent_code') }}</th>
                                        <td>{{ $modalData->id ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.agency') }}</th>
                                        <td>{{ $modalData->agency_name ?? '---' }}</td>

                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.name') }}</th>
                                        <td>{{ $modalData->owner_name ?? '---' }}</td>

                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.country') }}</th>
                                        <td>{{ $modalData->country->countryname ?? 'N/A' }}</td>

                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.state') }}</th>
                                        <td>{{ $modalData->state->state_name ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.city') }}</th>
                                        <td>{{ $modalData->city ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.mobile') }}</th>
                                        <td>{{ $modalData->mobile ?? '---' }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('tablevars.email') }}</th>
                                        <td>{{ $modalData->email ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.website') }}</th>
                                        <td>{{ $modalData->website ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.gst') }}</th>
                                        <td>{{ $modalData->gst ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.pan') }}</th>
                                        <td>{{ $modalData->pan ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.address') }}</th>
                                        <td>{{ $modalData->address ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.is_paid') }}</th>
                                        <td>{{ $modalData->is_paid == 1 ? 'Paid' : 'Unpaid' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.expired') }}</th>
                                        <td>{{ !empty($modalData->valid_upto) ? Helper::appDateFormat($modalData->valid_upto) : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.profile_image') }}</th>
                                        <td><a href="{{ asset('storage/profile_image/' . $modalData->profile_img) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.company_logo') }}</th>
                                        <td><a href="{{ asset('storage/company_image/' . $modalData->company_logo) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.passport_copy') }}</th>
                                        <td><a href="{{ asset('storage/owners_passport/' . $modalData->owners_passport) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.owners_adhaar') }}</th>
                                        <td><a href="{{ asset('storage/owners_adhaar/' . $modalData->owners_adhaar) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.owners_pancard') }}</th>
                                        <td><a href="{{ asset('storage/owners_pancard/' . $modalData->owners_pancard) }}"
                                                target="_blank" download>Download </a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.bank_proof') }}</th>
                                        <td><a href="{{ asset('storage/cancelled_cheque/' . $modalData->cancelled_cheque) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.office_address_proof') }}</th>
                                        <td><a href="{{ asset('storage/office_address_proof/' . $modalData->office_address_proof) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.company_name_proof') }}</th>
                                        <td><a href="{{ asset('storage/company_name_proof/' . $modalData->company_name_proof) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.outside_board_and_entrance') }}</th>
                                        <td><a href="{{ asset('storage/office_board/' . $modalData->office_board) }}"
                                                target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.reception_and_waiting_area') }}</th>
                                        <td><a href="{{ asset('storage/reception/' . $modalData->reception) }}" target="_blank" download>Download</a></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('tablevars.boss_cabin_/_entrance') }}</th>
                                        <td><a href="{{ asset('storage/boss_cabin/' . $modalData->boss_cabin) }}" target="_blank" download>Download</a></td>
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
@script
    <script>
        $wire.on('agent-logged-in', (event) => {
            var url = event.url;
            window.open(url, '_blank');
        });
    </script>
@endscript
