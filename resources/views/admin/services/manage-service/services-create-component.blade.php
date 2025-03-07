<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.service') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage') }} {{ __('tablevars.service') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.services.index') }}"
                        wire:navigate>{{ __('tablevars.manage') }} {{ __('tablevars.service') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.service') }}</h4>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Name" wire:model="name" maxlength="200" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.price') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="price" class="form-control" wire:model="price"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57 step="0.01"'
                                            maxlength="7">
                                        @error('price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.service') }}
                                            {{ __('tablevars.image') }}<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="service_img"
                                            wire:model="service_img">
                                        @error('service_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($service_img)
                                        <img src="{{ $service_img->temporaryUrl() }}" style="height: 100px;">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block" wire:ignore>
                                        <label for="description" class="form-control-label">
                                            {{ __('tablevars.description') }}<span class="text-danger">*</span>
                                        </label>
                                        <textarea type="text" id="description" class="form-control" wire:model="description">{{ $description }}</textarea>
                                        @error('description')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <button title="Submit"
                                        class="btn btn-primary">{{ __('tablevars.submit') }}</button>
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
