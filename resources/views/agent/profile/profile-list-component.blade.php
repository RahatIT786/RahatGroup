<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="settings-widget">

                                <div class="settings-inner-blk p-0">

                                    <div class="comman-space pb-0">

                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">

                                            <h3>Agent Profile</h3>

                                        </div>



                                        <div class="col-md-6">

                                            <ul class="info-list">

                                                <li>

                                                    <div class="before-icon">

                                                        <i class="fa fa-edit"></i>

                                                        <a href="{{ route('agent.profile.edit') }}">Edit

                                                            Profile</a>

                                                    </div>

                                                </li>

                                                <li>

                                                    <div class="before-icon"><i class="fa fa-lock"></i><a
                                                            href="{{ route('agent.password.index') }}"> Change

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

                                                                    Agency Name : {{ $agent->agency_name }}</div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon">Owner Name :

                                                                    {{ $agent->owner_name }}</div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon">Country Name :

                                                                    {{ $agent->country->countryname ?? 'N/A' }}</div>

                                                            </li>



                                                            <li>

                                                                <div class="before-icon">State Name :

                                                                    {{ $agent->state->state_name }}</div>

                                                            </li>



                                                            <li>

                                                                <div class="before-icon">City Name : {{ $agent->city }}

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

                                            <h3>Contacts</h3>

                                        </div>



                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="userinfo">

                                                        <ul class="info-list">

                                                            <li>

                                                                <div class="before-icon">

                                                                    Mobile : {{ $agent->mobile }}</div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon">Landline :

                                                                    {{ $agent->landline }}</div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon">Email : {{ $agent->email }}

                                                                </div>

                                                            </li>



                                                            <li>

                                                                <div class="before-icon">Website :
                                                                    {{ $agent->website }}

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

                                                                    Email Id : {{ $agent->email }}</div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon">GST : {{ $agent->gst }}

                                                                </div>

                                                            </li>



                                                            <li>

                                                                <div class="before-icon">PAN : {{ $agent->pan }}

                                                                </div>

                                                            </li>



                                                            <li>

                                                                <div class="before-icon">Office Address :

                                                                    {{ $agent->address }}</div>

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

                                            <h3>Upload Documents</h3>

                                        </div>



                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="userinfo">

                                                        <ul class="info-list">

                                                            <li>

                                                                <div class="before-icon">

                                                                    Profile Image :
                                                                    @if ($agent->profile_img)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/profile_image/' . $agent->profile_img) }}"
                                                                            target="_blank" download></a>
                                                                    @endif


                                                                </div>

                                                            </li>



                                                            <li>

                                                                <div class="before-icon">

                                                                    Company Logo :
                                                                    @if ($agent->company_logo)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/company_logo/' . $agent->company_logo) }}"
                                                                            target="_blank" download></a>
                                                                    @endif


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

                                            <h3>Upload Personal

                                                Documents</h3>

                                        </div>



                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="userinfo">

                                                        <ul class="info-list">

                                                            <li>

                                                                <div class="before-icon">

                                                                    Passport Copy : @if ($agent->owners_passport)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/owners_passport/' . $agent->owners_passport) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>

                                                            <li>

                                                                <div class="before-icon">

                                                                    Owners Adhaar : @if ($agent->owners_adhaar)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/owners_adhaar/' . $agent->owners_adhaar) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>

                                                            <li>

                                                                <div class="before-icon">

                                                                    Owners Pancard : @if ($agent->owners_pancard)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/owners_pancard/' . $agent->owners_pancard) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>



                                                            <li>

                                                                <div class="before-icon">

                                                                    Bank Proof : @if ($agent->cancelled_cheque)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/cancelled_cheque/' . $agent->cancelled_cheque) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>



                                                            <li>

                                                                <div class="before-icon">

                                                                    Office Address Proof : @if ($agent->office_address_proof)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/office_address_proof/' . $agent->office_address_proof) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>



                                                            <li>

                                                                <div class="before-icon">

                                                                    Company Name Proof : @if ($agent->company_name_proof)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/company_name_proof/' . $agent->company_name_proof) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>



                                                            <li>

                                                                <div class="before-icon">

                                                                    Outside Board & Entrance : @if ($agent->office_board)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/office_board/' . $agent->office_board) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>



                                                            <li>

                                                                <div class="before-icon">

                                                                    Reception and Waiting Area : @if ($agent->reception)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/reception/' . $agent->reception) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
                                                                </div>
                                                            </li>



                                                            <li>

                                                                <div class="before-icon">
                                                                    Boss Cabin / Entrance : @if ($agent->boss_cabin)
                                                                        <a class="fas fa-download"
                                                                            href="{{ asset('storage/boss_cabin/' . $agent->boss_cabin) }}"
                                                                            target="_blank" download></a>
                                                                    @endif
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







                    {{-- <div class="row">

                        <div class="col-md-12">

                            <div class="settings-widget">

                                <div class="settings-inner-blk p-0">

                                    <div class="comman-space">

                                        <div

                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">

                                            <h3>User Contact Details</h3>

                                        </div>



                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="userinfo">

                                                        <h5 class='mb-3'>{{ $agent->owner_name }}</h5>

                                                        <ul class="info-list">

                                                            <li>

                                                                <div class="before-icon"><i class="fa fa-user"></i>

                                                                    Agent Code : {{ $agent->id }}</div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon"><i

                                                                        class="fa fa-envelope"></i><a

                                                                        href="mailto:{{ $agent->email }}">

                                                                        {{ $agent->email }}</a></div>

                                                            </li>

                                                            <li>

                                                                <div class="before-icon"><i class="fa fa-phone"></i>

                                                                    {{ $agent->mobile }}</div>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <ul class="info-list">

                                                        <li>

                                                            <div class="before-icon">

                                                                <i class="fa fa-edit"></i>

                                                                <a href="{{ route('agent.profile.edit') }}">Edit

                                                                    Profile</a>

                                                            </div>

                                                        </li>

                                                        <li>

                                                            <div class="before-icon"><i class="fa fa-lock"></i><a

                                                                    href="{{ route('agent.password.index') }}"> Change

                                                                    Password</a></div>

                                                        </li>

                                                    </ul>

                                                </div>



                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div> --}}



                    {{-- <div class="row">

                        <div class="col-md-12">

                            <div class="settings-widget">

                                <div class="settings-inner-blk p-0">

                                    <div class="comman-space">

                                        <div

                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">

                                            <h3>Company Details</h3>

                                        </div>



                                        <div>

                                            <div class="settings-referral-blk course-instruct-blk table-responsive">

                                                <div>

                                                    <h5 class='mb-3'>{{ $agent->agency_name }}</h5>

                                                    <ul class="info-list">

                                                        <li>

                                                            <div class="before-icon"><i class="fa fa-envelope"></i><a

                                                                    href="mailto:{{ $agent->email }}">

                                                                    {{ $agent->email }}</a></div>

                                                        </li>

                                                        <li>

                                                            <div class="before-icon"><i class="fa fa-user"></i>

                                                                Contact

                                                                Person : {{ $agent->owner_name }}</div>

                                                        </li>

                                                        <li>

                                                            <div class="before-icon"><i class="fa fa-phone"></i>

                                                                {{ $agent->mobile }}</div>

                                                        </li>

                                                        <li>

                                                            <div class="before-icon"><i class="fa fa-file"></i>

                                                                {{ $agent->gst }}</div>

                                                        </li>

                                                        <li>

                                                            <div class="before-icon"><i class="fa fa-money-bill"></i>

                                                                {{ $agent->gst }}</div>

                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div> --}}

                </div>

            </div>

        </div>

    </div>

</div>
