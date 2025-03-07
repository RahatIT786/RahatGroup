<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Enquiries</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageEnquiry') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.enquiries.index') }}"
                        wire:navigate>All Enquiries</a></div>
            </div>
        </div>
        @livewire('admin.manage-enquiry.enquiries.all-enquiries-component')
</div>



