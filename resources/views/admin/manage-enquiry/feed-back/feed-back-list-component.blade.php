<div class="main-content">
    @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
    <div wire:loading>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

        <section class="section">
            <div class="section-header">
                <h1>{{ __('tablevars.feed-back') }}</h1>
                <div class="section-header-button">

                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">{{ __('tablevars.manage-enquiry') }}
                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.feedback.index') }}"
                            wire:navigate>{{ __('tablevars.feed-back') }}</a></div>
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
                                    <label class="form-control-label">{{ __('tablevars.name') }}</label>
                                    <input type="text" class="form-control" wire:model='search_name'
                                        placeholder="Search Name" wire:keyup.debounce.500ms="filterfeedback">
                                </div>
                                <div class="col-3">
                                    <label class="form-control-label">{{ __('tablevars.email') }}</label>
                                    <input type="text" class="form-control" wire:model='search_email'
                                        placeholder="Search Email" wire:keyup.debounce.500ms="filterfeedback">
                                </div>
                                <!-- <div class="col-4 mb-2">
                                    <label class="label-header"
                                        for="search_sub_agent">{{ __('tablevars.sub_agent_name') }}</label>
                                    <input type="text" name="search_sub_agent" id="search_sub_agent"
                                        class="form-control" placeholder="Search Sub Agent Name"
                                        wire:model='search_sub_agent' wire:keyup="filterSubAgent" autocomplete="off">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.feed-back') }}</h4>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">SL#</th>
                                            <th width="20%">{{ __('tablevars.category') }}</th>
                                            <th width="20%">{{ __('tablevars.name') }}</th>
                                            <th width="18%">{{ __('tablevars.phone') }}</th>
                                            <th width="20%">{{ __('tablevars.email') }}</th>
                                            <th width="20%">{{ __('tablevars.message') }}</th>
                                            <th width="10%">{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($Feedback as $key => $feedback)
                                            <tr>
                                                <td>{{ $key + $Feedback->firstItem() }}</td>
                                                <td>{{ $feedback->feedback_cat }}</td>
                                                <td>{{ $feedback->cust_name }}</td>
                                                <td>{{ $feedback->cust_email }}</td>
                                                <td>{{ $feedback->cust_num }}</td>
                                                <!-- <td>{{ $feedback->cust_msg }}</td> -->
                                                <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#messageModal" wire:click="getfeedback({{ $feedback->id }})">
                                                    <i class="fas fa-eye"></i>
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


                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title=" Trash"
                                                                wire:click='isDelete({{ $feedback->id }})'>Trash</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" align="center" class="v-msg">
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
                                        wire:change='filterfeedback'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Feedback->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div wire:ignore.self class="modal fade" id="messageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">{{ __('tablevars.message') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($feedback_modal_data)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! $feedback_modal_data->cust_msg !!}
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
