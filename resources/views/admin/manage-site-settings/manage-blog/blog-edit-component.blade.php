<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.blog') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.blog') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.blog') }}</h4>
                            <a href="{{ route('admin.blog.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.blog_title') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Title" wire:model="title" maxlength="100" />
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.subtitle') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="subtitle" id="subtitle"
                                            placeholder="Enter Subtitle" wire:model="subtitle" maxlength="200" />
                                        @error('subtitle')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block" wire:ignore>
                                        <label for="description"
                                            class="form-control-label">{{ __('tablevars.desc') }}<span
                                                class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" wire:model='description' id="description">{{ $description }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.blog_image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" wire:model="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($image))
                                        <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($imageEdit))
                                        <img src="{{ asset('storage/blog_image/' . $imageEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                                <div class="card-footer text-left">
                                    <button title="Update"
                                        class="btn btn-primary">{{ __('tablevars.update') }}</button>
                                </div>
                            </div>
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
                    ['font', ['bold', 'italic', 'underline', 'clear']],
            
                    ['para', ['ul', 'ol', 'paragraph']],
                   
                    ['view', ['fullscreen', 'codeview']]
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
