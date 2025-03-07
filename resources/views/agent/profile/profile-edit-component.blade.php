<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
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

                                                <a href="{{ route('agent.profile.index') }}" class="btn btn-danger"
                                                    wire:navigate><i class="fas fa-long-arrow-alt-left"></i>

                                                    &nbsp;{{ __('tablevars.back') }}</a>

                                            </div>

                                            <div class="row">

                                                <div class="col-6">

                                                    <div class="form-group">

                                                        <label for="agency_name">Agency Name<span
                                                                class="text-danger"></span></label>

                                                        <input type="text" name="agency_name" class="form-control"
                                                            wire:model="agency_name">

                                                        @error('agency_name')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="form-group">

                                                        <label for="owner_name">Owner Name<span
                                                                class="text-danger">*</span></label>

                                                        <input type="text" name="name" class="form-control"
                                                            wire:model="owner_name">

                                                        @error('owner_name')
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
                                                        <label for="landline">Landline</label>
                                                        <input type="landline" name="landline" class="form-control"
                                                            wire:model="landline" placeholder="Landline">
                                                        @error('landline')
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

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="website">Website</label>
                                                        <input type="website" name="website" class="form-control"
                                                            wire:model="website">
                                                        @error('website')
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
                                                            <span
                                                                class="v-msg-500 text-danger ">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="gst">GST</label>
                                                        <input type="text" name="gst" class="form-control"
                                                            placeholder="GST" wire:model="gst">
                                                        @error('gst')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="pan">PAN</label>
                                                        <input type="text" name="pan" class="form-control"
                                                            placeholder="PAN" wire:model="pan">
                                                        @error('pan')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="address">Office Address</label>
                                                        <textarea name="address" class="form-control" placeholder=" Enter Office Address" wire:model="address"></textarea>
                                                        @error('address')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- end nbedita --}}

                                                <h6 class="h6 border-bottom pb-3"><strong>Upload Documents</strong>
                                                </h6>
                                                {{-- //Nibedita --}}
                                                <div class="col-lg-4">
                                                    <div class="input-block">
                                                        <label class="form-control-label">Profile Image<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" name="profile_img"
                                                            wire:model="profile_img" />
                                                        @error('profile_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (is_object($profile_img))
                                                        <img src="{{ $profile_img->temporaryUrl() }}"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @elseif (!empty($profileImgEdit))
                                                        <img src="{{ asset('storage/profile_image/' . $profileImgEdit) }}"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @else
                                                        <span class="no-image">No images found</span>
                                                    @endif
                                                </div>
                                                {{-- //end nibedita --}}
                                                <div class="col-lg-4">
                                                    <div class="input-block">
                                                        <label class="form-control-label">Company Logo<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="company_logo" wire:model="company_logo" />
                                                        @error('company_logo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (is_object($company_logo))
                                                        <img src="{{ $company_logo->temporaryUrl() }}"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @elseif (!empty($companyImgEdit))
                                                        <img src="{{ asset('storage/company_logo/' . $companyImgEdit) }}"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @else
                                                        <span class="no-image">No images found</span>
                                                    @endif
                                                </div>

                                                <h6 class="h6 border-bottom pb-3"><strong>Upload Personal
                                                        Documents </strong><span class="text-danger">( Upload Only PDF
                                                        OR JPG )</span></h6>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Passport Copy<span class="text-danger">*</span></label>
                                                        <input type="file" name="owners_passport"
                                                            id="owners_passport" class="form-control"
                                                            wire:model='owners_passport'>
                                                        @error('owners_passport')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($ownerImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/owners_passport/' . $ownerImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i
                                                                    class="fas fa-file-pdf"style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                        {{-- <div class="modal fade" id="passportModal" tabindex="-1" aria-labelledby="passportModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="passportModalLabel">Passport Copy Preview</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <embed src="{{ asset('storage/owners_passport/' . $ownerImgEdit) }}" type="application/pdf" width="100%" height="500px" />
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Owners Adhaar<span class="text-danger">*</span></label>
                                                        <input type="file" name="owners_adhaar" id="owners_adhaar"
                                                            class="form-control" wire:model='owners_adhaar'>
                                                        @error('owners_adhaar')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($aadharImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/owners_adhaar/' . $aadharImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Owners Pancard<span class="text-danger">*</span></label>
                                                        <input type="file" name="owners_pancard"
                                                            id="owners_pancard" class="form-control"
                                                            wire:model='owners_pancard'>
                                                        @error('owners_pancard')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($ownersPancardImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/owners_pancard/' . $ownersPancardImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Bank Proof<span class="text-danger">*</span></label>
                                                        <input type="file" name="cancelled_cheque"
                                                            id="cancelled_cheque" class="form-control"
                                                            wire:model='cancelled_cheque'>
                                                        @error('cancelled_cheque')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($cancelledChequeImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/cancelled_cheque/' . $cancelledChequeImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Office Address Proof<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" name="office_address_proof"
                                                            id="office_address_proof" class="form-control"
                                                            wire:model='office_address_proof'>
                                                        @error('office_address_proof')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($officeAddressImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/office_address_proof/' . $officeAddressImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Company Name Proof<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" name="company_name_proof"
                                                            id="company_name_proof" class="form-control"
                                                            wire:model='company_name_proof'>
                                                        @error('company_name_proof')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($companyProofImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/company_name_proof/' . $companyProofImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Outside Board & Entrance<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" name="office_board" id="office_board"
                                                            class="form-control" wire:model='office_board'>
                                                        @error('office_board')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($officeBoardImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/office_board/' . $officeBoardImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Reception and Waiting Area<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" name="reception" id="reception"
                                                            class="form-control" wire:model='reception'>
                                                        @error('reception')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($receptionImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/reception/' . $receptionImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Boss Cabin / Entrance<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file" name="boss_cabin" id="boss_cabin"
                                                            class="form-control" wire:model='boss_cabin'>
                                                        @error('boss_cabin')
                                                            <span class="v-msg-500 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($bossCabinImgEdit)
                                                        <div class="mx-2 my-2">
                                                            <span> View Document :</span>
                                                            <a href="{{ asset('storage/boss_cabin/' . $bossCabinImgEdit) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{-- <i class="fas fa-file-pdf"
                                                                    style="font-size: 20px; color: red;"></i> --}}
                                                                    <i class="fas fa-eye" style="font-size: 20px; color: red;"></i>
                                                            </a>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="card-footer text-left">
                                                    <button
                                                        class="btn btn-primary">{{ __('tablevars.update') }}</button>
                                                    <a class="btn btn-warning"
                                                        href="{{ route('agent.imageGallery.index') }}">{{ __('tablevars.back') }}</a>
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
