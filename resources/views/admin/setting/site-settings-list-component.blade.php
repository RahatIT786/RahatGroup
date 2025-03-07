<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.setting') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.sitesettings.index') }}" wire:navigate>{{ __('tablevars.setting') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.setting') }}</div>
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
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_parameter_name">Parameter Name</label>
                                    <input type="text" name="search_parameter_name" id="search_parameter_name" class="form-control"
                                        placeholder="Search Parameter Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.setting') }} {{ __('tablevars.list') }}</h4>
                            {{-- <div>
                                <a href="{{ route('admin.agentlist.create') }}" class="btn btn-primary"
                            wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                                <a style="color: white" class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                           <th>Parameter Name</th>
                                           <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Facebook Link</td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#crudModal"
                                                            wire:click.prevent="edit({{ 1 }})"
                                                            class="dropdown-item">Edit</a>
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


    {{-- <div wire:ignore.self class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true"> --}}

        <div wire:ignore.self="" class="modal fade" id="crudModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="crudModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            {{-- <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}"> --}}
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crudModalLabel">Edit Parameter</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Parameter Name</label><span
                                        class="text-danger">*</span>
                                    <input type="text" name="name" value="Facebook Link" class="form-control" wire:model="name"
                                        placeholder="Enter Parameter Name">
                                    @error('name')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-dark"
                            data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Agent Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Agency Code</th>
                            <td>15998</td>
                        </tr>
                        <tr>
                            <th>Agency</th>
                            <td>Jyoti</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>Cash</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>123456789</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>AL DEAFAH INTERNATIONAL PVT LTD</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>HDFC BANK</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>50200080189220</td>
                        </tr>
                    </table>
                    
                    {{-- @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <td>{{ $modalData->name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <div class="badge badge-{{ $modalData->is_active == 1 ? 'primary' : 'danger' }}">
                                        {{ $modalData->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @else
                        loading........
                    @endif --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
</div>
