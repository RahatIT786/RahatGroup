<div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="instruct-search-blk mb-0">
                        <div class="show-filter all-select-blk p-4">
                            <div class="row gx-2">
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
                                        @for ($year = 2020; $year <= 2030; $year++)
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
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="display-5">Staff Attendance Sheet</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark border-bottom">
                                    <tr>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Working Hour</th>
                                        <th>Working Day</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($dates as $date)
                                        @php
                                            $attendance = $attendances ? $attendances->firstWhere('attendance_date', $date['date']->toDateString()) : null;
                                        @endphp
                                        @if ($date['is_sunday'])
                                            <tr class="sunday-highlight">
                                                <td>{{ $date['date']->format('d-m-Y') }}</td>
                                                <td colspan='4' align="center">Sunday</td>
                                            </tr>
                                        @elseif ($date['status'] === 'Absent')
                                            <tr class="absent-highlight">
                                                <td>{{ $date['date']->format('d-m-Y') }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Absent</td>
                                            </tr>
                                        @else
                                        @php
                                        $workingDayClass = '';
                                        if ($date['is_sunday']) {
                                            $workingDayClass = 'sunday-highlight';
                                        } elseif ($date['status'] === 'Absent') {
                                            $workingDayClass = 'absent-highlight';
                                        } elseif ($attendance) {
                                            if ($attendance->work_day === 'Overtime') {
                                                $workingDayClass = 'overtime-highlight';
                                            } elseif ($attendance->work_day === 'Full Day') {
                                                $workingDayClass = 'fullday-highlight';
                                            } elseif ($attendance->work_day === 'No Day') {
                                                $workingDayClass = 'no-day-highlight';
                                            }
                                        }
                                    @endphp
                                            <tr class="{{ $workingDayClass }}">
                                                <td>{{ $date['date']->format('d-m-Y') }}</td>
                                                <td>
                                                    {{ $attendance ? \Carbon\Carbon::parse($attendance->log_in_time)->format('h:i A') : '' }}
                                                </td>
                                                <td>
                                                    {{ $attendance ? \Carbon\Carbon::parse($attendance->log_out_time)->format('h:i A') : '' }}
                                                </td>
                                                <td>{{ $attendance->total_hours ?? '' }}</td>
                                                <td>{{ $attendance->work_day ?? ''}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr><td colspan="5"></td></tr>
                                    <tr><td style="color: rgb(0, 123, 255);"><strong>Total days in this Month : </strong></td><td>{{ $totalDaysInMonth }}</td><td></td><td style="color: green;"><strong>Employee Total Full Days : </strong></td><td>{{ $totalFullDays }}</td></tr>
                                    <tr><td style="color: rgb(102, 16, 242);"><strong>Total Sundays:  </strong></td><td>{{ $totalSundays }}</td><td></td><td style="color: green;"><strong>Employee Total Overtime : </strong></td><td>{{ $totalOvertime }}</td></tr>
                                    {{-- <tr><td></td><td style="color: red;"><strong>Employee Total Absent Days : </strong></td><td>{{ $totalAbsentDays }}</td><td style="color: rgb(40, 167, 69);"><strong>Total Working Days : </strong></td><td>26</td></tr></tr> --}}
                                    <tr><td style="color: rgb(23, 162, 184);"><strong>Total Block Days : </strong></td><td>0</td><td></td><td style="color: red;"><strong>Total NoDays : </strong></td><td>{{ $totalWorkingDays }}</td></tr>
                                    <tr><td style="color: red;"><strong>Employee Total Absent Days : </strong></td><td>{{ $totalAbsentDays }}</td><td></td><td style="color: rgb(40, 167, 69);"><strong>Total Working Days : </strong></td><td>0</td></tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extra_css')
    <style>
        .sunday-highlight {
            background-color: orange !important;
        }

        .absent-highlight {
            background-color: pink !important;
            color: rgb(202, 27, 27);

        }

        .overtime-highlight {
            background-color: rgb(60, 170, 222) !important;
            color: white;
        }

        .fullday-highlight {
            background-color: rgb(106, 176, 209) !important;
            color: rgb(255, 255, 255);
        }
        .no-day-highlight {
            background-color: rgb(106, 176, 209) !important;
            color: rgb(255, 0, 0);
    }
    </style>
@endpush
