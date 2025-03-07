<div class="main-content">
    <div wire:loading>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.Agm') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agm.index') }}"
                        wire:navigate>{{ __('tablevars.Agm') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.Agm') }}</h4>
                            <a href="{{ route('admin.agm.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>&nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            wire:model="name" maxlength="200">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-block" wire:ignore>
                                        <label for="description" class="form-control-label">
                                            {{ __('tablevars.description') }}<span class="text-danger">*</span>
                                        </label>
                                        <textarea id="description" class="form-control" wire:model.lazy="description"></textarea>
                                        <div id="descriptionError" class="text-danger" style="display: none;">
                                            Description is required.</div>
                                        @error('description')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.upload_multiple') }}
                                            {{ __('tablevars.image') }}<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" wire:model="image"
                                            wire:click="uploadingImage" multiple />
                                        @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Display temporary images -->
                                    @if ($image)
                                        @foreach ($image as $img)
                                            <img src="{{ $img->temporaryUrl() }}"
                                                style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                        @endforeach
                                    @endif

                                    <!-- Display persisted images -->
                                    @if ($oldimage && !$image)
                                        @foreach ($oldimage as $imgId => $img)
                                            <div style="display: inline-block; position: relative;">
                                                <img src="{{ asset('storage/agm/' . $img) }}"
                                                    style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                                <button type="button" wire:click="deleteImage({{ $imgId }})"
                                                    style="position: absolute; top: 5px; right: 5px;"
                                                    class="btn btn-danger btn-sm">&times;</button>
                                            </div>
                                        @endforeach
                                    @endif

                                    <!-- No images message -->
                                    @if (empty($image) && empty($oldimage))
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button type="update" class="btn btn-primary" data-toggle="tooltip"
                                title="{{ __('tablevars.update') }}"
                                @if (!$imagesPreviewed) disabled @endif>{{ __('tablevars.update') }}</button>
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
            $('#description').summernote({
                placeholder: 'Enter Description',
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
                        @this.set('description', contents);
                    }
                }
            });
        });
    </script>
@endpush


@push('extra_js')
    <script>
        $(document).ready(function() {
            // Initialize Summernote for description field
            $('#description').summernote({
                placeholder: 'Enter Description',
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
                        // Update Livewire component's 'description' property
                        @this.set('description', contents.trim());
                    },
                    onInit: function() {
                        // Initialize Summernote with current content
                        var currentContent = $('#description').val().trim();
                        if (currentContent === '<br>' || currentContent === '<br/>') {
                            $('#description').summernote('empty');
                        }
                    }
                }
            });

            // Add jQuery validation on form submit
            $('#form').submit(function(event) {
                event.preventDefault();
                validateForm();
            });

            function validateForm() {
                var isValid = true;

                // Validate description
                var description = $('#description').summernote('code').trim();
                if (description === '<br>' || description === '') {
                    $('#descriptionError').show();
                    isValid = false;
                } else {
                    $('#descriptionError').hide();
                }

                // If the form is valid, submit the Livewire action
                if (isValid) {
                    $('#descriptionError').hide();
                    @this.call('update'); // Call Livewire method 'save' to handle form submission
                } else {
                    $('#form')[0].reportValidity();
                }
            }
        });
    </script>
@endpush
