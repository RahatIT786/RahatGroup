<div class="main-content">
    {{-- <div wire:loading>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div> --}}
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ 'Package Master' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.package.index') }}"
                        wire:navigate>{{ 'Package Master' }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <form>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ 'Package Master' }}</h4>
                            <a href="{{ route('admin.package.index') }}" class="btn btn-danger" wire:navigate>
                                <i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            {{-- Package name --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ 'Package Master' }} {{ __('tablevars.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="package_name" name="package_name"
                                            wire:model="package_name" placeholder="Enter Package name">
                                        @error('package_name')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Package Type --}}
                                <div class="col-8">
                                    <div class="form-group" wire:ignore>
                                        <label>{{ 'Package Type' }}<span class="text-danger">*</span></label>
                                        <select class="form-control" id="package_type" name="package_type"
                                            wire:model="package_type_ids" multiple data-height="100%"
                                            style="height: 100%;">
                                            @foreach ($packageType as $key => $val)
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
                            </div>
                            <div class="row">
                                {{-- Service Type --}}
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ 'Service' }}<span class="text-danger">*</span></label>
                                                <select class="form-control" id="service_id" name="service_id"
                                                    wire:model="service_id" wire:change='changeFields'>
                                                    <option value="">Select a Service</option>
                                                    @foreach ($serviceType as $service_type)
                                                        <option value="{{ $service_type->id }}">
                                                            {{ $service_type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('service_id')
                                                    <span class="v-msg">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Umrah Type --}}
                                        @if ($service_id == 2)
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>{{ 'Umrah Type' }}<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" id="service_id" name="service_id"
                                                        wire:model="umrah_type">
                                                        <option value="">Select a Umrah Type</option>
                                                        <option value="1">Fixed Group Departures</option>
                                                        <option value="2">Umrah Land Package</option>
                                                    </select>
                                                    @error('umrah_type')
                                                        <span class="v-msg">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- Package description --}}
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>{{ 'Description' }}<span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" wire:model="description" class="form-control"></textarea>
                                        @error('description')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Package image --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ 'Package Image' }}<span class="text-danger">*</span></label>
                                        <input type="file" name="package_image" id="package_image"
                                            wire:model="package_image" class="form-control" multiple>
                                        @error('package_image')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if (!empty($package_image))
                                        @foreach ($package_image as $img)
                                            <img src="{{ $img->temporaryUrl() }}"
                                                style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                        @endforeach
                                    @elseif (!empty($package_image_edit))
                                        @foreach ($package_image_edit as $img)
                                            <img src="{{ asset('storage/package_image/' . $img) }}"
                                                style="height: 100px;width: 150px;padding: 10px;border-radius: 15px;">
                                        @endforeach
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ 'Package Includes' }}<span class="text-danger">*</span></label><br />
                                        @foreach ($packageIncludesOptions as $includeOption)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ strtolower(str_replace(' ', '', $includeOption)) }}"
                                                    name="package_includes" value="{{ $includeOption }}"
                                                    wire:model.defer="package_includes.{{ $includeOption }}">
                                                <label class="form-check-label"
                                                    for="{{ strtolower(str_replace(' ', '', $includeOption)) }}">
                                                    {{ $includeOption }}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('package_includes')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Policies</h4>
                    </div>
                    <div class="card-body">
                        <div id="accordion1">
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse"
                                    data-target="#panel-body-1" aria-expanded="true">
                                    <h4>Payment Policy , Important Notes And Canclation Policy</h4>
                                </div>
                                <div class="accordion-body collapse show" id="panel-body-1"
                                    data-parent="#accordion1">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Payment Policy</label>
                                                <textarea type="text" input="payment_policy" class="form-control summernote" wire:model='payment_policy'
                                                    id="payment_policy">{{ $payment_policy }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Important Notes</label>
                                                <textarea type="text" input="important_notes" class="form-control summernote" wire:model='important_notes'
                                                    id="important_notes">{{ $important_notes }}</textarea>

                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Cancellation Policy</label>
                                                <textarea type="text" input="cancellation_policy" class="form-control summernote"
                                                    wire:model='cancellation_policy' id="cancellation_policy">{{ $cancellation_policy }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="accordion2">
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse"
                                    data-target="#panel-body-2" aria-expanded="true">
                                    <h4>Package Overview</h4>
                                </div>
                                <div class="accordion-body collapse show" id="panel-body-2"
                                    data-parent="#accordion2">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Flight & Transport</label>
                                                <textarea type="text" input="flight_transport" class="form-control summernote" wire:model='flight_transport'
                                                    id="flight_transport">{{ $flight_transport }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Meals</label>
                                                <textarea type="text" input="meals1" class="form-control summernote" wire:model='meals1' id="meals1">{{ $meals1 }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Visa & Taxes</label>
                                                <textarea type="text" input="visa_taxes" class="form-control summernote" wire:model='visa_taxes'
                                                    id="visa_taxes">{{ $visa_taxes }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="accordion3">
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse"
                                    data-target="#panel-body-2" aria-expanded="true">
                                    <h4>Inclusion , Exclusion And Itinerary</h4>
                                </div>
                                <div class="accordion-body collapse show" id="panel-body-2"
                                    data-parent="#accordion2">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Inclusion</label>
                                                <textarea type="text" input="inclusion" class="form-control summernote" wire:model='inclusion' id="inclusion">{{ $inclusion }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Exclusion</label>
                                                <textarea type="text" input="exlusion" class="form-control summernote" wire:model='exlusion' id="exlusion">{{ $exlusion }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-block" wire:ignore>
                                                <label>Itinerary</label>
                                                <textarea type="text" input="itinerary" class="form-control summernote" wire:model='itinerary' id="itinerary">{{ $itinerary }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="align-right mb-4" wire:ignore>
            <button class="btn btn-primary" id="proceed-button">Proceed</button>
            <button class="btn btn-primary" wire:click='resetForm' wire:ignore>Reset</button>
        </div>
        @if ($this->package_type_ids != null)
            @foreach ($package_type_ids as $k => $v)
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $v }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Makka Hotel --}}
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Makka Hotel Cat<span class="text-danger">*</span></label>
                                        <select class="form-control" id="makka_rating" name="makka_rating"
                                            wire:model="makka_rating.{{ $k }}"
                                            wire:change="getMakkaHotel({{ $k }})">
                                            <option value="">{{ 'Select' }} {{ 'Makka Hotel Category' }}
                                            </option>
                                            <option value="1">One Star</option>
                                            <option value="2">Two Star</option>
                                            <option value="3">Three Star</option>
                                            <option value="4">Four Star</option>
                                            <option value="5">Five Star</option>
                                            <option value="Standard Hotel">Standard Hotel</option>
                                            <option value="Building Accommodation">Building Accommodation</option>
                                        </select>
                                        @error("makka_rating.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Makka Hotel<span class="text-danger">*</span></label>
                                        <select class="form-control" id="makka_hotel{{ $k }}"
                                            name="makka_hotel" wire:model="makka_hotel.{{ $k }}">
                                            <option value="">{{ __('tablevars.select') }} {{ 'Makka Hotel' }}
                                            </option>
                                            @if (!empty($makkaHotel[$k]))
                                                @foreach ($makkaHotel[$k] as $id => $hotel_name)
                                                    <option value="{{ $id }}">{{ $hotel_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error("makka_hotel.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Makka Hotel End --}}
                                {{-- Madina Hotel --}}
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Madina Hotel Cat<span class="text-danger">*</span></label>
                                        <select class="form-control" id="madina_rating" name="madina_rating"
                                            wire:model="madina_rating.{{ $k }}"
                                            wire:change="getMadinaHotel({{ $k }})">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ 'Madina Hotel Category' }}</option>
                                            <option value="1">One Star</option>
                                            <option value="2">Two Star</option>
                                            <option value="3">Three Star</option>
                                            <option value="4">Four Star</option>
                                            <option value="5">Five Star</option>
                                            <option value="Standard Hotel">Standard Hotel</option>
                                            <option value="Building Accommodation">Building Accommodation</option>
                                        </select>
                                        @error("madina_rating.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Madina Hotel<span class="text-danger">*</span></label>
                                        <select class="form-control" id="madina_hotel{{ $k }}"
                                            name="madina_hotel" wire:model="madina_hotel.{{ $k }}">
                                            <option value="">{{ __('tablevars.select') }} {{ 'Madina Hotel' }}
                                            </option>
                                            @if (!empty($madinaHotel[$k]))
                                                @foreach ($madinaHotel[$k] as $id => $hotel_name)
                                                    <option value="{{ $id }}">{{ $hotel_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error("madina_hotel.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Madina Hotel End --}}
                                {{-- Meal --}}
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Meal Type<span class="text-danger">*</span></label>
                                        <select class="form-control" id="food_type{{ $k }}"
                                            name="food_type" wire:model="food_type.{{ $k }}">
                                            <option value="">{{ __('tablevars.select') }} {{ 'Food Type' }}
                                            </option>
                                            @foreach ($packageType as $key => $val)
                                                <option value="{{ $key }}">
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("food_type.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Laundry --}}
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Laundray Type<span class="text-danger">*</span></label>
                                        <select class="form-control" id="laundray_type{{ $k }}"
                                            name="laundray_type" wire:model="laundray_type.{{ $k }}">
                                            <option value="">{{ __('tablevars.select') }} {{ 'Laundray Type' }}
                                            </option>
                                            @foreach ($lundrayMaster as $id => $lundray_type)
                                                <option value="{{ $id }}">{{ $lundray_type }}</option>
                                            @endforeach
                                        </select>
                                        @error("laundray_type.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Price Rate --}}
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Sharing' }}<span class="text-danger">*</span></label>
                                        <input type="text" name="g_share_price"
                                            id="g_share_price{{ $k }}"
                                            wire:model="g_share_price.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("g_share_price.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Quint' }}</label>
                                        <input type="text" name="qt_share_price"
                                            id="qt_share_pric{{ $k }}e"
                                            wire:model="qt_share_price.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("qt_share_price.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Quad' }}</label>
                                        <input type="text" name="qd_share_price"
                                            id="qd_share_price{{ $k }}"
                                            wire:model="qd_share_price.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("qd_share_price.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Triple' }}</label>
                                        <input type="text" name="t_share_price"
                                            id="t_share_price{{ $k }}"
                                            wire:model="t_share_price.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("t_share_price.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Double' }}</label>
                                        <input type="text" name="d_share_price"
                                            id="d_share_price{{ $k }}"
                                            wire:model="d_share_price.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("d_share_price.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Single' }}</label>
                                        <input type="text" name="single_price"
                                            id="single_price{{ $k }}"
                                            wire:model="single_price.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("single_price.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Child with Bed' }}<span class="text-danger">*</span></label>
                                        <input type="text" name="child_w_b" id="child_w_b{{ $k }}"
                                            wire:model="child_w_b.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("child_w_b.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Child without Bed' }}<span class="text-danger">*</span></label>
                                        <input type="text" name="child_wo_b" id="child_wo_b{{ $k }}"
                                            wire:model="child_wo_b.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("child_wo_b.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>{{ 'Infant' }}<span class="text-danger">*</span></label>
                                        <input type="text" name="infants" id="infants{{ $k }}"
                                            wire:model="infants.{{ $k }}" class="form-control"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            maxlength ='6'>
                                        @error("infants.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Price Rate End --}}
                                {{-- package includes --}}
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ 'Package Includes' }}<span class="text-danger">*</span></label><br />

                                        @foreach (['Zamzam', 'Transfers', 'Saudi Sim', 'Welcome Kit', 'Meals', 'Ziyarat'] as $include)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                       id="{{ $include }}{{ $k }}" name="package_includes_{{ $k }}[]"
                                                       value="{{ $include }}" wire:model="package_includes.{{ $k }}.{{ $include }}" wire:change='packageInclude({{ $k }})'>
                                                <label class="form-check-label" for="{{ $include }}{{ $k }}">{{ $include }}</label>
                                            </div>
                                        @endforeach

                                        @error("package_includes.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- package includes start --}}
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ 'Package Includes' }}<span
                                                class="text-danger">*</span></label><br />
                                        @foreach ($packageIncludesOptions as $includeOption)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ strtolower(str_replace(' ', '', $includeOption)) }}{{ $k }}"
                                                    name="package_includes[{{ $k }}][]"
                                                    value="{{ $includeOption }}"
                                                    wire:model.defer="package_includes.{{ $k }}.{{ $includeOption }}"
                                                    wire:change='packageInclude({{ $k }})'>
                                                <label class="form-check-label"
                                                    for="{{ strtolower(str_replace(' ', '', $includeOption)) }}{{ $k }}">
                                                    {{ $includeOption }}
                                                </label>
                                            </div>
                                        @endforeach

                                        @error("package_includes.{$k}")
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- package includes End --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="align-right mb-4">
                <button class="btn btn-primary" wire:click='update'>Update</button>
            </div>
        @endif
    </section>

</div>
@push('extra_js')
    <script>
        $(document).ready(function() {
            $('#package_type').select2();

            $('#package_type').val(@this.type_ids).trigger('change');


            $('#package_type').on('change', function(e) {
                var data = $('#package_type').select2("val");
                @this.set('selectedPackgagesTypes', data);
                @this.call('hideForm', data);
            });

            // Handle button click
            $('#proceed-button').on('click', function() {
                var selectedPackages = $('#package_type').select2('val');
                @this.call('getPackageForm', selectedPackages);
            });
        });

        $('#payment_policy').summernote({
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
                    @this.set('payment_policy', contents)
                }
            }
        });

        $('#important_notes').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('important_notes', contents)
                }
            }
        });

        $('#cancellation_policy').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('cancellation_policy', contents)
                }
            }
        });

        $('#flight_transport').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('flight_transport', contents)
                }
            }
        });

        $('#meals1').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('meals1', contents)
                }
            }
        });

        $('#visa_taxes').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('visa_taxes', contents)
                }
            }
        });
        $('#inclusion').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('inclusion', contents)
                }
            }
        });

        $('#exlusion').summernote({
            placeholder: 'Enter page Content',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('exlusion', contents)
                }
            }
        });

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
                //['insert', ['link', 'picture', 'video']],
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
