<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.food_type') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.foodType.index') }}"
                        wire:navigate>{{ __('tablevars.food_type') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }} {{ __('tablevars.food_type') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.food_type') }}</h4>
                            <a href="{{ route('admin.foodType.index') }}" class="btn btn-danger" wire:navigate>
                                <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                            </a>
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
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
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
                                            <h4>Breakfast and Lunch and Dinner </h4>
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
                                        <label class="form-control-label">{{ __('tablevars.image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="images" wire:model="images"
                                            multiple />
                                        @error('images.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Display Uploaded Images -->
                                    @if ($oldimage->isNotEmpty())
                                        @foreach ($regularImage as $img)
                                            <div class="image-container" style="position: relative;">
                                                @if (Str::endsWith($img->image, '.pdf'))
                                                    <a href="{{ asset('storage/food_image/' . $img->image) }}"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"
                                                            style="font-size: 30px; color: red;"></i>
                                                        <span> View PDF</span>
                                                    </a>
                                                @else
                                                    <img src="{{ asset('storage/food_image/' . $img->image) }}"
                                                        style="height: 100px;">
                                                @endif
                                                <button type="button" wire:click="deleteImage({{ $img->id }})"
                                                    class="btn btn-danger btn-sm"
                                                    style="position: absolute; top: 5px; right: 5px;">&times;</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="no-image">No image found</span>
                                    @endif
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.l_image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="l_image" wire:model="l_images"
                                            multiple />
                                        @error('l_images.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Display Uploaded Images -->
                                    @if ($lunchImage->isNotEmpty())
                                        @foreach ($lunchImage as $img)
                                            <div class="image-container" style="position: relative;">
                                                @if (Str::endsWith($img->image, '.pdf'))
                                                    <a href="{{ asset('storage/food_image/' . $img->image) }}"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"
                                                            style="font-size: 30px; color: red;"></i>
                                                        <span> View PDF</span>
                                                    </a>
                                                @else
                                                    <img src="{{ asset('storage/food_image/' . $img->image) }}"
                                                        style="height: 100px;">
                                                @endif
                                                <button type="button" wire:click="deleteImage({{ $img->id }})"
                                                    class="btn btn-danger btn-sm"
                                                    style="position: absolute; top: 5px; right: 5px;">&times;</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="no-image">No image found</span>
                                    @endif
                                </div>



                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.d_image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="d_image"
                                            wire:model="d_images" multiple />
                                        @error('d_images.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Display Uploaded Images -->
                                    @if ($dinnerImage->isNotEmpty())
                                        @foreach ($dinnerImage as $img)
                                            <div class="image-container" style="position: relative;">
                                                @if (Str::endsWith($img->image, '.pdf'))
                                                    <a href="{{ asset('storage/food_image/' . $img->image) }}"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"
                                                            style="font-size: 30px; color: red;"></i>
                                                        <span> View PDF</span>
                                                    </a>
                                                @else
                                                    <img src="{{ asset('storage/food_image/' . $img->image) }}"
                                                        style="height: 100px;">
                                                @endif
                                                <button type="button" wire:click="deleteImage({{ $img->id }})"
                                                    class="btn btn-danger btn-sm"
                                                    style="position: absolute; top: 5px; right: 5px;">&times;</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="no-image">No image found</span>
                                    @endif
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.f_pdf') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="f_pdf"
                                            wire:model="f_pdf"/>
                                        @error('f_pdf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Display Uploaded Images -->
                                    
                                    @if ($f_pdf && !is_array($f_pdf))
                                            <div class="image-container" style="position: relative;">
                                             
                                                    <a href="{{ asset('storage/food_pdf/' . $f_pdf) }}"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf"
                                                            style="font-size: 30px; color: red;"></i>
                                                        <span> View PDF</span>
                                                    </a>
                                                <button type="button" wire:click="deletePdf({{ $id }})"
                                                    class="btn btn-danger btn-sm"
                                                    style="position: absolute; top: 5px; right: 5px;">&times;</button>
                                            </div>
                                       
                                    @else
                                        <span class="no-image">No PDF found</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
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
