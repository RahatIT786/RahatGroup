<div class="page-content">

    <div class="container">

        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="tak-instruct-group">

                    <div class="row">

                        <div class="col-xl-12 col-md-12">

                            <div class="settings-widget profile-details">

                                <div class="settings-menu p-0">

                                    <div class="profile-heading">

                                        <h3 class="m-0">{{ __('tablevars.user_detail') }}</h3>

                                    </div>

                                    <div class="checkout-form personal-address add-course-info">

                                        <form wire:submit.prevent="update">

                                            <div class="card-header d-flex justify-content-between">

                                                <h4>profile</h4>

                                                <a href="{{ route('customer.profile.index') }}" class="btn btn-danger"
                                                    wire:navigate><i class="fas fa-long-arrow-alt-left"></i>

                                                    &nbsp;{{ __('tablevars.back') }}</a>

                                            </div>

                                            <div class="row">

                                                <div class="col-6">

                                                    <div class="form-group">

                                                        <label for="name">Name</label><span
                                                            class="text-danger">*</span>

                                                        <input type="text" name="name" class="form-control"
                                                            wire:model="name">

                                                        @error('name')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-4">

                                                    <div class="form-group">

                                                        <label>{{ __('tablevars.country') }}</label><span
                                                            class="text-danger">*</span>

                                                        <select class="form-select" name='country_id' id="country_id"
                                                            wire:model='country_id'>

                                                            <option value="">Country Name</option>

                                                            @foreach ($country as $CountryId => $CountryName)
                                                                <option value="{{ $CountryId }}">

                                                                    {{ $CountryName }}</option>
                                                            @endforeach

                                                        </select>

                                                        @error('country_id')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-4">

                                                    <div class="form-group">

                                                        <label for="state_id">State Name <span
                                                                class="text-danger">*</span></label>

                                                        <select class="form-select" name='state_id' id="state_id"
                                                            wire:model='state_id'>

                                                            <option value="">State Name</option>

                                                            @foreach ($state as $stateId => $stateName)
                                                                <option value="{{ $stateId }}">

                                                                    {{ $stateName }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('state_id')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="city">City Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="city" name="city" class="form-control"
                                                            wire:model="city">
                                                        @error('city')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <h6 class="h6 border-bottom pb-3"><strong>Contacts</strong></h6>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile<span
                                                                class="text-danger">*</span></label>
                                                        <input type="mobile" name="mobile" class="form-control"
                                                            wire:model="mobile">
                                                        @error('mobile')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email_id">Email<span
                                                                class="text-danger"></span></label>
                                                        <input type="email" name="email" class="form-control"
                                                            wire:model="email" maxlength="200" autocomplete="off"
                                                            readonly>
                                                        @error('email')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <h6 class="h6 border-bottom pb-3"><strong>User Details</strong>
                                                </h6>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="email">Login Id</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Login Id" name="email" id="email"
                                                            maxlength="50" wire:model="email" autocomplete="off"
                                                            readonly>
                                                        @error('email')
                                                            <span class="v-msg-500 text-danger ">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="address">Office Address</label><span
                                                            class="text-danger">*</span>
                                                        <textarea name="address" class="form-control" placeholder=" Enter Office Address" wire:model="address"></textarea>
                                                        @error('address')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <h6 class="h6 border-bottom pb-3"><strong>Upload Documents</strong>
                                                </h6>
                                                <div class="col-lg-4">
                                                    <div class="input-block">
                                                        <label class="form-control-label">Profile Image</label>
                                                        <input type="file" class="form-control" name="profile_img"
                                                            wire:model="profile_img" />
                                                        @error('profile_img')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (is_object($profile_img))
                                                        <img src="{{ $profile_img->temporaryUrl() }}"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @elseif (!empty($profileImgEdit))
                                                        <img src="{{ asset('storage/user_profile_image/' . $profileImgEdit) }}"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @else
                                                        <span class="no-image">No images found</span>
                                                    @endif
                                                </div>

                                                <div class="card-footer text-left">
                                                    <button
                                                        class="btn btn-primary">{{ __('tablevars.update') }}</button>
                                                    <a class="btn btn-warning"
                                                        href="{{ route('customer.profile.index') }}">{{ __('tablevars.back') }}</a>
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
