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
                                            <h4>Manage Video Gallery</h4>
                                            <div>
                                                <a class="btn btn-primary"
                                                    href="{{ route('agent.videoGallery.create') }}"
                                                    class="ticket-btn-grp">Add New</a>
                                                {{-- <a href="{{ asset('/storage/sample_pdf/my-pdf-voucher.pdf') }}"
                                                    style="color: white" class="btn btn-warning"><i
                                                        class="fas fa-print"></i> Print</a> --}}
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
                                                            wire:keyup.debounce.500ms="filterVideoGallery">
                                                    </div>
                                                    {{-- <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">{{ __('tablevars.event') }}
                                                            {{ __('tablevars.date') }}</label>
                                                        <input type="date" class="form-control"
                                                            name='search_event_date' wire:model='search_event_date'
                                                            wire:keyup.debounce.500ms="filterVideoGallery">
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
                                                        <th width="4%">SL#</th>
                                                        <th>{{ __('tablevars.event') }} {{ __('tablevars.name') }}</th>
                                                        <th>{{ __('tablevars.event') }} {{ __('tablevars.date') }}
                                                        </th>
                                                        <th>{{ __('tablevars.image') }}</th>
                                                        {{-- <th>{{ __('tablevars.video') }}</th> --}}
                                                        <th>{{ __('tablevars.status') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($videoGalleres as $key => $videoGallery)
                                                        <tr>
                                                            <td>{{ $key + $videoGalleres->firstItem() }}</td>
                                                            <td>{{ $videoGallery->title }}</td>
                                                            <td>{{ Helper::formatCarbonDate($videoGallery->event_date) }}
                                                            </td>
                                                            <td class="p-2">
                                                                <img src="{{ asset('/storage/event_image/' . $videoGallery->image) }}"
                                                                    style="height: 100px; border-radius: 10px;width: 150px;">
                                                            </td>
                                                            {{-- <td class="p-2">
                                                                @if ($videoGallery->video)
                                                                    <video width="150" height="100" controls>
                                                                        <source
                                                                            src="{{ asset('storage/event_video/' . $videoGallery->video) }}"
                                                                            type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                @else
                                                                    <span class="no-video">No video found</span>
                                                                @endif
                                                            </td> --}}

                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    class="pointer badge badge-{{ $videoGallery->is_active == 1 ? 'primary' : 'danger' }}"
                                                                    wire:click="toggleStatus({{ $videoGallery->id }})">
                                                                    {{ $videoGallery->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                            href="{{ route('agent.videoGallery.edit', $videoGallery->id) }}"
                                                                            data-toggle="tooltip"
                                                                            title="Edit">{{ __('tablevars.edit') }}</a>
                                                                        <a href="javascript:void(0)"
                                                                            data-toggle="tooltip" class="dropdown-item"
                                                                            title="Delete"
                                                                            wire:click='isDelete({{ $videoGallery->id }})'>{{ __('tablevars.trash') }}</a>
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
                                                    class="form-control" wire:change='filterVideoGallery'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $videoGalleres->links(data: ['scrollTo' => false]) }}
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
