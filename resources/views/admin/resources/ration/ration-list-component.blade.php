<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.manage_ration') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ 'Resources Management' }}</div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.manage-ration.index') }}"
                        wire:navigate>{{ __('tablevars.manage_ration') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.manage_ration') }}</div>
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
                                    <label class="label-header" for="search_title">Title</label>
                                    <input type="text" name="search_title" id="search_title" class="form-control"
                                        placeholder="Search title" wire:model='search_title' wire:keyup="filterRation"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.manage_ration') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{ route('admin.manage-ration.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.ration_title') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rationData as $key => $RtrationData)
                                            <tr>
                                                <td>{{ $key + $rationData->firstItem() }}</td>
                                                <td>{{ App\Helpers\Helper::getCanonicalDate($RtrationData->txn_date) ?? '' }}
                                                </td>
                                                <td>{{ $RtrationData->ration_title }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $RtrationData->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $RtrationData->id }})">
                                                        {{ $RtrationData->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('admin.manage-ration.edit', $RtrationData->id) }}"
                                                                data-toggle="tooltip" title="Edit">Edit</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.manageRationView.index', $RtrationData->id) }}"
                                                                data-toggle="tooltip" title="View">View</a>

                                                            <a wire:click="downloadInvoice('{{ $RtrationData->id }}')"
                                                                class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="tooltip" title="Download Invoice">Download
                                                                Invoice</a>
                                                            <a href="javascript:void(0);" class="dropdown-item"
                                                                wire:click="exportToExcel('{{ $RtrationData->id }}')"
                                                                data-toggle="tooltip" title="Export To XLS">Export To
                                                                XLS</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Delete"
                                                                wire:click='isDelete({{ $RtrationData->id }})'>Trash</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
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
                                        wire:change='filterUsers'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $rationData->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .table-responsive {
            min-height: 250px;
        }
    </style>
</div>
