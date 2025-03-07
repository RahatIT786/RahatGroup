<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.cartype') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.cartype') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageCarType.index') }}"
                        wire:navigate>{{ __('tablevars.cartype') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.cartype') }}</div>
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
                                        for="search_cartype">{{ __('tablevars.cartype') }}</label>
                                    <input type="text" name="search_cartype" id="search_cartype" class="form-control"
                                        placeholder="Search Car Type" autocomplete="off" wire:model='search_cartype'
                                        wire:keyup="filterCarType">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.cartype') }} {{ __('tablevars.list') }}</h4>
                            <button data-bs-toggle="modal" data-bs-target="#crudModal" class="btn btn-primary"
                                wire:click='resetForm'>{{ __('tablevars.add_new') }}</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.cartype') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($CarType as $key => $cartype)
                                            <tr>
                                                <td>{{ $key + $CarType->firstItem() }}</td>
                                                <td>{{ $cartype->car_type }}
                                                </td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $cartype->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $cartype->id }})">
                                                        {{ $cartype->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                wire:click.prevent="edit({{ $cartype->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#crudModal"
                                                                data-toggle="tooltip" title="Edit Cartype">Edit</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Delete Cartype"
                                                                wire:click='isDelete({{ $cartype->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterCarType'>
                                        @foreach (App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $CarType->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div wire:ignore.self class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crudModalLabel">{{ $is_edit ? 'Edit CarType' : 'Add CarType' }}
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ 'CarType' }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="sector_name"
                                            wire:model="car_type" id="car_type" placeholder="Please enter Car Type"
                                            maxlength="200">
                                        @error('car_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"
                                class="btn btn-primary">{{ $is_edit ? 'Update' : 'Save' }}</button>
                            <button type="button" class="btn btn-dark"
                                data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
