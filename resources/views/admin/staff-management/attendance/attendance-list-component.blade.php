<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.check') }} {{ __('tablevars.attendance') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.staff') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}"
                        wire:navigate>{{ __('tablevars.attendance') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.list') }}</div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('tablevars.search') }} {{ __('tablevars.staff') }}</h4>
                    {{-- <a href="{{ route('admin.booking.index') }}" class="btn btn-danger" wire:navigate><i
                            class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>{{ __('tablevars.department') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="agency_id" wire:model='staff_department_id'
                                    wire:change='getStaffs'>
                                    <option value="">{{ __('tablevars.select') }}
                                        {{ __('tablevars.department') }}</option>
                                    @foreach ($staff_departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agency_id')
                                    <span class="v-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>{{ __('tablevars.roles') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="agency_id" wire:model='staff_role_id'
                                    wire:change='getStaffs'>
                                    <option value="">{{ __('tablevars.select') }}
                                        {{ __('tablevars.roles') }}</option>
                                    @foreach ($staff_roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->staff_role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agency_id')
                                    <span class="v-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>{{ __('tablevars.staff') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="agency_id" wire:model='staffs'>
                                    <option value="">{{ __('tablevars.select') }}
                                        {{ __('tablevars.staff') }}</option>
                                    @if ($staffs != '')
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('agency_id')
                                    <span class="v-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <label class="label-header" for="search_status">Month and Year</label>
                            <input class="form-control" type="month" id="attendmonth" name="attendmonth"
                                wire:model='attend_month' wire:change='get_attendance_list'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('tablevars.attendance') }} {{ __('tablevars.details') }}</h4>
                </div>
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Hover</h4>
                            </div> --}}
                    <div class="card-body">


                        <table class="table table-hover col-12">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Wokring Hours</th>
                                    {{-- <th scope="col">Wokring Days</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($staff_attendance))
                                    {{-- {{ dd($staff_attendance['datesWithDayNames']) }} --}}
                                    @foreach ($staff_attendance['datesWithDayNames'] as $attendance)
                                        <tr
                                            style="background-color:{{ $attendance['day_name'] == 'Sunday' ? 'rgb(97, 177, 252)' : '' }} ">
                                            <td>{{ $attendance['date'] }}</td>
                                            @if ($attendance['day_name'] != 'Sunday')
                                                <td>10:00 AM</td>
                                                <td>07:00 PM</td>
                                                <td>9 Hours 00 Minutes</td>
                                            @else
                                                <td></td>
                                                <td>Sunday</td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{-- </div>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
