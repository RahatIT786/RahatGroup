<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> {{ __('tablevars.shopping') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.kit_item') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.shopping.index') }}" wire:navigate>
                        {{ __('tablevars.shopping') }}</a></div>
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
                                    <label class="label-header" for="search_name">{{ __('tablevars.name') }}</label>
                                    <input type="text" class="form-control" wire:model='search_shp_name'
                                        placeholder="Search Name" wire:keyup="filterShopping">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.shopping') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a class="btn btn-icon btn-sm m-1 btn-primary"
                                    href="{{ route('admin.shopping.create') }}" data-toggle="tooltip"
                                    title="Add New">{{ __('tablevars.add_new') }}</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.price') }}</th>
                                            <th>{{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.description') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Shoppings as $key => $shopping)
                                            <tr>
                                                <td>{{ $key + $Shoppings->firstItem() }}</td>
                                                <td>{{ $shopping->shp_name }}</td>
                                                {{-- <td>{!! $shopping->description !!}</td> --}}
                                                <td>{{ number_format($shopping->price, 2) }}</td>

                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/shopping_image/' . $shopping->image) }}"
                                                        style="height: 100px; border-radius: 10px;width: 150px;">
                                                </td>
                                                <!-- <td width="50%">{!! $shopping->description !!}</td> -->
                                                <td><a href="javascript:void(0)"data-bs-toggle="modal"
                                                        data-bs-target="#descriptionModal"
                                                        wire:click="getContent({{ $shopping->id }})"> <i
                                                            class="fas fa-eye"></i></a></td>

                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="pointer badge badge-{{ $shopping->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $shopping->id }})">
                                                        {{ $shopping->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                wire:click='getModalContent({{ $shopping->id }})'
                                                                data-toggle="tooltip" title="View">View</a>


                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.shopping.edit', $shopping->id) }}"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Delete"
                                                                wire:click='isDelete({{ $shopping->id }})'>{{ __('tablevars.trash') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" align="center" class="v-msg">
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
                                        wire:change='filterShopping'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Shoppings->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div wire:ignore.self class="modal fade" id="descriptionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        {{ __('tablevars.shopping_content') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($shopping_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div> {!! $shopping_modal_data->description !!}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div style="max-width: 1000px;" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Shopping</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($modalData)
                        <table class="table table-striped">

                            <tr>
                                <th>{{ __('tablevars.name') }}</th>
                                <td>{{ $modalData->shp_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.price') }}</th>
                                <td>₹{{ number_format($modalData->price ?? '---') }}.00</td>
                            </tr>
                            <tr>
                                <th>{{ __('tablevars.shopping_image') }}</th>
                                <td>
                                    <img src="{{ asset('/storage/shopping_image/' . $modalData->image) }}"
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
