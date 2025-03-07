<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.faq') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.faq') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }} {{ __('tablevars.faq') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.faq') }}</h4>
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.title') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Title"
                                            wire:model='title' maxlength="200">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="input-block">
                                        <label for="question" class="form-control-label">{{ __('tablevars.faq') }}
                                            {{ __('tablevars.question') }}<span class="text-danger">*</span></label>
                                        <textarea type="text" input="question" class="form-control" wire:model='question' id="question">{{ $question }}</textarea>
                                        @error('question')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="input-block" wire:ignore>
                                        <label for="answer">{{ __('tablevars.faq') }}
                                            {{ __('tablevars.answer') }}<span class="text-danger">*</span></label>
                                        <textarea type="text" input="answer" id="answer" class="form-control" wire:model="answer">{{ $answer }}</textarea>
                                    </div>
                                    @error('answer')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
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


@push('extra_js')
    <script>
        $('#answer').summernote({
            placeholder: 'Enter Answer',
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
                    @this.set('answer', contents)
                }
            }
        });
    </script>
@endpush
