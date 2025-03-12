<div class="main-content">
    <section class="section">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} Bank Account</h1>
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
                            <h4>Bank Account</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="company_name" maxlength="150">
                                        @error('company_name') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Account Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="account_name" maxlength="150">
                                        @error('account_name') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Account No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="account_no" maxlength="20">
                                        @error('account_no') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>IFSC/SWIFT <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="ifsc_swift" maxlength="20">
                                        @error('ifsc_swift') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Bank Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="bank_name" maxlength="150">
                                        @error('bank_name') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Branch Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="branch_name" maxlength="150">
                                        @error('branch_name') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>IBAN NO <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="iban_no" maxlength="50">
                                        @error('iban_no') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>GST</label>
                                        <input type="text" class="form-control" wire:model="gst" maxlength="45">
                                        @error('gst') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                    
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>PAN Card <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="pan_card" maxlength="10">
                                        @error('pan_card') <span class="v-msg-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
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
