<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.agent') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agentlist.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.agent') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.payment') }}</h4>
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
                                {{--
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.state') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.state') }}</option>
                                                <option value="1">state Name 1</option>
                                                <option value="2">state Name 2</option>
                                            </select>
                                        </div>
                                    </div> --}}
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
                                        <label>{{ __('tablevars.password') }}<span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            wire:model="password" maxlength="150">
                                        @error('password')
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
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.free_paid') }}</option>
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
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.free_paid') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="is_paid" id="is_paid"
                                            wire:model="is_paid">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('is_paid')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.relationship_manager') }}<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='rm_staff_id'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.relationship_manager') }}</option>
                                            @if ($rmstaff)
                                                @foreach ($rmstaff as $rmstaffId => $rmstaffName)
                                                    <option value="{{ $rmstaffId }}">{{ $rmstaffName }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('rm_staff_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.website') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="website_name" id="website_name"
                                            class="form-control" wire:model="website_name" maxlength="150"
                                            oninput="validateWebsiteName(event)">
                                        @error('website_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.company_logo') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="company_logo" id="company_logo"
                                            class="form-control" wire:model="company_logo">
                                        @error('company_logo')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($company_logo)
                                        <img src="{{ $company_logo->temporaryUrl() }}"
                                            style="height: 100px;width: 150px;">
                                    @endif
                                </div>
                                <div class="col-6">
                                    {{-- <div class="form-group">
                                        <label class='w-100'>&nbsp;</label>
                                        <button wire:click="createFolderAndExtract" class="btn btn-primary">
                                            Create Website
                                        </button>
                                    </div> --}}
                                    <label class='w-100'>&nbsp;</label>
                                    <div wire:ignore
                                        class="fl-checkbox fl-checkbox_list2 filter_heightauto collapse show"
                                        id="collapse1" aria-labelledby="heading1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                class="custom-control-input filterradio filter-nn pkg-type"
                                                id="is_create_website" value="1" wire:model="is_create_website"
                                                wire:change="changeInput" autocomplete="off">
                                            <label class="custom-control-label" for="is_create_website">Create website
                                                for this agent ?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Loader Section -->
    <div wire:loading wire:target="save" id="loader-overlay"
        class="fixed-top d-flex justify-content-center align-items-center w-100 h-100 z-index-1050"
        style="display: none !important; background-color: rgba(0, 0, 0, 0.5);">
        <div class="text-white text-center">
            <!-- Custom CSS Spinner -->
            <div class="spinner"
                style="width: 40px; height: 40px; border: 4px solid #f3f3f3; border-top: 4px solid #007bff; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto;">
            </div>
            <div class="mt-2">Processing... Please wait.</div>
        </div>
    </div>
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
@push('extra_css')
    <style>
        #loader-overlay {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            z-index: 1000;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
