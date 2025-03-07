{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.payment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.payment') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
                        wire:navigate>{{ __('tablevars.payment') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form>
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.payment') }}</h4>
                            <a href="{{ route('admin.payment.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="agency_name" id="agency_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Owner Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="owner_name" id="owner_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.state') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.state') }}</option>
                                            <option value="1">state Name 1</option>
                                            <option value="2">state Name 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>City<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Mobile<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="mobile" id="mobile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email Id<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Password<span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Website<span
                                                class="text-danger">*</span></label>
                                        <input type="website" name="website" id="website" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pan<span
                                                class="text-danger">*</span></label>
                                        <input type="pan" name="pan" id="pan" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Fee Paid<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="fee_paid" id="fee_paid">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Membership<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="membership" id="membership">
                                            <option value="Yes">Annual membership</option>
                                            <option value="No">Free membership</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h4>Relationship Manager<span class="text-danger">*</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.city') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control">
                                        <option value="">{{ __('tablevars.select') }}
                                            {{ __('tablevars.city') }}</option>
                                        {{-- <option value="1">city Name 1</option>
                                        <option value="2">city Name 2</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Staff <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control">
                                        <option value="">{{ __('tablevars.select') }}
                                            Staff</option>
                                        {{-- <option value="1">city Name 1</option>
                                        <option value="2">city Name 2</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Url Link<span
                                            class="text-danger">*</span></label>
                                    <input type="gst" name="gst" id="gst" value="https://www.aihut.in/Live/" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>&nbsp;<span class="text-danger"></span></label>
                                    <input type="text" name="gst" id="gst"placeholder="please enter your website name" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Company Logo<span class="text-danger">*</span></label>
                                    <input type="file" name="gst" id="gst"placeholder="please enter your website name" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Create Website<span class="text-danger">*</span></label>
                                    <input type="checkbox" name="gst" id="gst"placeholder="please enter your website name" checked>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                            <button type="reset" class="btn btn-warning">{{ 'Reset' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </section>
</div>