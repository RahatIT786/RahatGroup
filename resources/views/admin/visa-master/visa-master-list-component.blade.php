<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.visa') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.visa') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.visa.index') }}"
                        wire:navigate>{{ __('tablevars.visa') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.visa') }}</div>
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
                                    <label class="label-header"
                                        for="search_booking_id">{{ __('tablevars.country') }}</label>
                                    <input type="text" name="country_name" id="country_name" class="form-control"
                                        placeholder="Search country_name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_meheram">{{ __('tablevars.visa') }}
                                        {{ __('tablevars.type') }}</label>
                                    <input type="text" name="visa_type" id="visa_type" class="form-control"
                                        placeholder="Search Visa Type" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.visa') }} {{ __('tablevars.list') }}</h4>
                            {{-- <a href="{{ route('admin.visaMaster.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.country') }} {{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.visa') }} {{ __('tablevars.type') }}</th>
                                            <th>{{ __('tablevars.visa') }} {{ __('tablevars.rate') }}</th>
                                            <th>{{ __('tablevars.status') }} & {{ __('tablevars.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Saudi Arabia</td>
                                            <td>Tourist Visa</td>
                                            <td>
                                                <a href="#"> <i class="fas fa-eye"></i></a>

                                            </td>
                                            <td>
                                                <div class="pointer badge badge-primary">Active</div>

                                                <div class="table-links d-flex">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                    <form id="#" action="#" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                        {{-- wire:model='perPage' wire:change='filterUsers'> --}}
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- {{ $users->links(data: ['scrollTo' => false]) }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

</div>
