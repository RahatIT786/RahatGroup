<div class="page-content">
    <div class="container">

        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <h3>User Profile</h3>
                                            <a href="{{ route('customer.dashboard') }}" class="btn btn-danger"
                                                wire:navigate><i class="fas fa-long-arrow-alt-left"></i>

                                                &nbsp;{{ __('tablevars.back') }}</a>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="info-list">
                                                <li>
                                                    <div class="before-icon">
                                                        <i class="fa fa-edit"></i>
                                                        <a href="{{ route('customer.profile.edit') }}">Edit
                                                            Profile</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="before-icon"><i class="fa fa-lock"></i><a
                                                            href="{{ route('customer.password.index') }}"> Change
                                                            Password</a></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <h3>Profile</h3>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="userinfo">
                                                        <ul class="info-list">
                                                            <li>
                                                                <div class="before-icon"><i class="fa fa-user"></i>
                                                                    Name : {{ $customer->name }}</div>
                                                            </li>
                                                            <li>
                                                                <div class="before-icon">State Name :
                                                                    {{ $customer->state->state_name }}</div>
                                                            </li>
                                                            <li>
                                                                <div class="before-icon">City Name :
                                                                    {{ $customer->city }}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="settings-widget">

                                <div class="settings-inner-blk p-0">

                                    <div class="comman-space">

                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">

                                            <h3>User Details</h3>

                                        </div>



                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="userinfo">

                                                        <ul class="info-list">

                                                            <li>
                                                                <div class="before-icon">

                                                                    Email Id : {{ $customer->email }}</div>
                                                            </li>
                                                            <li>
                                                                <div class="before-icon">
                                                                    Mobile : {{ $customer->mobile }}</div>
                                                            </li>
                                                            <li>
                                                                <div class="before-icon">Office Address :
                                                                    {{ $customer->address }}</div>
                                                            </li>

                                                        </ul>

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
            </div>
        </div>
    </div>
</div>
