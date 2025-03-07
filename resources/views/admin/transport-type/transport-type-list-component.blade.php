<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.transport_type') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.package') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.foodType.index') }}"
                        wire:navigate>{{ __('tablevars.transport_type') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.transport_type') }}
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('tablevars.search') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_booking">{{ __('tablevars.booking_id') }}</label>
                                    <input type="text" name="search_booking" id="search_booking" class="form-control"
                                        placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header"
                                        for="search_agency">{{ __('tablevars.transport_type') }}</label>
                                    <input type="text" name="search_agency" id="search_agency" class="form-control"
                                        placeholder="Search Transport Type" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.transport_type') }} {{ __('tablevars.list') }}</h4>
                            {{-- <a href="{{ route('admin.booking.create') }}" class="btn btn-primary"
                                wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a> --}}
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                class="btn btn-icon btn-sm m-1 btn-primary" data-bs-target="#addModal"
                                data-toggle="tooltip" title="Add new Transport Type">{{ __('tablevars.add') }}
                                {{ __('tablevars.new') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.transport_type') }}</th>
                                            <th>{{ __('tablevars.price') }}</th>
                                            <th>{{ __('tablevars.status') }} & {{ __('tablevars.action') }}</th>
                                            {{-- <th>{{ __('tablevars.payment_id') }}</th>
                                            <th>{{ __('tablevars.particulars') }}</th>
                                            <th>{{ __('tablevars.debit') }}</th>
                                            <th>{{ __('tablevars.credit') }}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($users as $key => $user) --}}
                                        <tr>
                                            <td>1</td>

                                            <td>Jeddah Airport to Makkah Hotel </td>
                                            <td>1000.00</td>
                                            <td>
                                                <div class="pointer badge badge-primary">Active</div>

                                                <div class="table-links d-flex">
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                    <form id="#" action="#" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                        {{-- @empty
                                            <tr>
                                                <td colspan="5" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                        {{-- wire:model='perPage' wire:change='filterUsers'> --}}
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- {{ $users->links(data: ['scrollTo' => false]) }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">{{ __('tablevars.transport_type') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                {{-- <form wire:submit="save">  --}}
                <form>
                    <div class="modal-body">
                        <!-- Add your form fields here -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('tablevars.name') }}</label>
                            {{-- <input type="text" class="form-control" name="name" id="name" wire:model="name"> --}}
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Please enter transport type">
                            @error('name')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('tablevars.price') }}</label>
                            {{-- <input type="text" class="form-control" name="name" id="name" wire:model="name"> --}}
                            <input type="text" class="form-control" name="price" id="price"
                                placeholder="Please enter price">
                            @error('price')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('tablevars.submit') }}</button>
                        <button type="button" class="btn btn-dark"
                            data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
