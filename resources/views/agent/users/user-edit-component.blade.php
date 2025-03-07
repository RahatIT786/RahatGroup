<div class="page-content">

<div class="container">
<section class="section">
        <div class="section-header">
            <h4>{{ __('tablevars.user_detail') }}</h4>
            <div class="section-header-button">

            </div>
</section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>profile</h4>
                            <a href="{{ route('agent.profile.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="agency_name">Agency Name<span class="text-danger"></span></label>
                                        <input type="text" name="agency_name" class="form-control" wire:model="agency_name">
                                        @error('agency_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="owner_name">Owner Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" wire:model="owner_name">
                                        @error('owner_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                    <label for="country_id">Country Name<span class="text-danger">*</span></label>
                                    <select class="form-control" name='country_id' id="country_id"
                                        wire:model='country_id'>
                                        <option value="">Country Name</option>
                                        @foreach ($country as $CountryId => $CountryName)
                                            <option value="{{ $CountryId }}">{{ $CountryName }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                          <div class="col-4">
    <div class="form-group">
        <label for="state_id">State Name <span class="text-danger">*</span></label>
        <select class="form-control" name='state_id' id="state_id" wire:model='state_id'>
            <option value="">State Name</option>
            @foreach ($state as $stateId => $stateName)
                <option value="{{ $stateId }}">{{ $stateName }}</option>
            @endforeach
        </select>
        @error('state_id')
            <span class="v-msg-500">{{ $message }}</span>
        @enderror
    </div>
</div>

                               
                         <div class="col-4">
                                    <div class="form-group">
                                    <label for="city">City Name<span class="text-danger">*</span></label>
                                        <input type="city" name="city" class="form-control" wire:model="city"
                                            >
                                        @error('city')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <h6 class="h6 border-bottom pb-3"><strong>Contacts</strong></h6>
                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="mobile">Mobile<span class="text-danger">*</span></label>
                                    <input type="mobile" name="mobile" class="form-control" wire:model="mobile"
                                    >
                                        @error('mobile')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="landline">Landline</label>
                                    <input type="landline" name="landline" class="form-control" wire:model="landline" placeholder="Landline"
                                    >
                                        @error('landline')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="email_id">Eamil<span class="text-danger"></span></label>
                                    <input type="email" name="email" class="form-control" wire:model="email" maxlength="200" autocomplete="off" readonly
                                    >
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="website" name="website" class="form-control" wire:model="website"
                                    >
                                        @error('website')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <h6 class="h6 border-bottom pb-3"><strong>User Details</strong></h6>	



                          <div class="col-6">
                                    <div class="form-group">
                                    <label for="email">Login Id</label>
                                    <input type="email" class="form-control" placeholder="Login Id" name="email"  id="email" maxlength="50" wire:model="email" autocomplete="off"   readonly>
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password"  id="password"  wire:model="password"  maxlength="200" autocomplete="off" >
                                        @error('password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password"  id="confirm_password" maxlength="50" wire:model="password"  autocomplete="off">
                                        @error('confirm_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                
                                <h6 class="h6 border-bottom pb-3"><strong>Upload Documents</strong></h6>
<div class="col-4">
    <div class="form-group">
        <label for="profile_img">Company Logo<span class="text-danger"></span> <small>(file not more than 500 kb)</small></label>
        <input type="file" class="custom-file-input" name="profile_img" id="profile_img" wire:model="profile_img">
        @error('profile_img')
            <span class="v-msg-500 text-danger">{{ $message }}</span>
        @enderror
    </div>
    @if (is_object($profile_img))
        <img src="{{ $profile_img->temporaryUrl() }}" style="height: 100px;">
    @elseif (!empty($profile_logoEdit))
        <img src="{{ asset('storage/profile_image/' . $profile_logoEdit) }}" style="height: 100px;">
    @else
        <span class="no-image text-danger">No images found</span>
    @endif
</div>



<h6 class="h6 border-bottom pb-3"><strong>Upload Personal Documents</strong></h6>
<div class="form-row">
    <div class="col-md-4 form-group">
        <label for="owners_passport">Passport Copy<span class="text-danger"></span> <small>(file not more than 500 kb)</small></label>
        <input type="file" class="custom-file-input" name="owners_passport" id="owners_passport" wire:model="owners_passport">
        @error('owners_passport')
            <span class="v-msg-500 text-danger">{{ $message }}</span>
        @enderror
    </div>
    @if (is_object($owners_passport))
        <img src="{{ $owners_passport->temporaryUrl() }}" style="height: 100px;">
    @elseif (!empty($user->owners_passport))
        <img src="{{ asset('storage/profile_image/' . $user->owners_passport) }}" style="height: 100px;">
    @else
        <span class="no-image text-danger">No images found</span>
    @endif
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
