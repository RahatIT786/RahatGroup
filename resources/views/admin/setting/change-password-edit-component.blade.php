{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.change_pwd') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.change-password.edit', auth()->user()->id) }}" wire:navigate>{{ __('tablevars.change_pwd') }}</a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="updatePassword">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.password') }}</h4>
                            <a href="{{ back()->getTargetUrl() }}" class="btn btn-danger"><i class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.old_pwd') }}</label>
                                        <input type="password" name="old_password" class="form-control" wire:model="old_password">
                                        @error('old_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.new_pwd') }}</label>
                                        <input type="password" name="new_password" class="form-control" wire:model="new_password">
                                        @error('new_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.confirm_pwd') }}</label>
                                        <input type="password" name="confirm_password" class="form-control" wire:model="confirm_password">
                                        @error('confirm_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
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
