{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.staff') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.staff') }}
                    {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item">
                    {{ __('tablevars.staff') }}</div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    {{-- <form wire:submit.prevent="save"> --}}
                    <form>
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
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.role') }}</option>
                                            <option value="1">Back Office</option>
                                            <option value="2">Sales</option>
                                            <option value="3">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.department') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.department') }}</option>
                                            <option value="1">Nurshing</option>
                                            <option value="2">Farma</option>
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
                                                    <input type="text" name="office_No" class="form-control"
                                                        wire:model="office_No">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.details') }}</label><span
                                                        class="text-danger">*</span>
                                                    <textarea name="details" class="form-control"></textarea>
                                                    @error('details')
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
                                                    <select class="form-control">
                                                        <option value="">{{ __('tablevars.select') }}
                                                            {{ __('tablevars.country') }}</option>
                                                        <option value="1">country Name 1</option>
                                                        <option value="2">country Name 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.city') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control">
                                                        <option value="">{{ __('tablevars.select') }}
                                                            {{ __('tablevars.city') }}</option>
                                                        <option value="1">city Name 1</option>
                                                        <option value="2">city Name 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.postal_code') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="postal_code" class="form-control"
                                                        wire:model="postal_code">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.profile_image') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" name="profile_image"
                                                        id="profile_image"placeholder="please enter your website name"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
