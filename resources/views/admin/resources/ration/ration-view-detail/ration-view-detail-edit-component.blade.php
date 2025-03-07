<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.ration_view_detail') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.resources') }} {{ __('tablevars.management') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.manage-ration.index') }}"
                        wire:navigate>{{ __('tablevars.manage_ration') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>

        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.ration_view_detail') }}</h4>
                            <a href="{{ route('admin.manage-ration.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="mainItem">Main Item</label>
                                        <input type="text" class="form-control" id="mainItem" wire:model="mainItem">
                                        @error('mainItem')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" wire:model="description"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cityId">City</label>
                                        <select class="form-control" wire:model="cityId">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.departure_city') }}</option>
                                            @foreach ($cityData as $id => $city_name)
                                                <option value="{{ $id }}">{{ $city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cityId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            class="form-control" id="weight" wire:model="weight"
                                            wire:keydown="calculateAmount">
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="rate">Rate</label>
                                        <input type="text"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            class="form-control" id="rate" wire:model="rate"
                                            wire:keydown="calculateAmount">
                                        @error('rate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="total_rate">Total</label>
                                        <input type="text" readonly class="form-control" id="total_rate"
                                            wire:model="total_rate">
                                        @error('total_rate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer align-right">
                                    <button class="btn btn-primary"
                                        wire:click="update">{{ __('tablevars.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
