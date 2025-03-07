<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="settings-widget">
                    <div class="settings-inner-blk p-0">
                        <div class="comman-space">

                            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                <h3>Change Password</h3>
                            </div>
                            @if (!empty($err_msg))
                                <div class="alert alert-danger" id="errorid">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    <strong><i class="ace-icon fa fa-times"></i></strong>
                                    <strong class="red">{{ $err_msg }}</strong>
                                </div>
                            @endif
                            @if (!empty($success_msg))
                                <div class="alert alert-block alert-success" id="succid">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    <i class="ace-icon fa fa-check green"></i>
                                    <strong class="green">{{ $success_msg }}</strong>
                                </div>
                            @endif
                            <form wire:submit.prevent="save" class="form-signin">

                                <input wire:model="old_password" type="password" class="form-control rounded mb-3"
                                    placeholder="Old Password" autofocus>
                                @error('old_password')
                                    <span class="v-msg-500 text-danger">{{ $message }}</span>
                                @enderror

                                <input wire:model="new_password" type="password" class="form-control rounded mb-3"
                                    placeholder="New Password" autofocus>
                                @error('new_password')
                                    <span class="v-msg-500 text-danger">{{ $message }}</span>
                                @enderror

                                <input wire:model="confirm_password" type="password" class="form-control rounded mb-3"
                                    placeholder="Confirm Password">
                                @error('confirm_password')
                                    <span class="v-msg-500 text-danger">{{ $message }}</span>
                                @enderror
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('agent.profile.index') }}" class="btn btn-warning">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>
</div>
</div>
