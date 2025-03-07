<div class="main-content">
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
            <h1>{{ __('tablevars.Manageaward') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }} </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.award.index') }}"
                        wire:navigate>{{ __('tablevars.award') }}
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
                                    <label class="form-control-label">{{ __('tablevars.title') }} </label>
                                    <input type="text" class="form-control" wire:model='title'
                                        placeholder="Search Title" wire:keyup.debounce.500ms="filterAward">
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.award') }} </h4>
                            <a class="btn btn-icon btn-sm m-1 btn-primary" href="{{ route('admin.award.create') }}"
                                data-toggle="tooltip" title="Add Content">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>



                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="4%">SL#</th>
                                            <th>{{ __('tablevars.title') }} </th>
                                            <th>{{ __('tablevars.sub_title') }} </th>
                                            <th>{{ __('tablevars.description') }} </th>
                                            <th>{{ __('tablevars.action') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($Award as $key => $award)
                                            <tr>
                                                <td>{{ $key + $Award->firstItem() }}</td>
                                                <td>{{ $award->title ?? '' }}</td>
                                                <td>{{ $award->sub_title ?? '' }}</td>
                                                <td>{!! Str::words($award->description, 30, '....') !!}</td>

                                                <td>
                                                    <div style="cursor:pointer;"
                                                        class="pointer badge badge-{{ $award->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $award->id }})">
                                                        {{ $award->is_active == 1 ? 'Active' : 'Inactive' }}
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

                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.award.edit', $award->id) }}"
                                                                data-bs-toggle="modaltwo" data-bs-target="#editModal"
                                                                data-toggle="tooltip"
                                                                title="Edit">{{ __('tablevars.edit') }}</a>

                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                class="text-danger" title=" Trash"
                                                                wire:click='isDelete({{ $award->id }})'>Trash</a>

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
                                        wire:change='filterAward'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Award->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
