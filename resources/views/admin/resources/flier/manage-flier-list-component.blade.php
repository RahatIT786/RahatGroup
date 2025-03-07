<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.manage_flier') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageFlier.index') }}"
                        wire:navigate>{{ __('tablevars.manage_flier') }}
                        {{ __('tablevars.list') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.manage_flier') }}</div>
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
                                    <label class="label-header" for="search_code">Flier Code</label>
                                    <input type="text" name="search_code" id="search_code" class="form-control"
                                        wire:model='search_code' wire:keyup="filterFlier"
                                        placeholder="Search Flier Code" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_name">Services Name</label>
                                    <input type="text" name="search_name" id="search_name"
                                        class="form-control"wire:model='search_name' wire:keyup="filterFlier"
                                        placeholder="Search Services Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.manage_flier') }} {{ __('tablevars.list') }}</h4>
                            <a href="{{ route('admin.manageFlier.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.flier_code') }}</th>
                                            <th>{{ __('tablevars.service') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.comments') }}</th>
                                            <th>{{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Fliers as $key => $flier)
                                            <tr>

                                                <td>{{ $key + $Fliers->firstItem() }}</td>
                                                <td>{{ $flier->flier_code }}</td>
                                                <td>{{ $flier->service_name }}</td>
                                                <td>{{ $flier->comments }}</td>
                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/fliers/' . $flier->image) }}" alt="image" style="width: 150px;height: 100px;border-radius: 10px;">
                                                </td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $flier->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $flier->id }})">
                                                        {{ $flier->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.manageFlier.edit', $flier->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit Flier">Edit</a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger" data-toggle="tooltip"
                                                                title="Trash"
                                                                wire:click='isDelete({{ $flier->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterFlier'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Fliers->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
