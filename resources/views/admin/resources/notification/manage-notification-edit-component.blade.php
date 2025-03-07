<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.notification') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }} {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageNotification.index') }}"
                        wire:navigate>{{ __('tablevars.notification') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.notification') }}</h4>
                            <a href="{{ route('admin.manageNotification.index') }}" class="btn btn-danger"
                                wire:navigate><i class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.type') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="notifi_type" class="form-control"
                                            wire:model="notifi_type" maxlength="50">
                                        @error('notifi_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label>{{ __('tablevars.content') }}<span class="text-danger">*</span></label>
                                        <textarea name="notifi_contain" id="notifi_contain" input="notifi_contain" class="form-control"
                                            wire:model="notifi_contain">{{ $notifi_contain }}</textarea>
                                        @error('notifi_contain')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('extra_js')
    <script>
        $('#notifi_contain').summernote({
            placeholder: 'Enter Notification Content',
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
