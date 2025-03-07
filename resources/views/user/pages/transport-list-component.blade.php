<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Transport</h1>
        </div>
    </section>
    <section class="cVoRcU">
        <div class="container">
            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
            </div>
            <div class="instruct-search-blk mb-0">
                <div class="show-filter all-select-blk">
                    <div class="row gx-2">
                        <div class="col-md-3 col-lg-3 col-item">
                            <select class="form-control" name='car_type_id' id="car_type_id" wire:model='car_type_id'
                                wire:change="filterCar">
                                <option value="">Select Car Type</option>
                                @foreach ($cartypemaster as $CarTypeName)
                                    <option value="{{ $CarTypeName->id }}">{{ $CarTypeName->car_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('car_type_id')
                                <span class="v-msg-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-lg-3 col-item">
                            <select class="form-control" name='car_sector_id' id="car_sector_id"
                                wire:model='car_sector_id' wire:change="filterCar">
                                <option value="">Select Car Sector</option>
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
            </div>
        </div>

        <div class="container">
            <div class="row">
                @forelse ($cars as $car)
                    <div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
                        <a href="{{ route('transportDetail', ['id' => $car->id]) }}">
                            @if ($car->carimages)
                                <article class="gzRGXF"
                                    style="background-image: url('{{ count($car->carimages) != 0 ? asset('storage/car_image/' . $car->carimages[0]->image) : asset('storage/car_image/NoImageFound.png') }}'); background-position:center;">
                                    <div>
                                        <span font-weight="800" font-style="normal" font-size="2rem" class="eklPbQ">
                                            <span>{{ $car->cartypemaster->car_type ?? '' }}
                                                ({{ $car->no_of_seats ?? '' }} Seater)
                                            </span>
                                        </span>
                                        <div>
                                            <ul>
                                                <p><a href="{{ route('transportDetail', ['id' => $car->id]) }}">{{ $car->carsectormaster->sector_name ?? '' }}</a>
                                                </p>
                                                <span class="d-block price my-2"><strong>&#xFDFC;
                                                        {{ number_format($car->price, 2) }}</strong></span>
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
