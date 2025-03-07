<div class="page-content">
    <div class="container-fluid">
        <div class="row">
             @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="settings-widget profile-details">
                                <div class="settings-menu p-0">
                                    <div class="filter-grp ticket-grp d-flex justify-content-between profile-heading">
                                        <h3 class="m-0">Add New Content Page</h3>

                                        <div>
                                            <a class="btn btn-primary" href="{{ route('agent.content.index') }}">Back</a>
                                        </div>
                                    </div>
                                    <div class="checkout-form personal-address add-course-info">
                                    <form id="form" wire:submit.prevent="save">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-block">
                                                    <label class="form-control-label">{{ __('tablevars.page') }}
                                                        {{ __('tablevars.name') }}<span class="text-danger">*</span></label>
                                                    <select class="form-control" wire:model='page_id' id="page_id">
                                                        <option value="">Select Page Name</option>
                                                        @foreach ($pagecontent as $page_id => $page_name)
                                                            <option value="{{ $page_id }}">{{ $page_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="page_idError" style="display: none;">Page name is required.</span>
                                                    @error('page_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-block" wire:ignore>
                                                    <label for="description" class="form-control-label">
                                                        {{ __('tablevars.page_content') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text" input="description" class="form-control summernote-simple" wire:model='description' id="description">{{ $description }}</textarea>
                                                    <div id="descriptionError" class="text-danger" style="display: none;">Page content is required.</div>
                                                    @error('description')
                                                        <span class="v-msg-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="card-footer text-left">
                                                <button class="btn btn-primary" data-toggle="tooltip" id="saveForm" title="submit">{{ __('tablevars.submit') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('extra_js')
<script>
    $(document).ready(function() {
        $('#description').summernote({
            placeholder: 'Enter Page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    contents = contents.trim();
                    if (contents === '<br>' || contents === '<p><br></p>') {
                        contents = '';
                    }
                    @this.set('description', contents);
                },
                onInit: function() {
                    var currentContent = $('#description').val().trim();
                    if (currentContent === '<br>' || currentContent === '<p><br></p>') {
                        $('#description').val('');
                    }
                }
            }
        });

        // Check if there is existing content and initialize Summernote with it
        var existingContent = $('#description').val();
        if (existingContent) {
            $('#description').summernote('code', existingContent);
        }

        // Add jQuery validation on form submit
        $("#saveForm").click(function(event) {
            event.preventDefault();
            validateForm();
        });

        function validateForm() {
            var isValid = true;

            // Validate page_id
            if ($('#page_id').val() === '') {
                $('#page_idError').show();
                isValid = false;
            } else {
                $('#page_idError').hide();
            }

            // Validate description
            var descriptionContent = $('#description').summernote('code').trim();
            if (descriptionContent === '<p><br></p>' || descriptionContent === '') {
                $('#descriptionError').show();
                isValid = false;
            } else {
                $('#descriptionError').hide();
            }

            // Submit form if valid
            if (isValid) {
                $('#descriptionError').hide();
                @this.call('save');
            } else {
                $('#form')[0].reportValidity();
            }
        }
    });
</script>
@endpush



