<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.hotel') }} {{ __('tablevars.room_image') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hotel.index') }}"
                        wire:navigate>{{ __('tablevars.hotel') }} {{ __('tablevars.room_image') }}
                    </a></div>
                <div class="breadcrumb-item">{{ __('tablevars.add') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.add') }} {{ __('tablevars.hotel') }} {{ __('tablevars.room_image') }}
                            </h4>
                            <a href="{{ route('admin.hotel.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="standard_room_image">{{ __('tablevars.standard_room') }}
                                            {{ __('tablevars.type_image') }}<span class="text-danger">*</span></label>
                                        <input type="file" name="standard_room_image" id="standard_room_image"
                                            class="form-control" wire:model="standard_room_image">
                                        @error('standard_room_image')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($standard_room_image))
                                        <img src="{{ $standard_room_image->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($standard_room_image))
                                        <img src="{{ asset('storage/hotel_room_images/' . $standard_room_image) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="deluxe_room_image">{{ __('tablevars.deluxe_room') }}
                                            {{ __('tablevars.type_image') }}<span class="text-danger">*</span></label>
                                        <input type="file" name="deluxe_room_image" id="deluxe_room_image"
                                            class="form-control" wire:model="deluxe_room_image">
                                        @error('deluxe_room_image')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- @if ($deluxe_room_image)
                                        <img src="{{ $deluxe_room_image->temporaryUrl() }}" style="height: 100px;">
                                    @endif --}}

                                    @if (is_object($deluxe_room_image))
                                        <img src="{{ $deluxe_room_image->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($deluxe_room_image))
                                        <img src="{{ asset('storage/hotel_room_images/' . $deluxe_room_image) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                                <div class="card-footer text-left">
                                    <button title="Submit"
                                        class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
