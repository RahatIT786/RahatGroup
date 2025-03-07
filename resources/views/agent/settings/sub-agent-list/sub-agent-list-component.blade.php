<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div class="filter-grp ticket-grp d-flex justify-content-between">
                                            <h3 class="m-0">Sub Agent Listing</h3>
                                            <div>
                                                <a href="javascript:void(0)" wire:click="exportToExcel()"
                                                    style="color: white" class="btn btn-info"><i
                                                        class="fas fa-file-excel"></i> Export
                                                    into excel</a>
                                                <a wire:click="downloadSubAgentList()" href="javascript:void(0)"
                                                    style="color: white" class="btn btn-warning"><i
                                                        class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <!-- <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Agency Code</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_id' placeholder="Search Agency Code"
                                                            wire:keyup.debounce.500ms="filterAgent" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div> -->
                                                    <!-- <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Agency</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='agency_name' placeholder="Search Agency"
                                                            wire:keyup.debounce.500ms="filterAgent" maxlength="100">
                                                    </div> -->
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Sub Agent</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_subagent'
                                                            placeholder="Search Sub Agent Name"
                                                            wire:keyup.debounce.500ms="filterAgent" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="4%">SL#</th>
                                                        <th>{{ __('tablevars.agent_code') }}</th>
                                                        <!-- <th>{{ __('tablevars.agency') }}</th> -->
                                                        <th>{{ __('tablevars.subagent') }} {{ __('tablevars.name') }}
                                                        </th>
                                                        <th>{{ __('tablevars.city') }}</th>
                                                        <th>{{ __('tablevars.mobile') }}</th>
                                                        <th>{{ __('tablevars.email') }}</th>
                                                        <th>{{ __('tablevars.status') }}</th>
                                                        <!-- <th width="6%">{{ __('tablevars.action') }}</th> -->
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($agentList as $key => $agentLists)
                                                        <tr>
                                                            <td>{{ $key + $agentList->firstItem() }}</td>
                                                            <td>{{ $agentLists->agent_id ?? '---' }}</td>
                                                            <!-- <td>{{ $agentLists->agency->agency_name ?? '---' }}</td> -->
                                                            <td>{{ $agentLists->name ?? '---' }}</td>
                                                            <td>{{ $agentLists->city ?? '---' }}</td>
                                                            <td>{{ $agentLists->phone ?? '---' }}</td>
                                                            <td>{{ $agentLists->email ?? '---' }}</td>
                                                            <td>
                                                                <div style="cursor:pointer;"
                                                                    class="pointer badge badge-{{ $agentLists->is_active == 1 ? 'primary' : 'danger' }}"
                                                                    wire:click="toggleStatus({{ $agentLists->id }})">
                                                                    {{ $agentLists->is_active == 1 ? 'Active' : 'Inactive' }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ticket-grp mb-2 has-submenu">
                                                                    <button
                                                                        class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i
                                                                            class="fas fa-cog" data-toggle="tooltip"
                                                                            title="Options"></i></button>
                                                                    <div class="dropdown-menu"
                                                                        x-placement="bottom-start"
                                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                                        <a class="dropdown-item text-danger"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="tooltip" class="text-danger"
                                                                            title="Trash"
                                                                            wire:click='isDelete({{ $agentLists->id }})'>Trash</a>

                                                                        {{-- <a class="dropdown-item"
                                                                            href="{{ route('admin.agentlist.edit', $agentLists->id) }}"
                                                                            data-toggle="tooltip" title="Edit"
                                                                            data-bs-target="#editModal" wire:navigate
                                                                            data-bs-toggle="modal">Edit</a> --}}

                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="tooltip" title="Reset Password"
                                                                            wire:click="resetPassword('{{ $agentLists->id }}')">Reset
                                                                            Password</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="11" align="center" class="v-msg text-danger">
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
                                                <select name="per_page" id="per_page" wire:model='perPage'
                                                    class="form-control" wire:change='filterAgent'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $agentList->links(data: ['scrollTo' => false]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
