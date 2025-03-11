<div class="main-content">
    <section class="section">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} Company</h1>
            {{-- <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agentlist.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.agent') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div> --}}

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Company Details</h4>
                            {{-- <a href="{{ route('admin.agentlist.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Company Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_name" id="company_name" class="form-control"
                                            wire:model="company_name" maxlength="150">
                                        @error('company_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Company Display Name<span class="text-danger">*</span></label>
                                        <input type="text" name="company_dly_name" id="company_dly_name" class="form-control"
                                            wire:model="company_dly_name" maxlength="150">
                                        @error('company_dly_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Contect Person<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_contect_person" id="company_contect_person" class="form-control"
                                            wire:model="company_contect_person" maxlength="150">
                                        @error('company_contect_person')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.mobile') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="company_mobile" id="company_mobile" class="form-control"
                                            wire:model="company_mobile" maxlength="12">
                                        @error('company_mobile')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Landline Number<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_landline_number" id="company_landline_number" class="form-control"
                                            wire:model="company_landline_number" maxlength="150">
                                        @error('company_landline_number')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="company_email" id="company_email" class="form-control"
                                            wire:model="company_email" maxlength="150">
                                        @error('company_email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.website') }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_website_name" id="company_website_name"
                                            class="form-control" wire:model="company_website_name" maxlength="150"
                                            oninput="validateWebsiteName(event)">
                                        @error('company_website_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Registered Address<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_registered_address" id="company_registered_address" class="form-control"
                                            wire:model="company_registered_address" maxlength="150">
                                        @error('company_registered_address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>About Company<span class="text-danger">*</span></label>
                                        <input type="text" name="company_about" id="company_about" class="form-control"
                                            wire:model="company_about" maxlength="150">
                                        @error('company_about')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.pan') }}</label>
                                        <input type="text" name="company_pan" id="company_pan" class="form-control"
                                            wire:model="company_pan" maxlength="45">
                                        @error('company_pan')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.gst') }}</label>
                                        <input type="text" name="company_gst" id="company_gst" class="form-control"
                                            wire:model="company_gst" maxlength="45">
                                        @error('gst')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.state') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="company_state" id="company_state" class="form-control"
                                            wire:model="company_state" maxlength="45">
                                        @error('company_state')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.city') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="company_city" id="company_city" class="form-control"
                                            wire:model="company_city" maxlength="150">
                                        @error('company_city')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
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
