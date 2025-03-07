<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.package_type') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.packageType.index') }}"
                        wire:navigate>{{ __('tablevars.package_type') }} {{ __('tablevars.list') }}</a></div>
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
                                        for="search_package">{{ __('tablevars.package_type') }}</label>
                                    <input type="text" name="search_package" id="search_package" class="form-control"
                                        placeholder="Search Package" autocomplete="off" wire:model="search_package"
                                        wire:keyup="filterPackage">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.package_type') }} {{ __('tablevars.list') }}</h4>
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                class="btn btn-icon btn-sm m-1 btn-primary" data-bs-target="#addModal"
                                wire:click='resetForm' class="btn btn-icon btn-sm m-1 btn-primary" data-toggle="tooltip"
                                title="Add New Package">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.package_type') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($packages as $key => $package)
                                            <tr>
                                                <td>{{ $key + $packages->firstItem() }}</td>
                                                <td>{{ $package->package_type }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $package->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $package->id }})">
                                                        {{ $package->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                wire:click.prevent="getEditData({{ $package->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit">Edit</a>

                                                            <a href="javascript:void(0)"
                                                                data-toggle="tooltip" class="dropdown-item text-danger" title="Trash"
                                                                wire:click.prevent='isDelete({{ $package->id }})'>Trash</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                title="Duplicate"
                                                                wire:click='isDupicate({{ $package->id }})'
                                                                class="dropdown-item">{{ 'Duplicate' }}</a>
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
                                        wire:change='filterPackage'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $packages->links(data: ['scrollTo' => false]) }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Edit Modal --}}
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.edit_package_type') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form wire:submit="update">
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('tablevars.package_type') }}</label><span class="text-danger">*</span>
                                <input type="text" name="package_type" class="form-control"
                                    wire:model="package_type" placeholder="Enter {{ __('tablevars.package_type') }}"
                                    maxlength="50">
                                @error('package_type')
                                    <span class="v-msg-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">{{ __('tablevars.add_package_type') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form wire:submit="save">
                    {{-- <form> --}}
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('tablevars.package_type') }}</label><span class="text-danger">*</span>
                                <input type="text" name="package_type" class="form-control"
                                    wire:model="package_type" placeholder="Enter {{ __('tablevars.package_type') }}"
                                    maxlength="50">
                                @error('package_type')
                                    <span class="v-msg-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('extra_scripts')
@endpush
