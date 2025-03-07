<div>
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
                                            <div
                                                class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                                <h3>{{ __('tablevars.flyer') }} {{ __('tablevars.list') }}</h3>
                                                <div>
                                                    <a class="btn btn-primary" href="{{ route('agent.flyer.create') }}"
                                                        title="Add Request">{{ __('tablevars.new') }}
                                                        {{ __('tablevars.flyer') }}</a>
                                                </div>
                                            </div>
                                            <div class="instruct-search-blk mb-0">
                                                <div class="show-filter all-select-blk">
                                                    <div class="row gx-2">
                                                        <div class="col-md-3 col-lg-3 col-item">
                                                            <label
                                                                class="form-control-label">{{ __('Flyer Title') }}</label>
                                                            <input type="text" class="form-control"
                                                                wire:model='title' placeholder="Search Flyer Title"
                                                                wire:keyup.debounce.500ms="filteFlyers">
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
                                                            <th width="4%">SL#</th>
                                                            <th>{{ __('tablevars.title') }}</th>
                                                            <th>{{ __('Header Image/Text') }}</th>
                                                            <th>{{ __('Footer Image/Text') }}</th>
                                                            <th>{{ __('Created Date') }}</th>
                                                            <th>{{ __('tablevars.action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($flyers as $key => $flyer)
                                                            <tr>
                                                                <td>{{ $key + $flyers->firstItem() }}</td>
                                                                <td>{{ $flyer->flyer_title }}</td>
                                                                <td>
                                                                    @if ($flyer->header_image && Helper::fileExists("flyers/$flyer->header_image"))
                                                                        <a href="{{ asset("storage/flyers/$flyer->header_image") }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset("storage/flyers/$flyer->header_image") }}"
                                                                                class="img-fluid shadow-light rounded mt-2"
                                                                                style="width: 50px;">
                                                                        </a>
                                                                    @else
                                                                        <img src="{{ asset('assets/img/flyer-header.jpg') }}"
                                                                            class="img-fluid shadow-light rounded mt-2"
                                                                            style="width: 50px;">
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($flyer->footer_image && Helper::fileExists("flyers/$flyer->footer_image"))
                                                                        <a href="{{ asset("storage/flyers/$flyer->footer_image") }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset("storage/flyers/$flyer->footer_image") }}"
                                                                                class="img-fluid shadow-light rounded mt-2"
                                                                                style="width: 50px;">
                                                                        </a>
                                                                    @else
                                                                        <img src="{{ asset('assets/img/flyer-footer.jpg') }}"
                                                                            class="img-fluid shadow-light rounded mt-2"
                                                                            style="width: 50px;">
                                                                    @endif
                                                                </td>
                                                                <td>{{ Helper::appDateTimeFormat($flyer->created_at) }}
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-primary btn-sm"
                                                                        title="Download PDF"
                                                                        wire:click='downloadPDF({{ $flyer->id }})'>
                                                                        <i class="fas fa-file-pdf"></i>
                                                                    </a>
                                                                    <a href="{{ route('agent.flyer.edit', $flyer->id) }}"
                                                                        class="btn btn-primary btn-sm" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9" align="center" class="text-danger">
                                                                    {{ __('tablevars.no_record') }}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div
                                                class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                                <div class="d-flex align-items-center mb-4">
                                                    <span
                                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                                    &nbsp;&nbsp;
                                                    <select name="per_page" id="per_page" wire:model='perPage'
                                                        class="form-control">
                                                        @foreach (Helper::getPerPageOptions() as $item)
                                                            <option value="{{ $item }}">{{ $item }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{ $flyers->links(data: ['scrollTo' => false]) }}
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

    <!-- Full-page Loader -->
    <div wire:loading wire:target="downloadPDF" class="loader-overlay">
        <div class="loader-wrapper">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-2 text-white">Generating PDF, please wait...</p>
        </div>
    </div>
</div>
@push('extra_css')
    <style>
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .spinner-border {
            width: 4rem;
            height: 4rem;
            color: white;
        }

    </style>
@endpush
