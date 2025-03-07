<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.roles') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.roles') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}"
                        wire:navigate>{{ __('tablevars.roles') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.staff') }}</h4>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.staff') }} {{ __('tablevars.first_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control"
                                            wire:model="first_name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.staff') }} {{ __('tablevars.last_name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control"
                                            wire:model="last_name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" wire:model="email">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.mobile') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" class="form-control" wire:model="mobile">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.role') }} <span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='role_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.role') }}</option>
                                                @foreach ($staffrole as $staffroleId => $rolesName)
                                                <option value="{{ $staffroleId }}">{{ $rolesName }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.department') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='department_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.department') }}</option>
                                                @foreach ($staffdepartment as $staffdepartmentId => $departmentName)
                                                    <option value="{{ $staffdepartmentId }}">{{$departmentName}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4>{{ __('tablevars.more_information') }}<span class="text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.office_No') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="office_no" class="form-control"
                                                        wire:model="office_no">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.details') }}</label><span
                                                        class="text-danger">*</span>
                                                    <textarea name="detail" class="form-control" wire:model='detail'></textarea>
                                                    @error('detail')
                                                        <span class="v-msg-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4>{{ __('tablevars.staff_ddress') }}<span class="text-danger">*</span></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.country') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" wire:model='country_id'>
                                                        <option value="">{{ __('tablevars.select') }}
                                                            {{ __('tablevars.country') }}</option>
                                                            @foreach ($country as $countryId => $countryName )
                                                                <option value="{{ $countryId }}">{{ $countryName }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.city') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" wire:model='city_id'>
                                                        <option value="">{{ __('tablevars.select') }}
                                                            {{ __('tablevars.city') }}</option>
                                                            @foreach ($city as $cityId => $cityName)
                                                                <option value="{{ $cityId }}">{{ $cityName }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.postal_code') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="postal_code" class="form-control"
                                                        wire:model="postal_code" wire:model='postal_code'>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.profile_image') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" name="photo"
                                                        id="photo"placeholder="please enter your website name"
                                                        class="form-control" wire:model='photo'>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.address') }}</label><span
                                                        class="text-danger">*</span>
                                                    <textarea name="address" class="form-control" wire:model='address'></textarea>
                                                    @error('address')
                                                        <span class="v-msg-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
