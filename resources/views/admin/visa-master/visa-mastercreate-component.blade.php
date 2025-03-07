{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.create') }} {{ __('tablevars.visa') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.visaMaster.index') }}"
                        wire:navigate>{{ __('tablevars.visa') }} {{ __('tablevars.master') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.create') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.create') }} {{ __('tablevars.visa') }}</h4>
                            <a href="{{ route('admin.visaMaster.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }}</label><span
                                            class="text-danger">*</span>
                                        <input type="text" name="name" class="form-control">
                                        @error('name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.country') }} <span class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.country') }}</option>
                                            <option value="1">Saudi Arabia</option>
                                            <option value="2">Jordan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.visa') }} {{ __('tablevars.type') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter visa type">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.entry_type') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.entry_type') }}</option>
                                            <option value="1">Single </option>
                                            <option value="2">Dual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.visa') }} {{ __('tablevars.validity') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter visa validity">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.validity_period') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter days">
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.email') }}</label><span class="text-danger">*</span>
                                        <input type="email" name="email" class="form-control" wire:model="email"
                                            readonly>
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
                                            readonly>
                                        @error('phone')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- <div class="col-6">
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

                        {{-- <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h4>{{ __('tablevars.visa') }} {{ __('tablevars.price') }} {{ __('tablevars.details') }}<span
                                class="text-danger">*</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <label class="label-header" for="search_start_date">Start Date 1</label>
                                <input type="date" name="search_start_date" id="search_start_date"
                                    class="form-control" placeholder="Search Booking Id" autocomplete="off">
                            </div>
                            <div class="col-4 mb-2">
                                <label class="label-header" for="search_end_date">End Date 1</label>
                                <input type="date" name="search_end_date" id="search_end_date" class="form-control"
                                    placeholder="Search Name" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.visa') }} {{ __('tablevars.price') }}1<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter days">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="label-header" for="search_start_date">Start Date 2</label>
                                <input type="date" name="search_start_date" id="search_start_date"
                                    class="form-control" placeholder="Search Booking Id" autocomplete="off">
                            </div>
                            <div class="col-4 mb-2">
                                <label class="label-header" for="search_end_date">End Date 2</label>
                                <input type="date" name="search_end_date" id="search_end_date" class="form-control"
                                    placeholder="Search Name" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.visa') }} {{ __('tablevars.price') }} 2<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter days">
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="label-header" for="search_start_date">Start Date 2</label>
                                <input type="date" name="search_start_date" id="search_start_date"
                                    class="form-control" placeholder="Search Booking Id" autocomplete="off">
                            </div>
                            <div class="col-4 mb-2">
                                <label class="label-header" for="search_end_date">End Date 2</label>
                                <input type="date" name="search_end_date" id="search_end_date"
                                    class="form-control" placeholder="Search Name" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('tablevars.visa') }} {{ __('tablevars.price') }} 2<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter days">
                                </div>
                            </div>
                            <div class="card-footer align-right">
                                <button class="btn btn-primary">{{ __('tablevars.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</section>
</div>
