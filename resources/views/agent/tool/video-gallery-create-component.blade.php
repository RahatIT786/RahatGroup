<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="profile-heading d-flex justify-content-between">
                                        <h3 class="m-0">Add New Video Gallery</h3>
                                        <div class="ticket-btn-grp">
                                            <a href="{{ route('agent.videoGallery.index') }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.event') }} {{ __('tablevars.name') }}<span
                                                            class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Event" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">{{ __('tablevars.event') }} {{ __('tablevars.date') }}<span
                                                            class="text-danger">*</span></label>
                                                        <input type="date" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">Upload Image of Video<span
                                                            class="text-danger">*</span></label>
                                                        <input type="file" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-block">
                                                        <label class="form-control-label">Upload Video<span
                                                            class="text-danger">*</span></label>
                                                        <input type="file" class="form-control"/>
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
