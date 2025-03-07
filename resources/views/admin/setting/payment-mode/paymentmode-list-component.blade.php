<div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('tablevars.payment_mode') }}</h1>
                <div class="section-header-button"></div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.paymentmode.index') }}" wire:navigate>{{ __('tablevars.payment_mode') }}</a></div>
                    <div class="breadcrumb-item">{{ __('tablevars.paymentmode_all') }}</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('tablevars.paymentmode_all') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('tablevars.#') }}</th>
                                    <th>{{ __('tablevars.payment_mode') }}</th>
                                    <th>{{ __('tablevars.action') }}</th> 
                                    <th>{{ __('tablevars.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Paymentmode as $key => $paymentmode)
                                    <tr>
                                        <td>{{ $key + $Paymentmode->firstItem() }}</td>
                                        <td>{{ $paymentmode->payment_mode ?? '' }}</td>

                                        <td>
                                                    <div style="cursor:pointer;" class="pointer badge badge-{{ $paymentmode->is_active == 1 ? 'primary' : 'danger' }}"
                                                        wire:click="toggleStatus({{ $paymentmode->id }})">
                                                        {{ $paymentmode->is_active == 1 ? 'Active' : 'Inactive' }}
                                                    </div>
                                                </td>
                                        
                                        <td>
                                            <div class="btn-group mb-2">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog" data-toggle="tooltip" title="Options"></i>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item" href="javascript:void(0)" wire:click.prevent="edit({{ $paymentmode->id }})" data-bs-toggle="modal" data-bs-target="#editModal" data-toggle="tooltip" title="">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" align="center" class="v-msg">{{ __('tablevars.no_record') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                            <select name="per_page" id="per_page" class="form-control" wire:model='perPage' wire:change='filterPaymentmode'>
                                @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{ $Paymentmode->links(data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- CRUD Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Page</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form wire:submit.prevent="{{ $is_edit ? 'update' : 'save' }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ __('tablevars.payment_mode') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="payment_mode" id="name" wire:model="payment_mode" placeholder="Please enter Payment Mode " maxlength="50" disabled>
                            @error('payment_mode')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
