<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> {{ __('tablevars.manage') }} {{ __('tablevars.faq') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.faq') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.faq') }}
                    {{ __('tablevars.list') }}</div>
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
                                    <label class="label-header" for="search_faq">{{ __('tablevars.title') }}</label>
                                    <input type="text" name="search_faq" id="search_faq" class="form-control"
                                        wire:model='search_title' wire:keyup="filterFaq" placeholder="Search Faq Title"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.faq') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a class="btn btn-icon btn-sm m-1 btn-primary" href="{{ route('admin.faq.create') }}"
                                    data-toggle="tooltip" title="Add New">{{ __('tablevars.add_new') }}</a>
                            </div>

                            {{-- <button data-bs-toggle="modal" data-bs-target="#crudModal" class="btn btn-primary"
                                wire:click='resetForm'>{{ __('tablevars.add_new') }}</button> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.title') }}</th>
                                            <th>{{ __('tablevars.question') }}</th>
                                            <th>{{ __('tablevars.answer') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($manageFaqs as $key => $manageFaq)
                                            <tr>
                                                <td>{{ $key + $manageFaqs->firstItem() }}</td>
                                                <td>{{ $manageFaq->title }}</td>
                                                <td><a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#questionModal"
                                                        wire:click="getFaq({{ $manageFaq->id }})"> <i
                                                            class="fas fa-eye"></i></a></td>
                                                <td><a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#answerModal"
                                                        wire:click="getAnswer({{ $manageFaq->id }})"> <i
                                                            class="fas fa-eye"></i></a></td>

                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="pointer badge badge-{{ $manageFaq->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $manageFaq->id }})">
                                                        {{ $manageFaq->is_active == 1 ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('admin.faq.edit', $manageFaq->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger" title="Trash"
                                                                data-toggle="tooltip"
                                                                wire:click='isDelete({{ $manageFaq->id }})'>{{ __('tablevars.trash') }}</a>
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
                                        wire:change='filterFaq'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $manageFaqs->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal for question -->
    <div wire:ignore.self class="modal fade" id="questionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.question') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($faq_modal_data)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div>{!! $faq_modal_data->question !!}</div>
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

    <!-- Modal for answer -->
    <div wire:ignore.self class="modal fade" id="answerModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.answer') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($faq_modal_datas)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div>{!! $faq_modal_datas->answer !!}</div>
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
</div>
</div>
