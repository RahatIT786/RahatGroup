<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.site_fee') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.sitePage.index') }}"
                        wire:navigate>{{ __('tablevars.site_fee') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.site_fee') }}
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
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="search_name">Fee Name</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        wire:model='search_name' wire:keyup="filterSetting"
                                        placeholder="Search Fee Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.site_fee') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.fee_name') }}</th>
                                            <th>{{ __('tablevars.fee_price') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Sitesettings as $key => $setting)
                                            <tr>
                                                <td>{{ $key + $Sitesettings->firstItem() }}</td>
                                                <td>{{ $setting->name ?? '---' }}</td>
                                                <td>₹{{ number_format($setting->price,2) ?? '---' }}</td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click.prevent="edit({{ $setting->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-toggle="tooltip" title="">Edit</a>
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
                                        wire:change='filterSetting'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $Sitesettings->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CRUD Modal -->
   
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Page</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="mb-3">
                            <label>{{ __('tablevars.fee_name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="About Us" id="name"
                                wire:model="name" placeholder="Please enter page name" maxlength="20">
                            @error('name')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('tablevars.fee_price') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" value="About Us" id="price"
                                wire:model="price" placeholder="Please enter page name"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4">
                            @error('price')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Update</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
</div>
