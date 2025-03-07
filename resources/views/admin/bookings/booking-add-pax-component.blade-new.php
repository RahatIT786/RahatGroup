<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.add_pax') }} - {{ __('tablevars.booking') }} ID {{ $booking->booking_id }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.booking') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.booking.index') }}"
                        wire:navigate>{{ __('tablevars.booking') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.add_pax') }}</div>
            </div>
        </div>

        <form>

            @foreach ($passengerDetails as $i => $passenger)
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Passenger Information Details - {{ $i }} </h4>
                                @if ($i == 1)
                                    <a href="{{ route('admin.booking.index') }}" class="btn btn-danger" wire:navigate><i
                                            class="fas fa-long-arrow-alt-left"></i>
                                        &nbsp;{{ __('tablevars.back') }}</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Surname<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="surname"
                                                wire:model='passengerDetails.{{ $i }}.surname'>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Given Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="given_name"
                                                wire:model='passengerDetails.{{ $i }}.given_name'>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Passport Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="passport_num"
                                                wire:model='passengerDetails.{{ $i }}.passport_num'>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Nationality<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nationality" value="Indian"
                                                wire:model='passengerDetails.{{ $i }}.nationality'>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Date of Birth<span class="text-danger">*</span></label>
                                            <input 
                                                type="date" 
                                                class="form-control" 
                                                name="dateOfBirth" 
                                                id="dateOfBirth{{ $i }}" 
                                                wire:model.defer='passengerDetails.{{ $i }}.dateOfBirth'
                                                @keydown="validateAge($event.target.value, '{{ $i }}')"
                                            >
                                            <div>
                                                <p id="validation_message{{ $i }}">{{ $validationMessages[$i] ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Passport Date of Expiry<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="passport_exp" passport_exp
                                                wire:model='passengerDetails.{{ $i }}.passport_exp'>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="d-block">Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="male{{ $i }}" name="gender_{{ $i }}"
                                                    value="Male"
                                                    wire:model="passengerDetails.{{ $i }}.gender"
                                                    {{ $passengerDetails[$i]['gender'] === 'Male' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="male{{ $i }}">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="female{{ $i }}" name="gender_{{ $i }}"
                                                    value="Female"
                                                    wire:model="passengerDetails.{{ $i }}.gender"
                                                    {{ $passengerDetails[$i]['gender'] === 'Female' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="female{{ $i }}">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="others{{ $i }}" name="gender_{{ $i }}"
                                                    value="Others"
                                                    wire:model="passengerDetails.{{ $i }}.gender"
                                                    {{ $passengerDetails[$i]['gender'] === 'Others' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="others{{ $i }}">Others</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Other input fields -->
                                </div>
                            </div>
                            <!-- Other elements -->
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </section>
</div>

@push('scripts')
<script>
    function validateAge(dateOfBirth, index) {
        var today = new Date();
        var dob = new Date(dateOfBirth);
        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));

        if (isNaN(age)) {
            document.getElementById("validation_message" + index).innerText = 'Please choose a valid date of birth';
        } else {
            document.getElementById("validation_message" + index).innerText = '';
        }
    }
</script>
@endpush
