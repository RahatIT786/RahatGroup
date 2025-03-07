<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.ticket_booking') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ticket_booking') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.ticket.index') }}"
                        wire:navigate>{{ __('tablevars.ticket_booking') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.ticket_booking') }}</div>
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
                                        for="search_booking_id">{{ __('tablevars.booking_id') }}</label>
                                    <input type="text" name="search_booking_id" id="search_booking_id"
                                        class="form-control" placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_meheram">{{ __('tablevars.meheram_name') }}</label>
                                    <input type="text" name="search_meheram" id="search_meheram" class="form-control"
                                        placeholder="Search Meheram Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.ticket_booking') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.meheram_name') }}</th>
                                            <th>{{ __('tablevars.total_pax') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th>{{ __('tablevars.total_cost') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>15999</td>
                                            <td>Jyoti Ranjan Behera</td>
                                            <td>7</td>
                                            <td>26-02-2024</td>
                                            <td>580,000.00</td>
                                        </tr>
                                        {{-- @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse --}}
                                        <tr>
                                            <td>2</td>
                                            <td>74589</td>
                                            <td>Biswa Behera</td>
                                            <td>8</td>
                                            <td>26-02-2024</td>
                                            <td>759,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>74598</td>
                                            <td>Narendra saa</td>
                                            <td>9</td>
                                            <td>26-02-2024</td>
                                            <td>759,000.00</td>
                                        </tr>
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
