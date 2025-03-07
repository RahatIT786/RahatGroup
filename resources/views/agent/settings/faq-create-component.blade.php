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
                                        <h3 class="m-0">Add New FAQ</h3>
                                        <div>
                                            <a class="btn btn-primary" href="{{ route('agent.faq.index') }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.title') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Title" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.faq') }}
                                                            {{ __('tablevars.question') }}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.faq') }}
                                                            {{ __('tablevars.answer') }}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control"></textarea>
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
