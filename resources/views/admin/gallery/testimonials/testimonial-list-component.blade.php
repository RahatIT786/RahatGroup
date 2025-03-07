<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.testimonial') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.gallery') }} {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.testimonial.index') }}"
                        wire:navigate>{{ __('tablevars.testimonial') }} {{ __('tablevars.list') }}</a></div>
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
                                    <label class="label-header" for="city">{{ __('tablevars.city') }}</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="Search City" autocomplete="off" wire:model='city'
                                        wire:keyup="filterTestimonial">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.testimonial') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary"
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
                                            <th>{{ __('tablevars.city') }}</th>
                                            <th>{{ __('tablevars.title') }}</th>
                                            <th>{{ __('tablevars.desc') }}</th>
                                            {{-- <th>{{ __('tablevars.video_url') }}</th> --}}
                                            <th>{{ __('tablevars.image') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($testimonials as $key => $testimonial)
                                            <tr>
                                                <td>{{ $key + $testimonials->firstItem() }}</td>
                                                @if (isset(Helper::service()[$testimonial->tour_type]))
                                                    <td>{{ Helper::service()[$testimonial->tour_type] }}</td>
                                                @else
                                                    <td>No Tour Type Found</td>
                                                @endif
                                                <td>{{ $testimonial->city->city_name ?? '-' }}</td>
                                                <td>{{ $testimonial->title ?? '-' }}</td>
                                                <td>{{ $testimonial->description ?? '-' }}</td>
                                                {{-- <td>{{ $testimonial->video_url ?? '-' }}</td> --}}
                                                <td class="p-2">
                                                    <img src="{{ asset('/storage/testimonial_image/' . $testimonial->image) }}"
                                                        alt="Testimonial Image"
                                                        style="height: 100px;border-radius: 10px;">
                                                </td>
                                                <td>
                                                    <div class="pointer badge badge-{{ $testimonial->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $testimonial->id }})">
                                                        {{ $testimonial->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('admin.testimonial.edit', $testimonial->id) }}">Edit</a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $testimonial->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterTestimonial'>
                                        @foreach (Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $testimonials->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
