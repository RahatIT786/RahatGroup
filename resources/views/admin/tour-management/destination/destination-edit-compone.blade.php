<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.domestic_destination') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.tour_package_management') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.destination.index') }}"
                        wire:navigate>{{ __('tablevars.domestic_destination') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }} {{ __('tablevars.domestic_destination') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.domestic_destination') }}</h4>
                            <a href="{{ route('admin.destination.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.state') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='name' id="state_ut_id"
                                        wire:model='state_ut_id'>
                                        <option value="">Select State</option>
                                        @foreach ($tourstate as $state_ut_id => $StateName)
                                            <option value="{{ $state_ut_id }}">{{ $StateName }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_ut_id')
                                        <span class="v-msg-500">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" wire:model="name">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.image') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" wire:model="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($imageEdit))
                                        <img src="{{ asset('storage/destination_img/' . $imageEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>

                            </div>

                            <div class="card-footer text-left">
                                <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
