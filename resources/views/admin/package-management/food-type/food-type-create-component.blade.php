<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.food_type') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.foodType.index') }}"
                        wire:navigate>{{ __('tablevars.food_type') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.add') }} {{ __('tablevars.food_type') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.food_type') }}</h4>
                            <a href="{{ route('admin.foodType.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.food_type') }}</label><span
                                            class="text-danger">*</span>
                                        <input type="text" name="food_type" class="form-control"
                                            wire:model="food_type">
                                        @error('food_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.price') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control" wire:model="price"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57 step="0.01"'
                                            maxlength="7">
                                        @error('price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div id="accordion1">
                                    <div class="accordion">
                                        <div class="accordion-header" role="button" data-toggle="collapse"
                                            data-target="#panel-body-1" aria-expanded="true">
                                            <h4>Breakfast , Lunch and Dinner </h4>
                                        </div>
                                        <div class="accordion-body collapse show" id="panel-body-1"
                                            data-parent="#accordion1">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="input-block" wire:ignore>
                                                        <label>BreakFast</label>
                                                        <textarea type="text" input="description" class="form-control summernote" wire:model='description' id="description">{{ $description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-block" wire:ignore>
                                                        <label>Lunch</label>
                                                        <textarea type="text" input="lunch" class="form-control summernote" wire:model='lunch' id="lunch">{{ $lunch }}</textarea>

                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-block" wire:ignore>
                                                        <label>Dinner</label>
                                                        <textarea type="text" input="dinner" class="form-control summernote" wire:model='dinner' id="dinner">{{ $dinner }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.b_image') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image[]" wire:model="image"
                                            accept="image" multiple>
                                        @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        @foreach ($image as $img)
                                            @if ($img->getClientOriginalExtension() === 'pdf')
                                                <p>{{ $img->getClientOriginalName() }}</p>
                                            @else
                                                <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.l_image') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="l_image[]" wire:model="l_image"
                                            accept="image" multiple>
                                        @error('l_image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if ($l_image)
                                        @foreach ($l_image as $lFile)
                                            @if ($lFile->getClientOriginalExtension() === 'pdf')
                                                <p>{{ $lFile->getClientOriginalName() }}</p>
                                            @else
                                                <img src="{{ $lFile->temporaryUrl() }}" style="height: 100px;">
                                            @endif
                                        @endforeach
                                    @endif

                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.d_image') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="d_image[]" wire:model="d_image"
                                            accept="image" multiple>
                                        @error('d_image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if ($d_image)
                                        @foreach ($d_image as $dFile)
                                            @if ($img->getClientOriginalExtension() === 'pdf')
                                                <p>{{ $dFile->getClientOriginalName() }}</p>
                                            @else
                                                <img src="{{ $dFile->temporaryUrl() }}" style="height: 100px;">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.f_pdf') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="f_pdf" wire:model="f_pdf"
                                            accept="application/pdf">
                                        @error('f_pdf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if ($f_pdf)
                                        @if ($f_pdf->getClientOriginalExtension() === 'pdf')
                                            <p>{{ $f_pdf->getClientOriginalName() }}</p>
                                        @else
                                            <img src="{{ $f_pdf->temporaryUrl() }}" style="height: 100px;">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
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
            placeholder: 'Enter Description',
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
                    @this.set('description', contents)
                }
            }
        });


        $('#lunch').summernote({
            placeholder: 'Enter page Content',
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
                    @this.set('lunch', contents)
                }
            }
        });



        $('#dinner').summernote({
            placeholder: 'Enter page Content',
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
                    @this.set('dinner', contents)
                }
            }
        });
    </script>
@endpush
