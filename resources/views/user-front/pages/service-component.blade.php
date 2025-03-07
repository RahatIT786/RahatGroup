<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumbs mb-4">
                    <span>
                        <span class="breadcrumb-text">
                            <a href="{{ route('customer.homepage') }}">Home</a>
                        </span>
                        <span class="breadcrumb-separator"></span>
                        <span class="breadcrumb-text">Services</span>
                    </span>
                </nav>
            </div>
        </div>
        @if ($service)
            <h4 class="px-4 py-3 shadow-sm bg-gradient rounded text-white font-weight-bold">{{ $service->name }}</h4>
            <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
                <div class="row">
                    <div class="col-lg-2 col-md-2 mb-3 text-center">
                        <img src="{{ asset('/storage/service_image/' . $service->service_img) }}" alt="laundries"
                            class="service-img">
                        <h6 class="mb-0 mt-2 text-default">{{ $service->name }}</h6>
                        {{-- <strong class="text-default">₹ {{ number_format($service->price, 2) }}</strong> --}}
                    </div>
                    <div class="col-lg-10 col-md-10 mb-3">
                        <p>{!! $service->description !!}</p>
                        <div align="right">


                            @if ($slug == 'book-a-laundry')
                                <a class="btn secondary-btn"
                                    href="{{ route('customer.serviceEnquiry', ['slug' => $service->slug]) }}">Enquiry
                                    Now</a>
                            @else
                                <a class="btn secondary-btn"
                                    href="{{ route('customer.forexEnquiry', ['slug' => $service->slug]) }}">Enquiry
                                    Now</a>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
