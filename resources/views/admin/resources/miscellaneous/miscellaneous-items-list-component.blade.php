<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.miscellaneous_items') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.miscellaneousItems.index') }}"
                        wire:navigate>{{ __('tablevars.miscellaneous_items') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.miscellaneous_items') }}
                    {{ __('tablevars.list') }}</div>
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
                                    <label class="label-header" for="search_items">{{ __('tablevars.items') }}</label>
                                    <input type="text" name="search_items" id="search_items" class="form-control"
                                        placeholder="Search items" autocomplete="off" wire:model='search_items'
                                        wire:keyup="filterMiscellaneous">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.miscellaneous_items') }} {{ __('tablevars.list') }}</h4>
                            <a href="javascript:void(0)" wire:click='resetForm' data-bs-toggle="modal"
                                class="btn btn-icon btn-sm m-1 btn-primary" data-bs-target="#addModal"
                                data-toggle="tooltip" title="Add New">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.items') }}</th>
                                            <th>{{ __('tablevars.value') }} ( ₹ )</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Miscellaneous as $key => $items)
                                            <tr>
                                                <td>{{ $key + $Miscellaneous->firstItem() }}</td>
                                                <td>{{ $items->item ?? '---' }}</td>
                                                <td>{{ number_format($items->item_value,2) ?? '---' }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $items->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="statusConfirm({{ $items->id }})">
                                                        {{ $items->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                wire:click.prevent="getEditData({{ $items->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="Edit">Edit</a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                title="Trash" class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $items->id }})'>Trash</a>
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
                                        wire:change='filterMiscellaneous'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Miscellaneous->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">{{ __('tablevars.miscellaneous_items') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form wire:submit="save">
                    {{-- <form> --}}
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="mb-3">
                            <label for="item" class="form-label">{{ __('tablevars.item') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item" id="item"
                                placeholder="Please enter item" wire:model='item' maxlength="50">
                            @error('item')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">{{ __('tablevars.item') }}
                                {{ __('tablevars.value') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item_value" id="item_value"
                                placeholder="Please enter item value" wire:model='item_value'
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="9">
                            @error('item_value')
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

    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Miscellaneous Items</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form wire:submit="update">
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="mb-3">
                            <label>{{ __('tablevars.item') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item" value="Umrah Kit"
                                id="item" placeholder="Please enter item name" wire:model='item'
                                maxlength="50">
                            @error('item')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('tablevars.item') }} {{ __('tablevars.value') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="item_value" value="560 INR"
                                id="item_value" placeholder="Please item enter value" wire:model='item_value'
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="9">
                            @error('item_value')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
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
</div>
