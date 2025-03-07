<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> {{ __('tablevars.manage') }} {{ __('tablevars.kit_category') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage') }} {{ __('tablevars.kit_category') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.kitCategory.index') }}" wire:navigate>
                        {{ __('tablevars.kit_category') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.list') }}</div>
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
                                    <label class="label-header" for="search_name">{{ __('tablevars.kit_name') }}</label>
                                    <input type="text" class="form-control" wire:model='search_name'
                                        placeholder="Search Category" wire:keyup="filterKitCategory">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.kit_category') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a class="btn btn-icon btn-sm m-1 btn-primary"
                                    href="{{ route('admin.kitCategory.create') }}" data-toggle="tooltip"
                                    title="Add New">{{ __('tablevars.add_new') }}</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.category') }}</th>
                                            <th>{{ __('tablevars.kit_name') }}</th>
                                            <th>{{ __('tablevars.kit_item') }}</th>
                                            <th>{{ __('tablevars.price') }}</th>
                                            <th>{{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($KitCategory as $key => $kitcategory)
                                            <tr>
                                                <td>{{ $key + $KitCategory->firstItem() }}</td>
                                                <td>{{ $kitcategory->serviceType->name ?? '' }}</td>
                                                <td>{{ $kitcategory->name }}</td>
                                                <td>
                                                    @if ($kitcategory->kit_item_id)
                                                        {{ $kitcategory->getKitItemsNames() }}
                                                    @else
                                                        No Kit Items
                                                    @endif
                                                </td>
                                                <td>{{ number_format($kitcategory->price, 2) }}</td>
                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/KitCategory_Image/' . $kitcategory->kit_category_img) }}"
                                                        style="height: 100px; border-radius: 10px;width: 150px;">
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="pointer badge badge-{{ $kitcategory->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $kitcategory->id }})">
                                                        {{ $kitcategory->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </a>
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
                                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                                wire:click='getModalContent({{ $kitcategory->id }})'
                                                                data-toggle="tooltip" title="View">View</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.kitCategory.edit', $kitcategory->id) }}"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                data-toggle="tooltip"
                                                                wire:click='isDelete({{ $kitcategory->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterKitCategory'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $KitCategory->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--View Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div style="max-width: 1000px;" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Kit Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">
                            <tr>
                                <th>{{ __('tablevars.category') }}</th>
                                <td>{{ $kitcategory->serviceType->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.kit_name') }}</th>
                                <td>{{ $modalData->name ?? '' }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('tablevars.kit_item') }}</th>
                                <td>
                                    @if ($kitcategory->kit_item_id)
                                        {{ $kitcategory->getKitItemsNames() }}
                                    @else
                                        No Kit Items
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.price') }}</th>
                                <td>₹{{ number_format($modalData->price ?? '---') }}.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.image') }}</th>
                                <td>
                                    <img src="{{ asset('/storage/KitCategory_Image/' . $modalData->kit_category_img) }}"
                                        style="height: 100px; border-radius: 10px;width: 150px;">
                                </td>
                            </tr>
                        </table>
                    @else
                        {{ __('tablevars.loading') }}
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
