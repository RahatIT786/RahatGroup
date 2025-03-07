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
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.Agm') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.ManageSiteSettings') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.agm.index') }}"
                        wire:navigate>{{ __('tablevars.Agm') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.Agm') }}</h4>
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

                                {{-- <div class="col-lg-12">
                                                <div class="input-block" wire:ignore>
                                                    <label for="description" class="form-control-label">
                                                        {{ __('tablevars.description') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text" input="description" class="form-control summernote-simple" wire:model='description' id="description">{{ $description }}</textarea>
                                                    <div id="descriptionError" class="text-danger" style="display: none;">Description is required.</div>
                                                    @error('description')
                                                        <span class="v-msg-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> --}}


                                <div class="col-lg-12">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.upload_multiple') }}
                                            {{ __('tablevars.image') }}<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image[]" wire:model="image"
                                            multiple />
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @error('image.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($image)
                                        @foreach ($image as $img)
                                            <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                title="{{ __('tablevars.submit') }}"
                                @if (!$imagesPreviewed) disabled @endif>{{ __('tablevars.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>


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
