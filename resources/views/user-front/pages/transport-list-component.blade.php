<div>
    <section class="car_sec">
        <div class="container">
            <nav class="breadcrumbs mb-2">
                <span>
                    <span class="breadcrumb-text">
                        <a href="{{ route('customer.homepage') }}">Home</a>
                    </span>
                    <span class="breadcrumb-separator"></span>
                    <span class="breadcrumb-text">Vehicle</span>
                </span>
            </nav>
            <div class="row">
                <div class="col-md-12">
                    <div class="package-search-box">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name='car_type_id' id="car_type_id"
                                            wire:model='car_type_id' wire:change="filterCar">
                                            <option value="">Select Vehicle  Type</option>
                                            @foreach ($cartypemaster as $CarTypeName)
                                                <option value="{{ $CarTypeName->id }}">{{ $CarTypeName->car_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('car_type_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name='car_sector_id' id="car_sector_id"
                                            wire:model='car_sector_id' wire:change="filterCar">
                                            <!-- <option value="">Select  Sector</option> -->
                                            @foreach ($carsectormaster as $SectorName)
                                                <option value="{{ $SectorName->id }}">{{ $SectorName->sector_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('car_sector_id')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($cars->count() > 0)
                <h4 class="my-3 pb-3 border-bottom">{{ $cars->count() }} Vehicle(s) Found</h4>
            @endif
            <div class="car_section">
                <div class="row">
                    @forelse ($cars as $car)
                        <div class="col-md-4">
                            <div class="car_box">
                                @if ($car->carimages)
                                    <div class="car_img">
                                        <span class="img_thumb">
                                            <a class="img-thumb" href="{{ route('customer.transportDetail', ['id' => $car->id]) }}">
                                                @foreach ($car->carimages as $imageId)
                                                    <img src="{{ asset('storage/car_image/' . $imageId->image) }}"
                                                        alt="car image">
                                                @endforeach
                                            </a>
                                        </span>
                                    </div>
                                    <div class="car_content">
                                        <div class="padd">
                                            <h4 class="h4"><a
                                                    href="{{ route('customer.transportDetail', ['id' => $car->id]) }}">{{ $car->cartypemaster->car_type ?? '' }}
                                                    ({{ $car->no_of_seats ?? '' }} Seater)
                                                </a></h4>
                                            <h6><a href="{{ route('customer.transportDetail', ['id' => $car->id]) }}">{{ $car->carsectormaster->sector_name ?? '' }}</a>
                                            </h6>
                                            <span class="d-block price my-2"><strong>&#xFDFC;
                                                    {{ number_format($car->price, 2) }}</strong></span>
                                        </div>
                                    </div>
                                    <div class="car_content">
                                        <div
                                            class="d-flex align-items-center justify-content-center text-center mx-auto padd">
                                            {{-- <a href="#" class="default-btn btn mr-2">Book Now</a> --}}
                                            <a href="{{ route('customer.transportDetail', ['id' => $car->id]) }}"
                                                class="btn-detail">Vehicle Detail</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 text-center text-danger">
                            {{ __('tablevars.no_record') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
