<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.agents_accounts') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.agents_accounts') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.clientReport.index') }}"
                        wire:navigate>{{ __('tablevars.agents_accounts') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.agents_accounts') }}</div>
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
                                        for="search_booking">{{ __('tablevars.booking_id') }}</label>
                                    <input type="text" name="search_booking" id="search_booking" class="form-control"
                                        placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_agency">{{ __('tablevars.agency') }}</label>
                                    <input type="text" name="search_agency" id="search_agency" class="form-control"
                                        placeholder="Search Agency" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.agents_accounts') }} {{ __('tablevars.list') }}</h4>
                            <div>
                                <a href="{{ asset('/storage/sample_pdf/Agents-Accounts-Detail.xls') }}"
                                    style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                    into excel</a>
                                <a href="{{ asset('/storage/sample_pdf/my-pdf-voucher.pdf') }}" style="color: white"
                                    class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.software_id') }}</th>
                                            <th>{{ __('tablevars.service') }}</th>
                                            <th>{{ __('tablevars.dep_city') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th>{{ __('tablevars.package_type') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.airlines') }}</th>
                                            <th>{{ __('tablevars.mobile') }}</th>
                                            <th>{{ __('tablevars.sharing') }}</th>
                                            <th>{{ __('tablevars.days') }}</th>
                                            <th>{{ __('tablevars.ticket') }}</th>
                                            <th>{{ __('tablevars.visa') }}</th>
                                            <th>{{ __('tablevars.beds') }}</th>
                                            <th>{{ __('tablevars.amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>08-07-2023</td>
                                            <td>10003</td>
                                            <td>Umrah</td>
                                            <td>Mumbai</td>
                                            <td>AIHUT_Musharrafa</td>
                                            <td>09-08-2023</td>
                                            <td>SemiDeluxe</td>
                                            <td>Sultana asgarali khan</td>
                                            <td>Qatar airways</td>
                                            <td>7506001472</td>
                                            <td>General Sharing </td>
                                            <td>14</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>83000.00</td>
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
                                            <td>08-07-2023</td>
                                            <td>10003</td>
                                            <td>Only Visas</td>
                                            <td>Mumbai</td>
                                            <td>AIHUT_Musharrafa</td>
                                            <td>09-08-2023</td>
                                            <td>Deluxe</td>
                                            <td>Mustaq Ahemad M Y Khan</td>
                                            <td>Saudi Airlines</td>
                                            <td>916758694</td>
                                            <td>Double</td>
                                            <td>14</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>83000.00</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>08-07-2023</td>
                                            <td>10003</td>
                                            <td>Group Tickets</td>
                                            <td>Mumbai</td>
                                            <td>AIHUT_Musharrafa</td>
                                            <td>09-08-2023</td>
                                            <td>SemiDeluxe</td>
                                            <td>Mohammad Yunus</td>
                                            <td>Qatar airways</td>
                                            <td>8139996383</td>
                                            <td>General Sharing </td>
                                            <td>14</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>83000.00</td>
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
