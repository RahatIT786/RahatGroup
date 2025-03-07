<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.international_destination') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.intDestination.index') }}"
                        wire:navigate>{{ __('tablevars.international_destination') }} {{ __('tablevars.list') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.add') }} {{ __('tablevars.international_destination') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="save">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.international_destination') }}</h4>
                            <a href="{{ route('admin.intDestination.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.country') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name='name' id="state_ut_id"
                                            wire:model='country_id'>
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country_id => $country_name)
                                                <option value="{{ $country_id }}">{{ $country_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
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

                                <div class="col-lg-6">
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
    </section>
</div>
