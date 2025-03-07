<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.admin_setting') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.admin_setting') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.sitePage.index') }}"
                        wire:navigate>{{ __('tablevars.admin_setting') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.admin_setting') }}</div>
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
                                    <label class="label-header" for="search_parameter">{{ __('tablevars.parameter') }}
                                        {{ __('tablevars.name') }}</label>
                                    <input type="text" name="search_parameter" id="search_parameter"
                                        class="form-control" placeholder="Search parameter" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.admin_setting') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.parameter') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.parameter') }} {{ __('tablevars.value') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Transport Title</td>
                                            <td>Rahat Travels Of India</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
                                                <div class="pointer badge badge-primary">Active</div>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-toggle="tooltip"
                                                            title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Transport Address</td>
                                            <td> Rahat Travels Of India</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
                                                <div class="pointer badge badge-primary">Active</div>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-toggle="tooltip"
                                                            title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Transport Remark</td>
                                            <td>Please Send Urdu Speaking Driver If Possible</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
                                                <div class="pointer badge badge-primary">Active</div>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-toggle="tooltip"
                                                            title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Minimum Price Set In Percentage(of total cost)</td>
                                            <td>15</td>
                                            <td>
                                                {{-- <div class="pointer badge badge-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                    wire:click="toggleStatus({{ $user->id }})">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </div> --}}
                                                <div class="pointer badge badge-primary">Active</div>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-toggle="tooltip" title="Edit City">Edit</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                        {{-- wire:model='perPage' wire:change='filterUsers'> --}}
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- {{ $users->links(data: ['scrollTo' => false]) }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Admin Setting</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form>
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="mb-3">
                            <label>{{ __('tablevars.parameter') }} {{ __('tablevars.name') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="parameter_name" value="Abu Dhabi"
                                id="parameter_name" placeholder="Please enter parameter name">
                            @error('parameter_name')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('tablevars.parameter') }} {{ __('tablevars.value') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="parameter_value" value="Abu Dhabi"
                                id="parameter_value" placeholder="Please enter parameter value">
                            @error('parameter_value')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
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
