<div class="page-content">
    <section class="section">
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
                                                <h3 class="m-0">Manage FAQ</h3>
                                                <div>
                                                    <a class="btn btn-icon btn-sm m-1 btn-primary"
                                                        href="{{ route('agent.faq.create') }}" data-toggle="tooltip"
                                                        title="Add New">Add New</a>
                                                </div>
                                            </div>
                                            <div class="instruct-search-blk mb-0">
                                                <div class="show-filter all-select-blk">
                                                    <div class="row gx-2">
                                                        <div class="col-md-3 col-lg-3 col-item">
                                                            <label
                                                                class="form-control-label">{{ __('tablevars.title') }}</label>
                                                            <input type="text" class="form-control"
                                                                wire:model='search_title' placeholder="Search Faq Title"
                                                                wire:keyup.debounce.500ms="filterFaq">
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
                                                            <th width="20%">SL#</th>
                                                            <th width="20">{{ __('tablevars.title') }}</th>
                                                            <th width="20">{{ __('tablevars.question') }}</th>
                                                            <th width="20">{{ __('tablevars.answer') }}</th>
                                                            <th width="20">{{ __('tablevars.status') }}</th>
                                                            <th width="20%">{{ __('tablevars.action') }}</th>
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
                                                                        wire:click="getAnswer({{ $manageFaq->id }})">
                                                                        <i class="fas fa-eye"></i></a></td>
                                                                <td>
                                                                    <a href="javascript:void(0)"
                                                                        class="pointer badge badge-{{ $manageFaq->is_active == 1 ? 'primary' : 'danger' }}"
                                                                        wire:click="toggleStatus({{ $manageFaq->id }})">
                                                                        {{ $manageFaq->is_active == 1 ? 'Active' : 'Inactive' }}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <div class="ticket-grp mb-2 has-submenu">
                                                                        <button
                                                                            class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                                data-toggle="tooltip"
                                                                                title="Options"></i></button>
                                                                        <div class="dropdown-menu"
                                                                            x-placement="bottom-start"
                                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('agent.faq.edit', $manageFaq->id) }}"
                                                                                data-bs-toggle="modaltwo"
                                                                                data-bs-target="#editModal"
                                                                                data-toggle="tooltip"
                                                                                title="Edit">{{ __('tablevars.edit') }}</a>
                                                                            <a class="dropdown-item text-danger"
                                                                                href="javascript:void(0)"
                                                                                data-toggle="tooltip"
                                                                                class="text-danger" title="Trash"
                                                                                wire:click='isDelete({{ $manageFaq->id }})'>Trash</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="10" align="center"
                                                                    class="v-msg text-danger">
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
                                                        class="form-control" wire:change='filterFaq'>
                                                        @foreach (Helper::getPerPageOptions() as $item)
                                                            <option value="{{ $item }}">{{ $item }}
                                                            </option>
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
