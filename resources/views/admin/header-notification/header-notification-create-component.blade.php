{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.manage_notification') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.notification') }}
                    {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item">
                    {{ __('tablevars.manage_notification') }}</div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    {{-- <form wire:submit.prevent="save"> --}}
                    <form>
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.manage_notification') }}</h4>
                            <a href="{{ route('admin.manageNotification.index') }}" class="btn btn-danger"
                                wire:navigate><i class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.background_color') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.background_color') }}</option>
                                            <option value="1">Primary</option>
                                            <option value="2">Secondary</option>
                                            <option value="3">Success</option>
                                            <option value="4">Danger</option>
                                            <option value="5">Warning</option>
                                            <option value="6">Info</option>
                                            <option value="7">Dark</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.header_content') }}</label><span
                                            class="text-danger">*</span>
                                        <textarea name="header_content" class="form-control"></textarea>
                                        @error('header_content')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
