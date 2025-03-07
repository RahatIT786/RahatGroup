<div class="modal fade" id="moreModal" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Include Items</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="shop-pro-row" id="21">
                    <div class="white-bg-box">
                        @forelse($items as $item)
                            <div class="row mx-0">
                                <div class="col-md-4 px-0 border-right border-bottom">
                                    <div class="pad15">
                                        <span class="img-thumb">
                                            <img alt="cheap umrah packages"
                                                src="{{ asset('/storage/kit_image/' . $item->kit_img) }}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 px-0 border-right border-bottom">
                                    <div class="pad15">
                                        <h5 class="h5 pro-title mb-0">{{ $item->kit_name }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4 px-0 border-right border-bottom">
                                    <div class="pad15">
                                        <h5 class="h5 pro-title mb-0">Price</h5><span class="d-block">Rs.
                                            {{ number_format($item->price, 2) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Data Found!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
