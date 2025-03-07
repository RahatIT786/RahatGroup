<div>
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
                            <span class="breadcrumb-text">{{ $pageName }}</span>
                        </span>
                    </nav>
                </div>
            </div>
            @forelse ($hajkits as $key => $hajkit)
                <div class="shop-pro-row">
                    <div class="white-bg-box">
                        <div class="row mx-0">
                            <div class="col-md-2 px-0">
                                <h5 class="h5 pro-title mb-2 mt-2 ml-2"><strong>{{ $hajkit->name }}</strong></h5>
                                <div class="shop_img">
                                    <span class="img-thumb">
                                        <img alt="cheap umrah packages"
                                            src="{{ asset('/storage/KitCategory_Image/' . $hajkit->kit_category_img) }}">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    {{-- <h5 class="h5 pro-title mb-0"><strong>{{ $hajkit->name }}</strong></h5> --}}
                                    <div class="pro-short-desc mb-2 mt-2">

                                        <span id="text-short-{{ $key }}"
                                            style="max-height:180px; overflow-y:auto;display: block;">
                                            {!! \App\Helpers\Helper::limitTextReadMore($hajkit->description, 120) !!}
                                        </span>
                                        <span id="text-full-{{ $key }}"
                                            style="max-height:180px; overflow-y:auto; display: none;">
                                            {!! $hajkit->description !!}
                                        </span>
                                        {{-- <a href="javascript:void(0)" id="read-more-{{ $key }}"
                                            data-target="#descriptionModal('{{ $key }}')">Read More</a>
                                        <a href="javascript:void(0)" id="read-less-{{ $key }}"
                                            style="display: none;" data-target="#descriptionModal('{{ $key }}')">Read
                                            Less</a> --}}
                                            <a class="dropdown-item" href="javascript:void(0)"
                                            data-toggle="modal"
                                            wire:click="getModaldescription({{ $hajkit->id }})"
                                            data-target="#descriptionModal">
                                            Read More
                                         </a>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <h5 class="h5 pro-title mb-0"><strong>Include Items</strong></h5>
                                    <p class="pro-short-desc mb-2 mt-2">
                                        @if ($hajkit->kit_item_id)
                                            {{-- {{ $kit_names }} --}}
                                        @else
                                            No Kit Items
                                        @endif
                                        <a href="javascript:void(0);" data-toggle="modal" title="More" class="more"
                                            font-size="smallest" data-toggle="modal" data-target="#moreModal"
                                            wire:click='getModal({{ $hajkit->id }})' class="gnRJtI">More</a>
                                        {{-- <a href="avascript:void(0);" data-toggle="modal" data-target="#moreModal"
                                        title="More" class="more" font-size="smallest" class="gnRJtI">More</a> --}}

                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <p class="pro-price"><small class="font12"><strong>Price</strong></small><span
                                            class="d-block font-weight-bold">₹{{ number_format($kit_price[$key]['price'], 2) }}</span>
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
                                                    class="item_number minus" id="minus-{{ $hajkit->id }}"
                                                    width="20px" height="20px"
                                                    wire:click="qtySubstract('{{ $key }}')">
                                                <input name="item_{{ $hajkit->id }}" id="item_{{ $hajkit->id }}"
                                                    type="text"
                                                    onblur="get_shop_price({{ $hajkit->price }}, 0, '{{ $hajkit->id }}')"
                                                    value="0" class="qty"
                                                    wire:model ="kit_price.{{ $key }}.{{ 'qty' }}">
                                                <img src="{{ asset('assets/user-front/images/add_icon.png') }}"
                                                    class="item_number add" id="add-{{ $hajkit->id }}" width="20px"
                                                    height="20px" wire:click="qtyAdd('{{ $key }}')">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 px-0">
                                <div class="pad15">
                                    <p class="pro-price text-right"><small class="font12"><strong>Total
                                                Price</strong></small><span
                                            class="d-block font-weight-bold text-success">₹
                                            <span>{{ number_format($kit_price[$key]['tot_price'], 2) }}</span></span>
                                    </p>
                                </div>
                                <div class="text-right" id="book_btn">
                                    {{-- <button type="submit" class="btn default-btn p-2 mb-2"
                                name="btn_kit_submit">Book
                                Now</button> --}}
                                    <a class="btn secondary-btn" style="background-position: 300% 100% !important;"
                                        href="{{ route('customer.hajjumrahKitEnquiry', ['slug' => $hajkit->slug]) }}">Enquiry
                                        Now</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- @livewire('user-front.more-modal-component', ['id' => $hajkit->id]) --}}
            @empty

                <p style="text-align: center; color: red;">No Data Found!</p>
            @endforelse
        </div>
        <!--More Modal -->
        <div class="modal fade" id="moreModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
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
                                @forelse($itemData as $item)
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
                                                <h5 class="h5 pro-title mb-0"><strong>Price</strong></h5><span
                                                    class="d-block">₹
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

        <div class="modal fade" id="descriptionModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient">
                        {{-- <h5 class="modal-title text-white" id="exampleModalLongTitle">Description</h5> --}}
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($modalData)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div>{!! $modalData->description !!}</div>
                                </div>
                            </div>
                        @else
                            {{-- <p>No Data Available</p> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('extra_js')
    <script>
        function updateQuantity(id, change) {
            const qtyInput = document.getElementById('item_' + id);
            let currentValue = parseInt(qtyInput.value) || 0;
            currentValue += change;
            qtyInput.value = currentValue;

        }

        function toggleText(id) {
            let shortText = document.getElementById('text-short-' + id);
            let fullText = document.getElementById('text-full-' + id);
            let readMoreLink = document.getElementById('read-more-' + id);
            let readLessLink = document.getElementById('read-less-' + id);

            if (shortText.style.display === 'block') {
                // Show full text
                shortText.style.display = 'none';
                fullText.style.display = 'block';
                readMoreLink.style.display = 'none';
                readLessLink.style.display = 'block';
            } else {
                // Show truncated text
                shortText.style.display = 'block';
                fullText.style.display = 'none';
                readMoreLink.style.display = 'block';
                readLessLink.style.display = 'none';
            }
        }
    </script>
@endpush
