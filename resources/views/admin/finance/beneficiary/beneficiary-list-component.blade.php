<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.manage_beneficiary') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.finance') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.beneficiary.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.manage_beneficiary') }}
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
                                        for="search_beneficiary">{{ __('tablevars.beneficiary') }}</label>
                                    <input type="text" name="search_beneficiary" id="search_beneficiary"
                                        class="form-control" placeholder="Search Beneficiary Name" autocomplete="off"
                                        wire:model="search_beneficiary" wire:keyup="filterBeneficiary">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.manage_beneficiary') }} {{ __('tablevars.list') }}</h4>
                            <a href="" data-bs-toggle="modal" data-bs-target="#crudModal" wire:click='resetForm'
                                class="btn btn-icon btn-sm m-1 btn-primary" data-toggle="tooltip"
                                title="Add New">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.beneficiary') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($beneficiarys as $key => $beneficiary)
                                            <tr>
                                                <td>{{ $key + $beneficiarys->firstItem() }}</td>
                                                <td>{{ $beneficiary->beneficiary_name }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $beneficiary->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $beneficiary->id }})">
                                                        {{ $beneficiary->is_active == 1 ? 'Active' : 'Inactive' }}
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

                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-bs-toggle="modal" data-bs-target="#crudModal"
                                                                wire:click.prevent="edit({{ $beneficiary->id }})"data-toggle="tooltip"
                                                                title="Edit">Edit</a>

                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                class="text-danger" data-bs-toggle="modal"
                                                                data-bs-target="#viewModal"
                                                                wire:click="getModalContent({{ $beneficiary->id }})"
                                                                data-toggle="tooltip" title="View"><i></i>View</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                wire:click.prevent='isDelete({{ $beneficiary->id }})'>Trash</a>
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
                                        wire:change='filterBeneficiary'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $beneficiarys->links(data: ['scrollTo' => false]) }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CRUD Modal -->
    <div wire:ignore.self class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crudModalLabel">
                                {{ $is_edit ? __('tablevars.edit_beneficiary') : __('tablevars.add_beneficiary') }}
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.beneficiary_name') }}</label><span
                                            class="text-danger">*</span>
                                        <input type="text" name="beneficiary_name" class="form-control"
                                            wire:model="beneficiary_name"
                                            placeholder="Enter {{ __('tablevars.beneficiary_name') }}"
                                            maxlength="100">
                                        @error('beneficiary_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"
                                class="btn btn-primary">{{ $is_edit ? 'Update' : 'Submit' }}</button>
                            <button type="button" class="btn btn-dark"
                                data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--View Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('tablevars.view_beneficiary') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.beneficiary') }}</th>
                                <td>{{ $modalData->beneficiary_name }}</td>
                            </tr>
                        </table>
                    @else
                        Loading...
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extra_scripts')
@endpush
