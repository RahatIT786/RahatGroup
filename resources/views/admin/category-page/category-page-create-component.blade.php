{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.category_page') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.category_page') }} {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item">
                    {{ __('tablevars.category_page') }}</div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    {{-- <form wire:submit.prevent="save"> --}}
                    <form>
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.category_page') }}</h4>
                            <a href="{{ route('admin.categoryPage.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.category_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="category_name" class="form-control"
                                            wire:model="category_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.desc') }}</label><span class="text-danger">*</span>
                                        <textarea name="desc" class="form-control"></textarea>
                                        @error('desc')
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
