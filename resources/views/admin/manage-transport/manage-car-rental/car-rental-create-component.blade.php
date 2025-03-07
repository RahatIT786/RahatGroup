<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.car_rental') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.car_rental') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manageCarRental.index') }}"
                        wire:navigate>{{ __('tablevars.car_rental') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.add') }} {{ __('tablevars.car_rental') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.car_rental') }}</h4>
                            <a href="{{ route('admin.manageCarRental.index') }}" class="btn btn-danger"
                                wire:navigate><i class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.cartype') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='car_type_id' id="car_type_id"
                                            wire:model='car_type_id'>
                                            <option value="">Select Car Type</option>
                                            @foreach ($cartypemaster as $car_type => $CarTypeName)
                                                <option value="{{ $car_type }}">{{ $CarTypeName }}</option>
                                            @endforeach
                                        </select>
                                        @error('car_type_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.car_sector') }}</label><span
                                            class="text-danger">*</span>
                                        <select class="form-control" name='car_sector_id' id="car_sector_id"
                                            wire:model='car_sector_id'>
                                            <option value="">Select Car Sector</option>
                                            @foreach ($carsectormaster as $sector_name => $SectorName)
                                                <option value="{{ $sector_name }}">{{ $SectorName }}</option>
                                            @endforeach
                                        </select>
                                        @error('car_sector_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.no_of_seats') }}</label><span
                                            class="text-danger">*</span>
                                        <select class="form-control" name='no_of_seats' id="no_of_seats"
                                            wire:model='no_of_seats'>
                                            <option value="" selected>Select Seat</option>
                                            @for ($i = 1; $i <= 49; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('no_of_seats')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.air_conditioner') }}</label><span
                                            class="text-danger">*</span>
                                        <select class="form-control" name='air_conditioner' id="air_conditioner"
                                            wire:model='air_conditioner'>
                                            <option value="" selected>Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                        @error('air_conditioner')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.price') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="price" class="form-control" wire:model="price" onkeypress='return event.charCode >= 48 && event.charCode <= 57 step="0.01"' maxlength="7">
                                        @error('price')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('tablevars.car_image') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image[]" wire:model="image"
                                            multiple>
                                        @error('image')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        @foreach ($image as $img)
                                            <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="input-block" wire:ignore>
                                        <label>{{ __('tablevars.terms') }}</label>
                                        <textarea type="text" input="terms" class="form-control summernote" wire:model='terms' id="terms"> {{ $terms }}</textarea>
                                    </div>
                                    @error('terms')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="input-block" wire:ignore>
                                        <label>{{ __('tablevars.description') }}</label>
                                        <textarea type="text" input="description" class="form-control summernote" wire:model='description' id="description">{{ $description }}</textarea>
                                    </div>\
                                    @error('description')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
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
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('description', contents)
                }
            }
        });


        $('#terms').summernote({
            placeholder: 'Enter Terms & Conditions',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('terms', contents)
                }
            }
        });
    </script>
@endpush
