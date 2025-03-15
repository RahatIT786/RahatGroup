<section class="shopping-page-container bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumbs mb-4">
                    <span>
                        <span class="breadcrumb-text">
                            <a href="{{ route('customer.homepage') }}">Home</a>
                        </span>
                        <span class="breadcrumb-separator"></span>
                        <span class="breadcrumb-text">HajjKit</span>
                    </span>
                </nav>
            </div>
        </div>
        <form method="">
            @foreach ($kits as $kit)
                <div class="shop-pro-row" id="10">
                    <div class="white-bg-box">
                        <div class="row mx-0">
                            <div class="col-md-2 px-0">
                                <div class="shop_img">
                                    <span class="img-thumb">
                                        <img alt="cheap umrah packages"
                                            src="{{ asset('/storage/KitCategory_Image/' . $kit->kit_category_img) }}">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <h5 class="h5 pro-title mb-0"><strong>{{ $kit->name }}</strong></h5>
                                    <div id="text-{{ $kit->id }}">
                                        {!! \App\Helpers\Helper::limitTextReadMore($kit->description) !!}
                                    </div>
                                    <div style="margin-top: 10px; color: green;">
                                        <a href="javascript:void(0)" id="read-more-{{ $kit->id }}"
                                            onclick="toggleText('{{ $kit->id }}')">Read More</a>
                                        <a href="javascript:void(0)" id="read-less-{{ $kit->id }}"
                                            style="display:none;" onclick="toggleText('{{ $kit->id }}')">Read
                                            Less</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <h5 class="h5 pro-title mb-0"><strong>Include Items</strong></h5>
                                    <p class="pro-short-desc mb-2 mt-2">
                                        @if ($kit->kit_item_id)
                                            {{ $kit_names[$kit->id] }}
                                        @else
                                            No Kit Items
                                        @endif
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#moreModal"
                                            title="More" class="more" font-size="smallest" class="gnRJtI">More</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <p class="pro-price"><small class="font12"><strong>Price</strong></small><span
                                            class="d-block font-weight-bold">Rs.
                                            {{ number_format($kit->price, 2) }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <div class="qty_wrapper">
                                        <label for="qty"><strong>Qty:</strong></label>
                                        <div class="qty_controles">
                                            <p class="mb-0">
                                                <img src="{{ asset('assets/user-front/images/minus_icon.png') }}"
                                                    class="item_number minus" id="minus-{{ $kit->id }}"
                                                    width="20px" height="20px" wire:click="qtySubstract">
                                                <input name="item_{{ $kit->id }}" id="item_{{ $kit->id }}"
                                                    type="text"
                                                    onblur="get_shop_price({{ $kit->price }}, 0, '{{ $kit->id }}')"
                                                    value="0" class="qty" wire:model ="kit_qty">
                                                <img src="{{ asset('assets/user-front/images/add_icon.png') }}"
                                                    class="item_number add" id="add-{{ $kit->id }}" width="20px"
                                                    height="20px" wire:click="qtyAdd">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 px-0">
                                <div class="pad15">
                                    <p class="pro-price text-right"><small class="font12"><strong>Total Price</strong></small><span
                                            class="d-block font-weight-bold text-success">₹  <span
                                                id="inrShopPrice_10">{{ number_format($kit->price * $kit_qty, 2) }}</span></span>
                                    </p>
                                </div>
                                <div class="text-right" id="book_btn">
                                    <a class="btn secondary-btn"
                                        style="background-position: 300% 100% !important; margin-left: 10px;"
                                        href="{{ route('customer.hajjumrahKitEnquiry', ['slug' => $kit->slug]) }}">Enquiry
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
    @livewire('user-front.more-modal-component', ['id' => $kit->id])
</section>
@push('extra_js')
    <script>
        function updateQuantity(id, change) {
            const qtyInput = document.getElementById('item_' + id);
            let currentValue = parseInt(qtyInput.value) || 0;
            currentValue += change;
            qtyInput.value = currentValue;
            get_shop_price({{ $kit->price }}, 0, id);
        }

        function toggleText(id) {
            let textDiv = document.getElementById('text-' + id);
            let readMore = document.getElementById('read-more-' + id);
            let readLess = document.getElementById('read-less-' + id);

            if (readMore.style.display !== 'none') {
                // Load the full text
                textDiv.innerHTML = `{!! \App\Helpers\Helper::limitTextReadMore($kit->description, 120, '...', false) !!}`;
                readMore.style.display = 'none';
                readLess.style.display = 'inline';
            } else {
                // Load the truncated text
                textDiv.innerHTML = `{!! \App\Helpers\Helper::limitTextReadMore($kit->description, 120) !!}`;
                readMore.style.display = 'inline';
                readLess.style.display = 'none';
            }
        }
    </script>
@endpush
