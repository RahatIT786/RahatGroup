{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.category_page') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.category_page') }} {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.managePage.index') }}"
                        wire:navigate>{{ __('tablevars.category_page') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    {{-- <form wire:submit.prevent="save"> --}}
                    <form action="">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.category_page') }}</h4>
                            <a href="{{ route('admin.managePage.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.category_name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.category_name') }}</option>
                                            <option value="1">News & Alerts</option>
                                            <option value="2"> Information</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.page_title') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="page_title" class="form-control"
                                            wire:model="page_title">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.content') }}</label><span class="text-danger">*</span>
                                        <textarea name="content" class="form-control"></textarea>
                                        @error('content')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.published_date') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="published_date" class="form-control"
                                            wire:model="published_date">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.is_feature') }} <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_feature_option" value="yes"
                                                    wire:model="is_feature"> YES
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_feature_option" value="no"
                                                    wire:model="is_feature"> NO
                                            </label>
                                        </div>
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
