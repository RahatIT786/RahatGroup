<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.agent') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agentlist.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.agent') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.payment') }}</h4>
                            <a href="{{ route('admin.agentlist.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="agency_name" id="agency_name" class="form-control"
                                            wire:model="agency_name" maxlength="150">
                                        @error('agency_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Owner Name<span class="text-danger">*</span></label>
                                        <input type="text" name="owner_name" id="owner_name" class="form-control"
                                            wire:model="owner_name" maxlength="150">
                                        @error('owner_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.state') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='state_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.state') }}</option>
                                            @foreach ($state as $stateId => $stateName)
                                                <option value="{{ $stateId }}">{{ $stateName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control"
                                            wire:model="city" maxlength="150">
                                        @error('city')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.mobile') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" id="mobile" class="form-control"
                                            wire:model="mobile" maxlength="12">
                                        @error('mobile')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            wire:model="email" maxlength="150">
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.pan') }}</label>
                                        <input type="pan" name="pan" id="pan" class="form-control"
                                            wire:model="pan" maxlength="45">
                                        @error('pan')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.gst') }}</label>
                                        <input type="gst" name="gst" id="gst" class="form-control"
                                            wire:model="gst" maxlength="45">
                                        @error('gst')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.free_paid') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='membership_id'>
                                            @foreach ($membership as $key => $membership)
                                                <option value="{{ $key }}">{{ $membership }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('membership_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.relationship_manager') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='rm_staff_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.relationship_manager') }}</option>
                                            @foreach ($rmstaff as $rmstaffId => $rmstaffName)
                                                <option value="{{ $rmstaffId }}">{{ $rmstaffName }}</option>
                                            @endforeach
                                        </select>
                                        @error('rm_staff_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if (empty($website_name))
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.website') }} {{ __('tablevars.name') }}</label>
                                            <input type="text" name="website_name" id="website_name"
                                                class="form-control" wire:model="website_name" maxlength="150"
                                                oninput="validateWebsiteName(event)">
                                            @error('website_name')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company_logo') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="company_logo" class="form-control"
                                            wire:model="company_logo">

                                        @error('company_logo')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($company_logo)
                                        <img src="{{ $company_logo->temporaryUrl() }}" style="height: 100px;">
                                    @elseif ($company_logoEdit)
                                        <img src="{{ asset('storage/company_logo/' . $company_logoEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('extra_js')
    <script>
        function validateWebsiteName(event) {
            // Allow only alphanumeric characters, hyphen, and underscore
            var input = event.target;
            input.value = input.value.replace(/[^a-zA-Z0-9-]/g, ''); // Remove any other character
        }
    </script>
@endpush
