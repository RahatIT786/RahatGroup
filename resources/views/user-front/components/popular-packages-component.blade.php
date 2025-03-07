<section class="section package-section">
    <div class="container">
        <div class="section-title text-center pb-0">
            <h2 class="title">Popular Packages</h2>
        </div>
        <div class="package-slider">
            @foreach ($popular_packages as $package)
                <div class="item">
                    <div class="package-box">
                        <div class="package-img image">
                            <a class="img-thumb" href="javascript:void(0);">
                                @php
                                    $imageName = !empty($package->pkgImages[0]) ? $package->pkgImages[0]->pkg_img : '';
                                    $imagePath = !empty($imageName)
                                        ? 'package_image/' . $imageName
                                        : 'storage/NoImageFound.png';

                                    $imageExists = !empty($imageName) && Helper::fileExists($imagePath);
                                @endphp
                                <img class="img-fluid" alt="Package Image"
                                    src="{{ $imageExists ? asset('storage/' . $imagePath) : asset('storage/NoImageFound.png') }}" />
                            </a>
                        </div>
                        <div class="package-text">
                            <h4 class="package-name">
                                <a href="javascript:void(0);" wire:click="viewPackageDetails({{ $package->id }})">
                                    {{ $package->name }}
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($popular_packages->hasMorePages())
            <div class="text-center mt-4">
                <a wire:click="loadMore" class="btn btn-primary pointer">Load More</a>
            </div>
        @endif
    </div>
</section>
