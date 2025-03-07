<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ 'Tour Master' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.tour') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.tours.index') }}" wire:navigate>{{ 'Tour Master' }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="getPackageForm"> <!-- Prevent page refresh -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ 'Tour Master' }}</h4>
                            <a href="{{ route('admin.tours.index') }}" class="btn btn-danger" wire:navigate>
                                <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Tour name --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>{{ 'Tour Master' }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tour_name" name="tour_name"
                                            wire:model="tour_name" placeholder="Enter Tour name">
                                        @error('tour_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- State name --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>State<span class="text-danger">*</span></label>
                                        <select class="form-control" id="state" name="state" wire:model="state_id"
                                            wire:change='getDestinations'>
                                            <option value="">Select a State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('state_id')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Destination --}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Destination<span class="text-danger">*</span></label>
                                        <select class="form-control" id="destination_id" name="destination_id"
                                            wire:model="destination_ids" multiple data-height="100%"
                                            style="height: 100%;">
                                            <option value="">Select a Destination</option>
                                            @if ($destinations)
                                                @foreach ($destinations as $destination)
                                                    <option value="{{ $destination->id }}">
                                                        {{ $destination->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('destination_ids')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Package Type --}}
                                <div class="col-3">
                                    <div class="form-group" wire:ignore>
                                        <label>{{ 'Tour Type' }}<span class="text-danger">*</span></label>
                                        <select class="form-control" id="package_type" name="package_type"
                                            wire:model="package_type_ids" multiple data-height="100%"
                                            style="height: 100%;">
                                            @foreach ($packageTypes as $key => $val)
                                                <option value="{{ $key }}">
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('package_type_ids')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group input-block" wire:ignore>
                                        <label>Itinerary</label>
                                        <textarea type="text" input="itinerary" class="form-control summernote" wire:model='itinerary' id="itinerary">{{ $itinerary }}</textarea>
                                    </div>
                                </div>
                                {{-- Tour image --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ 'Tour Image' }}<span class="text-danger">*</span></label>
                                        <input type="file" name="tour_image[]" id="tour_image"
                                            wire:model="tour_image" class="form-control" multiple>

                                    </div>
                                    @if ($tour_image)
                                        @foreach ($tour_image as $img)
                                            <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                                        @endforeach
                                    @elseif ($uploaded_images)
                                        @foreach ($uploaded_images as $img)
                                            <img src="{{ asset('storage/domestic_tour_image/' . $img->tour_img) }}"
                                                style="height: 100px;">
                                        @endforeach

                                    @endif
                                    @error('tour_image')
                                        <span class="v-msg">No image found</span>
                                    @enderror
                                </div>

                                {{-- Themes --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="d-block">Themes</label>
                                        <div class="row">
                                            @foreach ($tour_categories as $category)
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="themes{{ $category->id }}" value="{{ $category->id }}"
                                                            wire:model="selectedThemes">
                                                        <label class="form-check-label"
                                                            for="themes{{ $category->id }}">
                                                            {{ $category->cat_name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('selectedThemes')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{-- Includes --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="d-block">Includes</label>
                                        <div class="row">
                                            @foreach ($tour_includes as $key => $include)
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="includes{{ $key }}"
                                                            value="{{ $key }}"
                                                            wire:model="selectedIncludes">
                                                        <label class="form-check-label"
                                                            for="includes{{ $key }}">
                                                            {{ $include }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('selectedIncludes')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <div class="align-right mb-4">
            <button class="btn btn-primary" id="proceed-button" wire:click="getPackageForm">Proceed</button>
        </div>

    </section>
    @if ($package_types)
        @foreach ($package_types as $key => $pkg_type)
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ $pkg_type }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($destinations as $destination)
                                    @php
                                        $city = \App\Models\City::where('city_name', $destination->name)->first();
                                        $hotels = \App\Models\HotelMaster::where('city_id', $city->id)->get();
                                    @endphp
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Hotel for {{ $destination->name }}<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="hotel_{{ $destination->id }}"
                                                name="hotels[{{ $destination->id }}][]"
                                                wire:model="selectedHotels.{{ $key }}.{{ $destination->id }}">
                                                <option value="">Select a Hotel</option>
                                                @foreach ($hotels as $hotel)
                                                    <option value="{{ $hotel->id }}">
                                                        {{ $hotel->hotel_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('selectedHotels.' . $destination->id)
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Nights in {{ $destination->name }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                id="nights_{{ $destination->id }}"
                                                name="nights[{{ $destination->id }}]"
                                                wire:model="nights.{{ $key }}.{{ $destination->id }}"
                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                maxlength="2" placeholder="Enter Number of Nights">
                                            @error('nights.' . $destination->id)
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Price<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="price_{{ $key }}"
                                            name="price[{{ $key }}]" wire:model="price.{{ $key }}"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength="6" placeholder="Enter Price">
                                        @error('price.' . $key)
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="align-right mb-4">
            <button class="btn btn-primary" id="save-button" wire:click="update">Update</button>
        </div>
    @endif
</div>

@push('extra_js')
    <script>
        $('#itinerary').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('itinerary', contents)
                }
            }
        });
    </script>
@endpush
