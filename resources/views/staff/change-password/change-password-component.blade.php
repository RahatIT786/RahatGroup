<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updatePassword">
                        <h4 class="card-title"><u>Change Password</u></h4>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.old_pwd') }}</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="old_password" class="form-control"
                                            wire:model="old_password">
                                        @error('old_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.new_pwd') }}</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password" class="form-control"
                                            wire:model="new_password">
                                        @error('new_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('tablevars.confirm_pwd') }}</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="confirm_password" class="form-control"
                                            wire:model="confirm_password">
                                        @error('confirm_password')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-sm-right mt-4">
                            <button type="submit" class="btn btn-primary mb-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
