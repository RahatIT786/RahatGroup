<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.brochure') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }} </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.brochure.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.brochure') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.brochure') }}</h4>
                            <a href="{{ route('admin.brochure.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.brochure_content') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="brochure_content" id="brochure_content" class="form-control"
                                            wire:model="brochure_content" maxlength="150">
                                        @error('brochure_content')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                            <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                                        </div>
                              
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
