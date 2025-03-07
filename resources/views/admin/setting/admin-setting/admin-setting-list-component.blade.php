<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.admin_setting') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}
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
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_parameter">Parameter Name</label>
                                    <input type="text" name="search_parameter" id="search_parameter"
                                        class="form-control" wire:model='search_parameter' wire:keyup="filterSetting"
                                        placeholder="Search Parameter Name" autocomplete="off">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_value">Parameter Value</label>
                                    <input type="text" name="search_value" id="search_value"
                                        class="form-control"wire:model='search_value' wire:keyup="filterSetting"
                                        placeholder="Search Parameter Value" autocomplete="off">
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
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($AdminSettings as $key => $setting)
                                            <tr>
                                                <td>{{ $key + $AdminSettings->firstItem() }}</td>
                                                <td>{{ $setting->parameter_name ?? '---' }}</td>
                                                <td>{{ $setting->parameter_value ?? '---' }}</td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click.prevent="edit({{ $setting->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="">Edit</a>
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
                                    <select name="per_page" id="per_page" class="form-control"wire:model='perPage'
                                        wire:change='filterSetting'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $AdminSettings->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CRUD Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" x-data="{ show: @entangle('is_edit').defer }" x-show="show"
        @close-modal.window="show = false">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ $is_edit ? 'Edit Page' : 'Add Page' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ _('tablevars.parameter') }} {{ _('tablevars.name') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="parameter_name" wire:model="parameter_name"
                                id="parameter_name" placeholder="Please enter parameter name"
                                {{ $is_edit ? '' : 'readonly' }}>
                            @error('parameter_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ _('tablevars.parameter') }} {{ _('tablevars.value') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="parameter_value"
                                wire:model="parameter_value" id="parameter_value"
                                placeholder="Please enter parameter value" maxlength="100">
                            @error('parameter_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:loading.class="disabled">
                            Update
                        </button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
