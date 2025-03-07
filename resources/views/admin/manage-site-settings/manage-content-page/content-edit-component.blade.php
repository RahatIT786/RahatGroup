<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.content') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_site_settings') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.content.index') }}"
                        wire:navigate>{{ __('tablevars.content') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.content') }}</h4>
                            <a href="{{ route('admin.content.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.page') }}
                                            {{ __('tablevars.name') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='page_id' id="page_id" disabled>
                                            <option value="">Select Page Name</option>
                                            @foreach ($pagecontent as $page_id => $page_name)
                                                <option value="{{ $page_id }}">{{ $page_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="page_idError" style="display: none;">Page name is
                                            required.</span>
                                        @error('page_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="description" class="form-control-label">
                                            {{ __('tablevars.page_content') }}<span
                                                class="text-danger">*</span></label>
                                        <textarea type="text" input="description" class="form-control summernote-simple" wire:model='description'
                                            id="description">{{ $description }}</textarea>
                                        <div id="descriptionError" class="text-danger" style="display: none;">Page
                                            content is required.</div>
                                        @error('description')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary" data-toggle="tooltip" id="updateForm"
                                title="update">{{ __('tablevars.update') }}</button>
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
        $('#description').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen', 'codeview']]

                ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('description', contents)
                }
            }
        });
    </script>
@endpush
