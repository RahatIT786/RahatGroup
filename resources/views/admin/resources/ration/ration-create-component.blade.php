<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.manage_ration') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ 'Resources Management' }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
                        wire:navigate>{{ __('tablevars.manage_ration') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.manage_ration') }}</h4>
                            <a href="{{ route('admin.manage-ration.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.date') }} <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" wire:model="txn_date">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.ration_title') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="ration_title" maxlength="100">
                                        @error('ration_title')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.number_of_item') }} <span class="text-danger">*</span></label>
                                        <select name="" id="" class="form-control" wire:model="no_item" wire:change="loadDetail">
                                            {{-- <option value="">Select number of items</option> --}}
                                            @for ($i = 1; $i <= 50; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($itemDetails))
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            @foreach($itemDetails as $index => $detail)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h4>{{ __('tablevars.items_detail') }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.items_name') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" wire:model="itemDetails.{{ $index }}.main_item" maxlength="100">
                                                            @error('itemDetails.' . $index . '.main_item') 
                                                                <span class="text-danger">{{ $message }}</span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.departure_city') }} <span class="text-danger">*</span></label>
                                                            <select class="form-control" wire:model="itemDetails.{{ $index }}.city_id">
                                                                <option value="">{{ __('tablevars.select') }} {{ __('tablevars.departure_city') }}</option>
                                                                @foreach ($cityData as $id => $city_name)
                                                                    <option value="{{$id}}">{{$city_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('itemDetails.' . $index . '.city_id') 
                                                                <span class="text-danger">{{ $message }}</span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.weight') }} <span class="text-danger">*</span></label>
                                                            <input type="text" maxlength="10" class="form-control" wire:model.lazy="itemDetails.{{ $index }}.weight" onkeypress='return event.charCode >= 48 && event.charCode <= 57' wire:input="calculateAmount({{ $index }})">
                                                            @error('itemDetails.' . $index . '.weight') 
                                                                <span class="text-danger">{{ $message }}</span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.rate') }} <span class="text-danger">*</span></label>
                                                            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" wire:model.lazy="itemDetails.{{ $index }}.rate" maxlength="10" wire:input="calculateAmount({{ $index }})">
                                                            @error('itemDetails.' . $index . '.rate') 
                                                                <span class="text-danger">{{ $message }}</span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.total') }} <span class="text-danger">*</span></label>
                                                            <input readonly type="text" class="form-control" wire:model="itemDetails.{{ $index }}.total_rate">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.desc') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" wire:model="itemDetails.{{ $index }}.description">
                                                            @error('itemDetails.' . $index . '.description') 
                                                                <span class="text-danger">{{ $message }}</span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="card-footer align-right">
                                <button class="btn btn-primary" wire:click="save">{{ __('tablevars.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </form>
    </section>
</div>
