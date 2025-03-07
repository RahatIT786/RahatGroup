<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <h3>{{ __('tablevars.request') }} {{ __('tablevars.id') }} -
                                                {{ $quote->request_id }}</h3>
                                        </div>

                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('tablevars.booking') }} {{ __('tablevars.status') }}
                                                        </th>
                                                        <th>{{ __('tablevars.service') }} {{ __('tablevars.type') }}
                                                        </th>
                                                        <th>{{ __('tablevars.dept_date') }}</th>
                                                        <th>{{ __('tablevars.quoted') }} {{ __('tablevars.fare') }}
                                                        </th>

                                                        <th>{{ __('tablevars.pax') }}</th>
                                                        <th>{{ __('tablevars.quote') }} {{ __('tablevars.validity') }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Quoted</td>
                                                        <td>{{ $quote->servicetype != null ? $quote->servicetype->name : '-' }}
                                                        </td>
                                                        <td>{{ $quote->travel_date ? Helper::appDateFormat($quote->travel_date) : 'N/A' }}
                                                        </td>
                                                        <td>{{ number_format($quote->tot_cost, 2) }}</td>
                                                        <td>{{ $quote->adult + $quote->child_bed + $quote->child + $quote->infant }}
                                                        </td>
                                                        <td class="{{ $text_class }}">
                                                            {{ $validity }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if ($validity == 'Invalid')
                                        <div class="comman-space pb-0">
                                            <span class="text-danger">Requested seats has been decreased , please create
                                                another request or contact Relationship Manager.</span>
                                        </div>
                                    @endif
                                    <div class="comman-space pb-0">
                                        <div class="mb-2">
                                            <a href="{{ route('customer.quotes.payment-confirmation', ['quote_id' => $quote->id]) }}"
                                                class="btn btn-primary {{ $validity == 'Invalid' ? 'disabled' : '' }}"
                                                title="Proceed">{{ __('tablevars.proceed') }}</a>
                                            {{-- <a href="javascript:void(0);"
                                                class="btn btn-primary {{ $validity == 'Invalid' ? 'disabled' : '' }}"
                                                title="Proceed">{{ __('tablevars.reject') }}</a> --}}
                                            {{-- <a href="javascript:void(0);"data-bs-toggle="modal" data-toggle="tooltip"
                                                data-bs-target="#negotiate_modal" title="Negotiate"
                                                class="btn btn-primary {{ $validity == 'Invalid' ? 'disabled' : '' }}"
                                                title="Proceed">{{ __('tablevars.Negotiate') }}</a> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="negotiate_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Negotiate</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group">
                                        <label>Quoted Fare <span class="text-danger">*</span></label>
                                        <span>{{ number_format($quote->tot_cost, 2) }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter New Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="negotiate" class="form-control"
                                            wire:model="negotiate" maxlength="9"
                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" title="Update" data-bs-dismiss="modal"
                        wire:click='negotiatedAmount'>Update</button>
                    <button type="button" class="btn btn-dark" title="Close"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
