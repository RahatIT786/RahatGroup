<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4>{{ __('tablevars.package_pnr_details') }}<span class="text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- Title --}}
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.title') }}<span class="text-danger">*</span>
                                                        (For Identification Purpose Only)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Flyer Title" wire:model='flyer_title'
                                                        maxlength='255'>
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Header Image --}}
                                            <div class="col-6 mb-4">
                                                <div class="form-group">
                                                    <label>{{ __('Header Image') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" class="form-control"
                                                        wire:model='header_image'>
                                                    @if ($header_image)
                                                        <img src="{{ $header_image->temporaryUrl() }}" class="mt-2"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @endif
                                                    @error('header_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <small style="color: red">Upload 1100 x 434 image for alignment</small>
                                            </div>
                                            {{-- Header Text --}}
                                            {{-- <div class="col-6 mb-4">
                                                <div class="form-group">
                                                    <label>{{ __('Header Text') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Header Text" wire:model='header_text'
                                                        maxlength='40'>
                                                    @error('header_text')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            {{-- Footer Image --}}
                                            <div class="col-6 mb-4">
                                                <div class="form-group">
                                                    <label>{{ __('Footer Image') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" class="form-control"
                                                        wire:model='footer_image'>
                                                    @if ($footer_image)
                                                        <img src="{{ $footer_image->temporaryUrl() }}" class="mt-2"
                                                            style="height: 100px; border-radius: 10px; width: 160px;">
                                                    @endif
                                                    @error('footer_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <small style="color: red">Upload 1100 x 90 image for alignment</small>
                                            </div>
                                            {{-- Footer Text --}}
                                            {{-- <div class="col-6 mb-4">
                                                <div class="form-group">
                                                    <label>{{ __('Footer Text') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Footer Text" wire:model='footer_text'
                                                        maxlength='40'>
                                                    @error('footer_text')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            {{-- Packages --}}
                                            <div class="col-lg-12 mb-4" wire:ignore>
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.packages') }}<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" wire:change="changeInput"
                                                        wire:model="package_ids" id="package_ids" name="package_ids">
                                                        <option value="">{{ __('tablevars.select') }}
                                                            {{ __('tablevars.service_type') }}</option>
                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                {{ $package->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('package_ids')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Important Notes --}}
                                            <div class="col-12 mb-4" wire:ignore>
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.imp_notes') }}</label>
                                                    <textarea name="important_notes" id="important_notes" class="form-control" placeholder="Enter Important Notes"
                                                        wire:model='important_notes'>
                                                        <ul style="padding-left: 18px;list-style: decimal;font-weight:700;color:#000000;margin:0px;font-size: 14px;">
                                                            <li>Please activate ROAMING on your Sim before leaving India.</li>
                                                            <li>Download IMO, SKYPE, BOTIM for your VIDEO & AUDIO CALLS.</li>
                                                            <li>Please take Printout (HARD COPY) of your Ticket, Visa, Insurance.</li>
                                                            <li>Please wear EHRAM before crossing Meeqat.</li>
                                                            <li>Please Buy Saudi RIYAL from INDIA before reaching AIRPORT.</li>
                                                            <li>PLEASE keep 50-100 sar change with you handy in pockets.</li>
                                                            <li>Make sure to Keep your medicine handy with you in hand bags.</li>
                                                            <li>Do Not Carry INDIAN or ANY POLITICAL FLAGS with you.</li>
                                                            <li>Watch UMRAH Tutorials on YOUTUBE Before leaving.</li>
                                                            <li>For Mobile Recharges carry Extension board and Universal Adapter.</li>
                                                            <li>Carry your own Wheelchairs.</li>
                                                            <li>Water is available only on Buffet Not in Rooms.</li>
                                                        </ul>
                                                    </textarea>
                                                    @error('important_notes')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- Terms & Conditions --}}
                                            <div class="col-12 mb-4" wire:ignore>
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.terms_cond') }}</label>
                                                    <textarea name="terms_cond" id="terms_cond" class="form-control" placeholder="Enter Terms & Conditions"
                                                        wire:model='terms_cond'>
                                                        <ul style="padding-left: 18px;list-style: decimal;font-weight:700;color:#372d72;margin:0px;font-size: 14px;">
                                                            <li>Visa and Tickets Fees are Non Refundable.</li>
                                                            <li>No Refunds if Tour Cancelled within 21 Days of Travel.</li>
                                                            <li>50% Advance to Confirm Bookings.</li>
                                                            <li>Balance 50% to be paid 21 Days before Travel.</li>
                                                            <li>Airfare is considered of Economy class.</li>
                                                            <li>No Cash Deposits in our Bank Accounts.</li>
                                                            <li>Food in Executive, Esteem will be in Parcel.</li>
                                                            <li>Hotel may Change to Similar or Same Category Hotels.</li>
                                                            <li>Bucket and Tubs will not be available in hotels.</li>
                                                            <li>No Fans are not available in Rooms Only AC.</li>
                                                            <li>Indian Toilets are not available only English Toilets.</li>
                                                        </ul>
                                                    </textarea>
                                                    @error('terms_cond')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Confirm Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra_js')
    <script>
        $('#important_notes').summernote({
            placeholder: 'Enter Important Notes',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('important_notes', contents);
                }
            }
        });
        $('#terms_cond').summernote({
            placeholder: 'Enter Terms & Conditions',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['view', ['codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('terms_cond', contents);
                }
            }
        });

        $("#package_ids").select2({
            placeholder: "{{ __('Select Packages for Flyer') }}",
            allowClear: true,
            multiple: true,
        }).change(function() {
            // console.log($(this).val());
            @this.set('package_ids', $(this).val());
        });
    </script>
@endpush
