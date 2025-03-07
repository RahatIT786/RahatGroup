<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.admin') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}"
                        wire:navigate>{{ __('tablevars.admin') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.admin') }} {{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.admin') }}</h4>
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i>
                                &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.admin') }} {{ __('tablevars.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" wire:model="name">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.admin') }} {{ __('tablevars.id') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="admin_id" class="form-control"
                                            wire:model="admin_id">
                                        @error('admin_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" wire:model="email">
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.password') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="password" class="form-control"
                                            wire:model="password">
                                        @error('password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.admin') }} {{ __('tablevars.role') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" wire:model='admin_type'>
                                            <option value="2">Accounts</option>
                                            <option value="3">Ration</option>
                                            <option value="4">Ticket</option>
                                            <option value="5">Visa</option>
                                            <option value="6">Admin</option>
                                        </select>
                                        @error('admin_type')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
