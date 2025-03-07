<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.voucher_content') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }} {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.voucherContent.edit', 1) }}"
                        wire:navigate>{{ __('tablevars.voucher_content') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.voucher_content') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" wire:ignore>
                                                    <label>{{ __('tablevars.voucher_content') }}</label><span
                                                        class="text-danger">*</span>
                                                    <textarea name="voucher_content" id="voucher_content" class="form-control">{{ $voucher_content }}</textarea>
                                                    <div id="voucherContentError" class="text-danger"
                                                        style="display: none;">Voucher content is required.</div>
                                                    @error('voucher_content')
                                                        <span class="v-msg-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary"
                                id="updateForm">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('extra_js')
    <script>
        $(document).ready(function() {
            $('#voucher_content').summernote({
                placeholder: 'Enter Voucher Content',
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
                        contents = contents.trim();
                        if (contents === '<br>' || contents === '<br/>') {
                            contents = '';
                        }
                        @this.set('voucher_content', contents);
                    },
                    onInit: function() {
                        var currentContent = $('#voucher_content').val().trim();
                        if (currentContent === '<br>' || currentContent === '<br/>') {
                            $('#voucher_content').val('');
                        }
                    }
                }
            });

            // Check if there is existing content and initialize Summernote with it
            var existingContent = $('#voucher_content').val();
            if (existingContent) {
                $('#voucher_content').summernote('code', existingContent);
            }

            // Add jQuery validation on form submit
            $("#updateForm").click(function(event) {
                event.preventDefault();
                validateForm();
            });

            function validateForm() {
                var isValid = $('#form')[0].checkValidity();
                var voucherContent = $('#voucher_content').summernote('code').trim();

                if (voucherContent === '<br>' || voucherContent === '<br/>' || voucherContent === '') {
                    $('#voucherContentError').show();
                    isValid = false;
                } else {
                    $('#voucherContentError').hide();
                }

                if (isValid) {
                    $('#voucherContentError').hide();
                    @this.call('update');
                } else {
                    $('#form')[0].reportValidity();
                }
            }
        });
    </script>
@endpush
