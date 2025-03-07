<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.salary_listing') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.staff-salary.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.salary_listing') }}
                        {{ __('tablevars.list') }}</a></div>
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

                                <div class="col-md-3 col-lg-3 col-item">
                                    <label>{{ __('tablevars.select') }} {{ __('tablevars.month') }}
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model="month" wire:change="changeInput">
                                        <option value="">{{ __('tablevars.select') }} {{ __('tablevars.month') }}
                                        </option>
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}">
                                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                                        @endfor
                                    </select>
                                    @error('month')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-lg-3 col-item">
                                    <label>{{ __('tablevars.select') }} {{ __('tablevars.year') }}
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model="year" wire:change="changeInput">
                                        <option value="">{{ __('tablevars.select') }} {{ __('tablevars.year') }}
                                        </option>
                                        @for ($year = 2023; $year <= 2025; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.salary_listing') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.name') }}</th>
                                            <th>{{ __('tablevars.salary') }}( ₹ )</th>
                                            <th>{{ __('tablevars.workingday') }}</th>
                                            <th>{{ __('tablevars.calculated_salary') }}( ₹ )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($StaffSalary as $key => $staffsalary)
                                            <tr>
                                                <td>{{ $key + $StaffSalary->firstItem() }}</td>
                                                <td>{{ $staffsalary->first_name }} {{ $staffsalary->last_name }}</td>
                                                <td>{{ number_format($staffsalary->salary, 2) }}</td>
                                                <td>{{ $staffsalary->attendances->count() }}</td>
                                                <td>{{ number_format($staffsalary->calculated_salary, 2) }}</td>
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
                                        wire:change='filterStaff'>
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $StaffSalary->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

</div>
