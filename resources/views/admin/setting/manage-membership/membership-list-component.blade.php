<div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('tablevars.membership') }}</h1>
                <div class="section-header-button"></div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">{{ __('tablevars.setting') }} {{ __('tablevars.managment') }}</div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.membership.index') }}" wire:navigate>{{ __('tablevars.membership') }}</a></div>
                    <div class="breadcrumb-item">{{ __('tablevars.membership_all') }}</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __('tablevars.membership_all') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('tablevars.#') }}</th>
                                    <th>{{ __('tablevars.membership') }}</th>
                                    <th>{{ __('tablevars.adult_commision') }}</th>
                                    <th>{{ __('tablevars.chlid_commision') }}</th>
                                    <th>{{ __('tablevars.infant_commision') }}</th>
                                    <th>{{ __('tablevars.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Memberships as $key => $membership)
                                    <tr>
                                        <td>{{ $key + $Memberships->firstItem() }}</td>
                                        <td>{{ $membership->membership ?? '' }}</td>
                                        <td>{{ Aihut::get('currency') }} {{ number_format($membership->adult_commision,2)}}</td>
                                        <td>{{ Aihut::get('currency') }} {{ number_format($membership->chlid_commision,2)}}</td>
                                        <td>{{ Aihut::get('currency') }} {{ number_format($membership->infant_commision,2)}}</td>
                                        <td>
                                            <div class="btn-group mb-2">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog" data-toggle="tooltip" title="Options"></i>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item" href="javascript:void(0)" wire:click.prevent="edit({{ $membership->id }})" data-bs-toggle="modal" data-bs-target="#editModal" data-toggle="tooltip" title="">Edit</a>
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
                            <select name="per_page" id="per_page" class="form-control" wire:model='perPage' wire:change='filterMembership'>
                                @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{ $Memberships->links(data: ['scrollTo' => false]) }}
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
                    <h5 class="modal-title" id="editModalLabel">Set Membership Commision</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{ __('tablevars.membership') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="membership" id="name" wire:model="membership" placeholder="Please enter membership name" maxlength="20" disabled>
                            @error('membership')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('tablevars.adult_commision') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="adult_commision" id="adult_commision" wire:model="adult_commision" placeholder="Please enter adult_commision" maxlength="7">
                            @error('adult_commision')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('tablevars.chlid_commision') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="chlid_commision" id="chlid_commision" wire:model="chlid_commision" placeholder="Please enter chlid_commision" maxlength="7">
                            @error('chlid_commision')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('tablevars.infant_commision') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="infant_commision" id="infant_commision" wire:model="infant_commision" placeholder="Please enter infant_commision" maxlength="7">
                            @error('infant_commision')
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
