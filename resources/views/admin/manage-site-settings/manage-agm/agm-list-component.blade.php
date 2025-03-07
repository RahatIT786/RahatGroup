<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.ManageAgm') }}</h1>
            <div class="section-header-button"></div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageAgm') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agm.index') }}"
                        wire:navigate>{{ __('tablevars.All_Agm') }}</a></div>
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
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-control-label">{{ __('tablevars.name') }}</label>
                                    <input type="text" class="form-control" wire:model="search_name"
                                        placeholder="Search Name" wire:keyup.debounce.500ms="filterAgm">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">{{ __('tablevars.status') }}</label>
                                    <select class="form-control" wire:model="search_status" wire:change="filterAgm">
                                        <option value="">{{ __('tablevars.all') }}</option>
                                        @foreach (\App\Helpers\Helper::status() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>{{ __('tablevars.Agm') }} </h4>
                                    <a class="btn btn-icon btn-sm m-1 btn-primary"
                                        href="{{ route('admin.agm.create') }}" data-toggle="tooltip"
                                        title="Add AGM">{{ __('tablevars.add') }}
                                        {{ __('tablevars.new') }}</a>
                                </div>

                                <div class="card">

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">SL#</th>
                                                        <th width="20%">{{ __('tablevars.name') }}</th>
                                                        <th width="20%">{{ __('tablevars.description') }}</th>
                                                        <th width="10%">{{ __('tablevars.status') }}</th>
                                                        <th width="10%">{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($agm as $key => $agms)
                                                        <tr>
                                                            <td>{{ $key + $agm->firstItem() }}</td>
                                                            <td>{{ $agms->name }}</td>
                                                            <td>
                                                                 {!! Str::words($agms->description, 30, '...') !!}
                                                            </td>

                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    class="pointer badge badge-{{ $agms->is_active == 1 ? 'primary' : 'danger' }}"
                                                                    wire:click="toggleStatus({{ $agms->id }})">
                                                                    {{ $agms->is_active == 1 ? 'Active' : 'Inactive' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button
                                                                        class="btn btn-primary btn-sm dropdown-toggle"
                                                                        type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-cog"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('admin.agm.edit', $agms->id) }}"
                                                                            wire:navigate data-bs-toggle="modal"
                                                                            data-bs-target="#editModal"
                                                                            data-toggle="tooltip"
                                                                            title="Edit">Edit</a>

                                                                        {{-- <a class="dropdown-item"
                                                                            href="{{ route('admin.agm.image', $agms->id) }}"
                                                                            wire:navigate data-bs-toggle="modal"
                                                                            data-bs-target="#editModal"
                                                                            data-toggle="tooltip" title="image">Add
                                                                            Image</a> --}}


                                                                        <a class="dropdown-item text-danger"
                                                                            href="javascript:void(0)"
                                                                            wire:click="isDelete({{ $agms->id }})">
                                                                            {{ __('tablevars.delete') }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-danger" align="center">
                                                                {{ __('tablevars.no_record') }}</td>
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
                                                <select name="per_page" id="per_page" class="form-control"
                                                    wire:model="perPage" wire:change="filterAgm">
                                                    @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $agm->links(data: ['scrollTo' => false]) }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>
</div>
