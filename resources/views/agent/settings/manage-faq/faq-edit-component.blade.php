<div class="main-content">
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                @include('agent.layouts.sidebar')
                <div class="col-xl-10 col-lg-9 col-md-12">
                    <div class="card card-primary">
                        <form id="form" wire:submit.prevent="update">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('tablevars.edit') }} {{ __('tablevars.faq') }}</h4>
                                <a href="{{ route('agent.faq.index') }}" class="btn btn-danger"><i
                                        class="fas fa-long-arrow-alt-left" title="Back"></i>
                                    &nbsp;{{ __('tablevars.back') }}</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-block">
                                            <label class="form-control-label">{{ __('tablevars.title') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Title"
                                                wire:model='title' maxlength="200">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="input-block" wire:ignore>
                                            <label for="question" class="form-control-label">{{ __('tablevars.faq') }}
                                                {{ __('tablevars.question') }}<span class="text-danger">*</span></label>
                                            <textarea type="text" input="question" class="form-control" wire:model='question' id="question">{{ $question }}</textarea>
                                        </div>
                                        @error('question')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-block" wire:ignore>
                                            <label for="answer" class="form-control-label">{{ __('tablevars.faq') }}
                                                {{ __('tablevars.answer') }}<span class="text-danger">*</span></label>
                                            <textarea type="text" input="answer" class="form-control" wire:model='answer' id="answer">{{ $answer }}</textarea>
                                        </div>
                                        @error('answer')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    {{-- <div class="col-lg-12">
                                        <div class="input-block" wire:ignore>
                                            <label for="question" class="form-control-label">{{ __('tablevars.faq') }}
                                                {{ __('tablevars.question') }}<span class="text-danger">*</span></label>
                                            <textarea type="text" input="question" class="form-control" wire:model='question' id="question">{{ $question }}</textarea>
                                            @error('question')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-block" wire:ignore>
                                            <label for="answer" class="form-control-label">{{ __('tablevars.faq') }}
                                                {{ __('tablevars.answer') }}<span class="text-danger">*</span></label>
                                            <textarea type="text" input="answer" class="form-control" wire:model='answer' id="answer">{{ $answer }}</textarea>
                                            @error('answer')
                                                <span class="v-msg-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="card-footer text-left">
                                        <button class="btn btn-primary"
                                            title="Update">{{ __('tablevars.update') }}</button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>
</section>
</div>
@push('extra_js')
    <script>
        $(document).ready(function() {
            $('#question').summernote({
                placeholder: 'Enter Question',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('question', contents);
                    }
                }
            });

            $('#answer').summernote({
                placeholder: 'Enter Answer',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('answer', contents);
                    }
                }
            });
        });
    </script>
@endpush
