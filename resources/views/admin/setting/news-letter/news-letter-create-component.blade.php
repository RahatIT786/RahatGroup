<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.newsletter') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.newsletter.create') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.newsletter') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.newsletter') }}</h4>
                            <a href="{{ route('admin.newsletter.create') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.newsletter_image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" wire:model="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                    @endif
                                </div>
                            </div>
                            <div class="text-left mt-3">
                                <button title="Submit" class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
