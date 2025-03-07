<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <h4 class="card-title"><u>Personal info</u></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.first_name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" class="form-control" wire:model="first_name" maxlength="200">
                                        @error('first_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.last_name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" class="form-control" wire:model="last_name" maxlength="200">
                                        @error('last_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" class="form-control" wire:model="email" maxlength="200" readonly>
                                        @error('email')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" wire:model="address" maxlength="200" readonly>
                                        @error('address')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mobile</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mobile" class="form-control" wire:model="mobile" maxlength="200" readonly>
                                        @error('mobile')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.role') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" wire:model='role_id'>
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.role') }}</option>
                                            @foreach ($staffrole as $staffroleId => $rolesName)
                                                <option value="{{ $staffroleId }}">{{ $rolesName }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.department') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="department_id" id="department_id" wire:model='department_id' disabled>
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.department') }}</option>
                                            @foreach ($staffdepartment as $staffdepartmentId => $departmentName)
                                                <option value="{{ $staffdepartmentId }}">{{ $departmentName }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.salary') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="salary" class="form-control" wire:model="salary" readonly>
                                        @error('salary')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="card-title"><u>More info</u></h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Office Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="office_no" class="form-control" wire:model="office_no" readonly>
                                        @error('office_no')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.details') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="detail" class="form-control" wire:model='detail'></textarea>
                                        @error('detail')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="card-title"><u>Staff address</u></h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.country') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" wire:model='country_id'>
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.country') }}</option>
                                            @foreach ($country as $countryId => $countryName)
                                                <option value="{{ $countryId }}">{{ $countryName }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.city') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" wire:model='city_id'>
                                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.city') }}</option>
                                            @foreach ($city as $cityId => $cityName)
                                                <option value="{{ $cityId }}">{{ $cityName }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.postal_code') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="postal_code" class="form-control" wire:model="postal_code"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8">
                                        @error('postal_code')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.profile_image') }}</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="photo" id="photo" class="file-upload-default" wire:model='photo'>
                                        <div class="input-group">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                        @error('photo')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                        @if (is_object($photo))
                                            <img src="{{ $photo->temporaryUrl() }}" style="height: 100px; margin-top: 10px;">
                                        @elseif (!empty($photoEdit))
                                            <img src="{{ asset('storage/staff_photo/' . $photoEdit) }}" style="height: 100px; margin-top: 10px;">
                                        @else
                                            <span class="no-image">No images found</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-sm-right mt-4">
                            <button type="submit" class="btn btn-primary mb-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
