<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="filter-grp ticket-grp d-flex justify-content-between profile-heading">
                                        <h3 class="m-0">Add Settings</h3>
                                        <div>
                                            <a class="btn btn-primary" href="{{ route('agent.setting.index') }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.parameter') }}
                                                            {{ __('tablevars.name') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control">
                                                            <option value="">Select Parameter Name</option>
                                                            <option value="">Welcome</option>
                                                            <option value="">Phone</option>
                                                            <option value="">Email</option>
                                                            <option value="">Youtube</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.seetings') }} {{ __('tablevars.value') }}</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            readonly />
                                                    </div>
                                                </div>
                                                <div class="update-profile">
                                                    <button type="button" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
