<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.ration_view_detail') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.manageRationView.index', $id) }}"
                        wire:navigate>{{ __('tablevars.ration_view_detail') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.ration_view_detail') }}</div>
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
                                    <label class="label-header" for="main_item">Item Name</label>
                                    <input type="text" name="main_item" id="main_item" class="form-control"
                                        placeholder="Search Item Name" autocomplete="off" wire:model="main_item"
                                        wire:keyup="filterRation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.manage_ration') }} {{ __('tablevars.list') }}</h4>
                            {{-- <a href="{{ route('admin.manage-ration.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.items_name') }}</th>
                                            <th>{{ __('tablevars.desc') }}</th>
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.weight') }}</th>
                                            <th>{{ __('tablevars.rate') }}</th>
                                            <th>{{ __('tablevars.total') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rationViewData as $key => $RtrationData)
                                            <tr>
                                                <td>{{ $key + $rationViewData->firstItem() }}</td>
                                                <td>{{ $RtrationData->main_item ?? '---' }}</td>
                                                <td>{{ $RtrationData->description ?? '---' }}</td>
                                                <td>{{ $RtrationData->city->city_name ?? '---' }}</td>
                                                <td>{{ $RtrationData->weight ?? '---' }}</td>
                                                <td>{{ $RtrationData->rate ?? '---' }}</td>
                                                <td>{{ $RtrationData->total_rate ?? '---' }}</td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $RtrationData->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $RtrationData->id }})">
                                                        {{ $RtrationData->is_active == 1 ? 'Active' : 'Inactive' }}
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

                                                            <a class="dropdown-item" data-toggle="tooltip"
                                                                title="Edit"
                                                                href="{{ route('admin.manageRationView.edit', $RtrationData->id) }}">Edit</a>

                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                class="dropdown-item text-danger" title="Delete"
                                                                wire:click='isDelete({{ $RtrationData->id }})'>Trash</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" align="center" class="v-msg">
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
                                        wire:change='filterUsers'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $rationViewData->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
