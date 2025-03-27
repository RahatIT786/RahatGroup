<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="settings-widget account-settings">
                    <div class="settings-inner-blk p-0">
                        <div class="comman-space pb-0">
                            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                <h3>User Enquiry</h3>
                            </div>
                            {{-- <div class="instruct-search-blk mb-0">
                                <div class="show-filter all-select-blk">
                                    <div class="row gx-2">
                                        <div class="col-md-3 col-lg-3 col-item">
                                            <label>{{ __('tablevars.select') }} {{ __('tablevars.city') }}
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="city_id" wire:change="changeInput">
                                                <option value="">{{ __('tablevars.city') }}</option>
                                                @foreach ($cityData as $id => $city_name)
                                                    <option value="{{ $id }}">{{ $city_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-item">
                                            <label>{{ __('tablevars.select') }} {{ __('tablevars.month') }}
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="month" wire:change="changeInput">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.month') }}
                                                </option>
                                                @for ($month = 1; $month <= 12; $month++)
                                                    <option value="{{ $month }}">
                                                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('month')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-3 align-self-end">
                                            <a class="btn btn-primary" id="box" style="color: white"
                                                wire:click="pendingSeatData">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-8">
                    <div class="row mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="tak-instruct-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Number</th>
                                                        <th>No of Child</th>
                                                        <th>No of Adult</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($user_enquiries && $user_enquiries->count() > 0)
                                                        @foreach ($user_enquiries as $key => $enquiry)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    {{ $enquiry->name  ?? ''}}
                                                                </td>
                                                                <td>
                                                                    {{ $enquiry->email ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $enquiry->mobile ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $enquiry->num_children ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $enquiry->num_adults ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $enquiry->created_at ?? '' }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="6" align="center" class="text-danger"><span
                                                                    class="v-msg">No
                                                                    Records
                                                                    Found</span> </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            {{-- {{ $pendingSeat->links() }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
