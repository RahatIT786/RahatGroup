<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.ManageContentPage') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }} </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.content.index') }}"
                        wire:navigate>{{ __('tablevars.All_ContentPage') }}
                    </a></div>

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
                                    <label class="form-control-label">{{ __('tablevars.page') }}
                                        {{ __('tablevars.name') }}</label>
                                    <input type="text" class="form-control" wire:model='page_name'
                                        placeholder="Search Page Name" wire:keyup.debounce.500ms="filterContent">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.content_page') }} </h4>
                            <a class="btn btn-icon btn-sm m-1 btn-primary" href="{{ route('admin.content.create') }}"
                                data-toggle="tooltip" title="Add Content">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>



                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="4%">SL#</th>
                                            <th>{{ __('tablevars.page') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.page_content') }} </th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($userContent as $key => $userContents)
                                            <tr>
                                                <td>{{ $key + $userContent->firstItem() }}</td>
                                                <td>{{ $userContents->pagecontent->page_name ?? '' }}</td>
                                                <!-- <td width="50%">{{ $userContents->description ?? '' }}</td> -->
                                                <td><a href="javascript:void(0)"data-bs-toggle="modal"
                                                        data-bs-target="#descriptionModal"
                                                        wire:click="getContent({{ $userContents->id }})"> <i
                                                            class="fas fa-eye"></i></a></td>

                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.content.edit', $userContents->id) }}"data-bs-toggle="modaltwo"
                                                                data-bs-target="#editModal" data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title=" Trash"
                                                                wire:click='isDelete({{ $userContents->id }})'>Trash</a>


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
                                        wire:change='filterContent'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $userContent->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div wire:ignore.self class="modal fade" id="descriptionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        {{ __('tablevars.page_content') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($content_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div> {!! $content_modal_data->description !!}</div>
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
</div>







</div>
