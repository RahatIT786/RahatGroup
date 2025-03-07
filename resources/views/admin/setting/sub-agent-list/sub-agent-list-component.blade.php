<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.subagent') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.subagentlist.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.subagent') }}
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
                                    <label class="label-header"
                                        for="search_agency_code">{{ __('tablevars.agent_code') }}</label>
                                    <input type="text" name="search_agency_code" id="search_agency_code"
                                        wire:model='search_agency_code' wire:keyup="filterSubAgent" class="form-control"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        placeholder="Search Agency Code" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_agency">{{ __('tablevars.agency') }}</label>
                                    <input type="text" name="search_agency" id="search_agency" class="form-control"
                                        wire:model='search_agency' wire:keyup="filterSubAgent"
                                        placeholder="Search Agency" autocomplete="off">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header"
                                        for="search_sub_agent">{{ __('tablevars.sub_agent_name') }}</label>
                                    <input type="text" name="search_sub_agent" id="search_sub_agent"
                                        class="form-control" placeholder="Search Sub Agent Name"
                                        wire:model='search_sub_agent' wire:keyup="filterSubAgent" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.subagent') }} {{ __('tablevars.list') }}</h4>

                            <div>
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
                                            <th>{{ __('tablevars.agent_code') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.sub_agent_name') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.mobile') }}</th>
                                            <th>{{ __('tablevars.email') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{ dd($subAgents) }} --}}
                                        @forelse ($subAgents as $key => $agent)
                                            <tr>
                                                <td>{{ $key + $subAgents->firstItem() }}</td>
                                                <td>{{ $agent->agent_id ?? '---' }}</td>
                                                <td>{!! $agent->agency->agency_name ?? '---' !!}</td>
                                                <td>{{ $agent->name ?? '---' }}</td>
                                                <td>{{ $agent->city ?? '---' }}</td>
                                                <td>{{ $agent->phone ?? '---' }}</td>
                                                <td>{{ $agent->email ?? '---' }}</td>
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
                                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('admin.agentlist.edit', $agent->id) }}"
                                                                wire:navigate data-bs-toggle="modal"
                                                                data-bs-target="#editModal" data-toggle="tooltip"
                                                                title="Edit">Edit</a> --}}

                                                            <a wire:click="resetPassword('{{ $agent->id }}')"
                                                                class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="tooltip" title="Reset Password">Reset
                                                                Password</a>
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
                                        wire:change='filterSubAgent'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $subAgents->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .table-responsive {
                min-height: 250px;
            }
        </style>
    </section>

</div>
