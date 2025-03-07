<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.video_gallery') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.gallery') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.videoGallery.index') }}"
                        wire:navigate>{{ __('tablevars.video') }} {{ __('tablevars.list') }}</a></div>
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
                                {{-- <div class="col-3">
                                    <label class="label-header" for="search_meheram">{{ 'image Name' }}</label>
                                    <input type="text" name="image_name" wire:model='image_name' id="image_name"
                                        class="form-control" placeholder="Search image Name" autocomplete="off"
                                        wire:keyup="filtervideo">
                                </div> --}}
                                <div class="col-3">
                                    <label class="label-header" for="package_type">{{ __('tablevars.pkg_category') }}</label>
                                    <input type="text" name="package_type" id="package_type" class="form-control"
                                        placeholder="Search Package Category" autocomplete="off" wire:model='package_type'
                                        wire:keyup="filtervideo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.video_gallery') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.videoGallery.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.tour_type') }}</th>
                                            <th>{{ __('tablevars.pkg_category') }}</th>
                                            <th>{{ __('tablevars.type') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($videos as $key => $video)
                                            <tr>
                                                <td>{{ $key + $videos->firstItem() }}</td>
                                                @if (isset(Helper::service()[$video->service_id]))
                                                    <td>{{ Helper::service()[$video->service_id] }}</td>
                                                @else
                                                    <td>No Service Found</td>
                                                @endif
                                                <td>{{ $video->packagetype->package_type ?? '-' }}</td>
                                                @if (isset(Helper::type()[$video->type]))
                                                    <td>{{ Helper::type()[$video->type] }}</td>
                                                @else
                                                    <td>No Type Found</td>
                                                @endif
                                                <td>
                                                    <div class="pointer badge badge-{{ $video->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $video->id }})">
                                                        {{ $video->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.videoGallery.edit', $video->id) }}">Edit</a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $video->id }})'>{{ __('tablevars.trash') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" align="center" class="v-msg">
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
                                        wire:change='filtervideo'>
                                        @foreach (Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $videos->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
