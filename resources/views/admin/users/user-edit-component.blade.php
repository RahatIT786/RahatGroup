<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.admin') }} {{ __('tablevars.profile') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.admin') }} {{ __('tablevars.profile') }}</div>
                {{-- <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
                        wire:navigate>{{ __('tablevars.users') }}</a></div> --}}
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.user') }}</h4>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.full_name') }}</label><span
                                            class="text-danger">*</span>
                                        <input type="text" name="name" class="form-control" wire:model="name">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ 'Admin Id' }}</label><span
                                            class="text-danger">*</span>
                                        <input type="text" name="name" class="form-control" wire:model="admin_id">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}</label><span class="text-danger">*</span>
                                        <input type="email" name="email" class="form-control" wire:model="email"
                                            >
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}</label><span class="text-danger">*</span>
                                        <input type="email" name="email" class="form-control" wire:model="email"
                                            >
                                        @error('email')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- @if (Auth::user()->id != $id)
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.role') }}</label>
                                            <select class="form-control" wire:model='role_id'
                                                style="pointer-events: none;background: #e9ecef;">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.role') }}</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif --}}
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.phone') }}</label><span class="text-danger">*</span>
                                        <input type="phone" name="phone" class="form-control" wire:model="phone"
                                            >
                                        @error('phone')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.address') }}</label><span class="text-danger">*</span>
                                        <textarea name="address" class="form-control" wire:model="address"></textarea>
                                        @error('address')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- @if (Auth::user()->id != $id)
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.status') }}</label>
                                            <select class="form-control" wire:model="status">
                                                @foreach (App\Helpers\Helper::status() as $key => $value)
                                                    <option value="{{ $key }}" @selected($key === $status)>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif --}}
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.profile_image') }}</label><span
                                            class="text-danger">*</span>
                                        <input type="file" name="profile_image" class="form-control"
                                            wire:model="profile_image">
                                        @error('profile_image')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($profile_image))
                                        <img src="{{ $profile_image->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($profile_image))
                                        <img src="{{ asset('storage/profile_image/' . $profile_image) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div> --}}
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
