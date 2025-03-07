<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> {{ __('tablevars.manage') }} {{ __('tablevars.service') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage') }} {{ __('tablevars.service') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.services.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.service') }}</a></div>
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
                                    <input type="text" class="form-control" wire:model='search_name'
                                        placeholder="Search Name" wire:keyup="filterService">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.service') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a class="btn btn-icon btn-sm m-1 btn-primary"
                                    href="{{ route('admin.services.create') }}" data-toggle="tooltip"
                                    title="Add New">{{ __('tablevars.add_new') }}</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.service') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.price') }}</th>
                                            <th>{{ __('tablevars.service') }} {{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Services as $key => $services)
                                            <tr>
                                                <td>{{ $key + $Services->firstItem() }}</td>
                                                <td>{{ $services->name }}</td>
                                                <td>{{ number_format($services->price, 2) }}</td>
                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/service_image/' . $services->service_img) }}"
                                                        style="height: 100px; border-radius: 10px;width: 150px;">
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="pointer badge badge-{{ $services->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $services->id }})">
                                                        {{ $services->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.services.edit', $services->id) }}"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                data-toggle="tooltip"
                                                                wire:click='isDelete({{ $services->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterService'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Services->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
