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
                                            <h3 class="m-0">{{ __('tablevars.manage') }} {{ __('tablevars.banner') }}
                                            </h3>
                                            <div>
                                                <a class="btn btn-primary" title="Add New"
                                                    href="{{ route('agent.banner.create') }}">{{ __('tablevars.add_new') }}</a>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.banner_title') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_banner_title'
                                                            placeholder="Search Banner Title"
                                                            wire:keyup="filterBannerTitle">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">{{ __('tablevars.#') }}</th>
                                                        <th width="20%">{{ __('tablevars.banner_title') }}</th>
                                                        <th width="20%">{{ __('tablevars.banner_image') }}</th>
                                                        <th width="20%">{{ __('tablevars.status') }}</th>
                                                        <th width="20%">{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($manageBanners as $key => $manageBanner)
                                                        <tr>
                                                            <td>{{ $key + $manageBanners->firstItem() }}</td>
                                                            <td>{{ $manageBanner->banner_title }}</td>
                                                            <td class="p-2">
                                                                <img src="{{ asset('/storage/banner_image/' . $manageBanner->banner_img) }}"
                                                                    style="height: 100px; border-radius: 10px;width: 150px;">
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    class="pointer badge badge-{{ $manageBanner->is_active == 1 ? 'primary' : 'danger' }}"
                                                                    wire:click="toggleStatus({{ $manageBanner->id }})">
                                                                    {{ $manageBanner->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                            href="{{ route('agent.banner.edit', $manageBanner->id) }}"
                                                                            data-toggle="tooltip"
                                                                            title="Edit">{{ __('tablevars.edit') }}</a>

                                                                        <a class="dropdown-item text-danger"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="tooltip" class="text-danger"
                                                                            title="Trash"
                                                                            wire:click='isDelete({{ $manageBanner->id }})'>{{ __('tablevars.trash') }}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" align="center" class="text-danger">
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
                                                    class="form-control" wire:change='filterBannerTitle'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $manageBanners->links(data: ['scrollTo' => false]) }}
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
