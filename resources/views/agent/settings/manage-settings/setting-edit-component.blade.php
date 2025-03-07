<div class="page-content">
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                @include('agent.layouts.sidebar')
                <div class="col-xl-10 col-lg-9 col-md-12">
                    <div class="tak-instruct-group">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="settings-widget profile-details">
                                    <div class="settings-menu p-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex justify-content-between profile-heading">
                                            <h3 class="m-0">{{ __('tablevars.edit_setting') }}</h3>
                                            <div>
                                                <a class="btn btn-primary"
                                                    href="{{ route('agent.setting.index') }}"data-toggle="tooltip"
                                                    title="Back">Back</a>
                                            </div>
                                        </div>
                                        <div class="checkout-form personal-address add-course-info">
                                            <form wire:submit.prevent="update">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="input-block">
                                                            <label
                                                                class="form-control-label">{{ __('tablevars.parameter') }}
                                                                {{ __('tablevars.name') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" wire:model='parameter_id'
                                                                disabled>
                                                                <option value="">Select Parameter Name</option>
                                                                @foreach ($setting as $id => $parameter_name)
                                                                    <option
                                                                        value="{{ $id }}"@if ($parameter_id == $id) selected @endif>
                                                                        {{ $parameter_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('parameter_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-block">
                                                            <label class="form-control-label">
                                                                <th>{{ __('tablevars.settings_value') }}</th>
                                                            </label><span class="text-danger">*</span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter settings value"
                                                                wire:model='settings_value' maxlength="100">
                                                            @error('settings_value')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-left">
                                                        <button class="btn btn-primary" data-toggle="tooltip"
                                                            title="update">{{ __('tablevars.update') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
