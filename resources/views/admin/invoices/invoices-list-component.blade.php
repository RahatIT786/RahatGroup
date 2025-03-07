<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.invoices') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.invoices') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}"
                        wire:navigate>{{ __('tablevars.invoices') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.invoices') }}</div>
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
                                    <label class="label-header" for="search_name">Booking Id</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_email">Agency</label>
                                    <input type="text" name="search_email" id="search_email" class="form-control"
                                        placeholder="Search Agency" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.invoices') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.service') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.meheram_name') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th>{{ __('tablevars.pax') }}</th>
                                            <th>{{ __('tablevars.total_price') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                10002
                                            </td>
                                            <td>Group Tickets</td>
                                            <td>
                                                Javed Bhai
                                            </td>
                                            <td>
                                                AIHUT_Amir
                                            </td>

                                            <td>
                                                22-08-2023
                                            </td>
                                            <td>
                                                Adults: 30, Children: 3, Infants: 1
                                            </td>
                                            <td>
                                                1,571,000.00
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-cog" data-toggle="tooltip" title="Options"></i>
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#">Print</a>
                                                    </div>
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
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                10003
                                            </td>
                                            <td>Group</td>
                                            <td>
                                                Jyoti Bhai
                                            </td>
                                            <td>
                                                AIHUT_umh
                                            </td>

                                            <td>
                                                22-08-2023
                                            </td>
                                            <td>
                                                Adults: 30, Children: 3, Infants: 1
                                            </td>
                                            <td>
                                                1,571,000.00
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-cog" data-toggle="tooltip" title="Options"></i>
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#">Print</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                10003
                                            </td>
                                            <td>GrpTickets</td>
                                            <td>
                                                biswa verma
                                            </td>
                                            <td>
                                                AIHUT_Amir
                                            </td>

                                            <td>
                                                22-08-2023
                                            </td>
                                            <td>
                                                Adults: 30, Children: 3, Infants: 1
                                            </td>
                                            <td>
                                                1,571,000.00
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-cog" data-toggle="tooltip" title="Options"></i>
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="#">Print</a>
                                                    </div>
                                                </div>
                                            </td>
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
