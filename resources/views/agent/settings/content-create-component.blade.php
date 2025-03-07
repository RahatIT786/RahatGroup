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
                                        <h3 class="m-0">Add New Content Page</h3>
                                        {{-- <h4>User Content Page</h4> --}}
                                        <div>
                                            <a class="btn btn-primary" href="{{ route('agent.content.index') }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.page') }}
                                                            {{ __('tablevars.name') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control">
                                                            <option value="">Select Page Name</option>
                                                            <option value="">About us</option>
                                                            <option value="">Privacy Policy</option>
                                                            <option value="">Terms Of Use</option>
                                                            <option value="">Support</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.page') }}
                                                            {{ __('tablevars.content') }}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" placeholder="Enter Page Content"></textarea>
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
