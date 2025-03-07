<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.header') }} {{ __('tablevars.notification') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }}
                    {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.headerNotification.index') }}"
                        wire:navigate>{{ __('tablevars.header') }} {{ __('tablevars.notification') }}
                        {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">
                    {{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.header') }}
                                {{ __('tablevars.notification') }}</h4>
                            <a href="{{ route('admin.headerNotification.index') }}" class="btn btn-danger"
                                wire:navigate><i class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Background color example : </label>
                                        <a href="javascript:void(0)" class="badge badge-primary mr-2"><span
                                                class="text-bold text-dark">Primary</span></a>

                                        <a href="javascript:void(0)" class="badge badge-secondary mr-2"><span
                                                class="text-bold text-dark">Secondary</span></a>
                                        <a href="javascript:void(0)" class="badge badge-success mr-2"><span
                                                class="text-bold text-white">Success</span></a>
                                        <a href="javascript:void(0)" class="badge badge-danger mr-2"><span
                                                class="text-bold text-dark">Danger</span></a>
                                        <a href="javascript:void(0)" class="badge badge-warning mr-2"><span
                                                class="text-bold text-dark">Warning</span></a>
                                        <a href="javascript:void(0)" class="badge badge-info mr-2"><span
                                                class="text-bold text-dark">Info</span></a>
                                        <a href="javascript:void(0)" class="badge badge-dark mr-2"><span
                                                class="text-bold text-white">Dark</span></a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.background_color') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="bg_color" id="bg_color"
                                            wire:model="bg_color">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.background_color') }}</option>
                                            <option value="primary">Primary</option>
                                            <option value="secondary">Secondary</option>
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="warning">Warning</option>
                                            <option value="info">Info</option>
                                            <option value="dark">Dark</option>
                                        </select>
                                        @error('bg_color')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label>{{ __('tablevars.header_content') }}</label><span
                                            class="text-danger">*</span>
                                        <textarea name="notifi_contain" id="notifi_contain" class="form-control" input="notifi_contain"
                                            wire:model="notifi_contain">{{ $notifi_contain }}</textarea>
                                        @error('notifi_contain')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
@push('extra_js')
    <script>
        $('#notifi_contain').summernote({
            placeholder: 'Enter Header Notification',
            tabsize: 2,
            height: 100,
            toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
            
                    ['para', ['ul', 'ol', 'paragraph']],
                   
                    ['view', ['fullscreen', 'codeview']]
                ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('notifi_contain', contents)
                }
            }
        });
    </script>
@endpush
