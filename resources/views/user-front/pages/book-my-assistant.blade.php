<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumbs mb-4">
                    <span>
                        <span class="breadcrumb-text">
                            <a href="{{ route('customer.bookMyAssistant') }}">Home</a>
                        </span>
                        <span class="breadcrumb-separator"></span>
                        <span class="breadcrumb-text">Services</span>
                    </span>
                </nav>
            </div>
        </div>
        <h4 class="px-4 py-3 shadow-sm bg-gradient rounded text-white font-weight-bold">Book My Assistant</h4>
        <div class="bg-white shadow-sm rounded p-3 mt-3 mb-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 mb-3 text-center">
                    <a href="{{ asset('/assets/user-front/images/bookmyassistant.jpeg') }}" target="_blank">
                        <img src="{{ asset('/assets/user-front/images/bookmyassistant.jpeg') }}"
                            style="cursor: pointer;">
                    </a>
                </div>

                <div class="col-lg-7 col-md-7 mb-3">
                    @if ($content)
                        <p>{!! $content->description !!}</p>
                    @endif
                    <div align="right">
                        <a class="btn secondary-btn" href="{{ route('customer.bookMyAssistantEnquiry') }}">Enquiry
                            Now</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 mb-3 text-center">
                    <strong class="text-default">{{ $parameter_value }}</strong>
                </div>
            </div>
        </div>
    </div>
</section>
