<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.manage_ration') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage_ration') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
                        wire:navigate>{{ __('tablevars.manage_ration') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>

        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.manage_ration') }}</h4>
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
                                        <input type="text" class="form-control" wire:model="ration_title">
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
