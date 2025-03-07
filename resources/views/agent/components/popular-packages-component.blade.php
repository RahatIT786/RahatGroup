<section class="section new-course">
    <div class="container-fluid">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head">
                <h2>Popular Packages</h2>
            </div>
        </div>
        <div class="course-feature">
            <h2>Popular Packages</h2>
            <div class="row">
                @foreach ($popular_packages as $package)
                {{-- {{ dd($popular) }} --}}
                    <div class="col-lg-4 col-md-6 d-flex">
                            <div class="course-box d-flex aos">
                                <div class="product">
                                    <div class="product-img">
                                        <a href="javacript:void(0);">
                                            @php
                                                $imageName = !empty($package->pkgImages[0])
                                                    ? $package->pkgImages[0]->pkg_img
                                                    : '';

                                                $imagePath = !empty($imageName)
                                                    ? 'package_image/' . $imageName
                                                    : 'storage\NoImageFound.png';

                                                // Check if the file exists
                                                $imageExists = !empty($imageName) && Helper::fileExists($imagePath);

                                            @endphp
                                            <img class="img-fluid" alt
                                                src="{{ $imageExists ? asset('storage/'.$imagePath) : asset('storage\NoImageFound.png') }}" />
                                        </a>
                                        {{-- <div class="price"> --}}
                                            {{-- <h3>₹ 49,000 <span>₹ 59,000</span></h3> --}}
                                            {{-- <h3>₹ {{ number_format($package->g_share) }}</h3> --}}
                                        {{-- </div> --}}
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title instructor-text"><a
                                                href="{{ route('agent.packageDescription',$package->id) }}">{{ $package->name }}</a>
                                        </h3>
                                        {{-- <h3 class="title instructor-text"><a href="#">{{ Helper::limitText($$package->package->name) }}</a></h3> --}}
                                        <div class="course-info d-flex align-items-center">
                                            <div class="rating-img d-flex align-items-center">
                                                <img src="{{ asset('assets/gift-1.svg') }}" alt />
                                                {{-- <p>{{ $package->packageType->package_type }}</p> --}}
                                            </div>
                                            <div class="course-view d-flex align-items-center">
                                                {{-- <p>₹ {{ number_format($package->g_share) }} per person</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                @endforeach
            </div>
        </div>
        <!-- Load More Button -->
        @if ($popular_packages->hasMorePages())
            <div class="text-center mt-4">
                <a wire:click="loadMore" class="btn btn-primary pointer">Load More</a>
            </div>
        @endif
    </div>
</section>
