<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div class="filter-grp ticket-grp d-flex justify-content-between">

                                            <h4>{{ __('tablevars.manage') }} {{ __('tablevars.image_gallery') }}</h4>
                                            <div>
                                                <a class="btn btn-primary"
                                                    href="{{ route('agent.imageGallery.create') }}">{{ __('tablevars.add_new') }}</a>
                                                <a href="javascript:void(0)" style="color: white"
                                                    class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">{{ __('tablevars.event') }}
                                                            {{ __('tablevars.name') }}</label>
                                                        <input type="text" class="form-control" name='search_title'
                                                            wire:model='search_title' placeholder="Search Event Name"
                                                            wire:keyup.debounce.500ms="filterImageGallery">
                                                    </div>

                                                    {{-- <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.event') }} {{ __('tablevars.date') }}</label>
                                                        <input type="date" class="form-control"
                                                            wire:model='search_location'
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('tablevars.#') }}</th>
                                                        <th>{{ __('tablevars.event') }} {{ __('tablevars.name') }}</th>
                                                        <th>{{ __('tablevars.event') }} {{ __('tablevars.date') }}
                                                        </th>
                                                        <th>{{ __('tablevars.status') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($imageGallerys as $key => $imageGallery)
                                                        <tr>
                                                            <td>{{ $key + $imageGallerys->firstItem() }}</td>
                                                            <td>{{ $imageGallery->title }}</td>
                                                            <td>{{ Helper::formatCarbonDate($imageGallery->event_date) }}
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    class="pointer badge badge-{{ $imageGallery->is_active == 1 ? 'primary' : 'danger' }}"
                                                                    wire:click="toggleStatus({{ $imageGallery->id }})">
                                                                    {{ $imageGallery->is_active == 1 ? 'Active' : 'Inactive' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="ticket-grp mb-2 has-submenu">
                                                                    <button
                                                                        class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i
                                                                            class="fas fa-cog" data-toggle="tooltip"
                                                                            title="Options"></i></button>
                                                                    <div class="dropdown-menu"
                                                                        x-placement="bottom-start"
                                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('agent.imageGallery.edit', $imageGallery->id) }}"
                                                                            data-toggle="tooltip"
                                                                            title="Edit">{{ __('tablevars.edit') }}</a>
                                                                        <a href="javascript:void(0)"
                                                                            data-toggle="tooltip" class="dropdown-item"
                                                                            title="Delete"
                                                                            wire:click='isDelete({{ $imageGallery->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                                <select name="per_page" id="per_page" wire:model='perPage'
                                                    class="form-control" wire:change='filterImageGallery'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $imageGallerys->links(data: ['scrollTo' => false]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
