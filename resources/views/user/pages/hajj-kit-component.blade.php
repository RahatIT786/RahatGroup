<div>
    <main class="cAJbgc" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
            <div class="container">
                <h1>{{ $pageName }}</h1>
            </div>
        </section>
        <section class="shopping-page-container bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumbs mb-4">
                            <span>
                            </span>
                        </nav>
                        <div class="row mb-4">
                        </div>
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
                                                onclick="toggleText('{{ $key }}')">Read More</a>
                                            <a href="javascript:void(0)" id="read-less-{{ $key }}"
                                                style="display: none;" onclick="toggleText('{{ $key }}')">Read
                                                Less</a> --}}

                                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
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
                                            <a href="javascript:void(0);" data-toggle="modal" title="More"
                                                class="more" font-size="smallest" data-toggle="modal"
                                                data-target="#moreModal" wire:click='getModal({{ $hajkit->id }})'
                                                class="gnRJtI">More</a>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-2 px-0 border-right">
                                    <div class="pad15">
                                        <p class="pro-price"><small class="font12"><strong>Price</strong></small><span
                                                class="d-block font-weight-bold">{{ number_format($kit_price[$key]['price'], 2) }}</span>
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
                                                    <input name="item_{{ $hajkit->id }}"
                                                        id="item_{{ $hajkit->id }}" type="text"
                                                        onblur="get_shop_price({{ $hajkit->price }}, 0, '{{ $hajkit->id }}')"
                                                        value="0" class="qty"
                                                        wire:model ="kit_price.{{ $key }}.{{ 'qty' }}">
                                                    <img src="{{ asset('assets/user-front/images/add_icon.png') }}"
                                                        class="item_number add" id="add-{{ $hajkit->id }}"
                                                        width="20px" height="20px"
                                                        wire:click="qtyAdd('{{ $key }}')">
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
                                        <a class="btn secondary-btn p-2"
                                            href="{{ route('hajjKitEnquiry', ['slug' => $hajkit->slug]) }}">Enquiry
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
        </section>
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

    </main>
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

@push('extra_css')
    <style>
        img {
            max-width: 100%;
        }

        .cAJbgc,
        .fAWLEZ {
            position: unset;
        }

        .custom-select {
            height: calc(3rem + 2px);
            font-size: 16px;
            border-radius: 10px;
            border: 1px solid #EBEBEB;
            padding: .375rem 1.2rem;
            padding-right: 1.8rem;
            background: #fff url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1024 1024' %3e%3cpath fill='gray' d='M0 307.2c0-6.552 2.499-13.102 7.499-18.101 9.997-9.998 26.206-9.998 36.203 0l442.698 442.698 442.699-442.698c9.997-9.998 26.206-9.998 36.203 0s9.998 26.206 0 36.203l-460.8 460.8c-9.997 9.998-26.206 9.998-36.203 0l-460.8-460.8c-5-5-7.499-11.55-7.499-18.102z'/%3e%3c/svg%3e);
            background-size: 0.8em auto, 100%;
            background-repeat: no-repeat;
            background-position: right .8em top 50%, 0 0;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .secondary-btn {
            padding: 10px 20px;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: 0;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            background-color: #000000 !important;
            background-size: 300% 100% !important;
        }

        .default-btn {
            padding: 10px 20px;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: 0;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            background-color: #b49164 !important;
            background-size: 300% 100% !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .d-block {
            display: block !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .shopping-page-container {
            width: 100%;
            position: relative;
            padding: 50px 0px;
            background: #f1f1f1;
        }

        .shopping-page-container .shop-pro-row {
            width: 100%;
            margin-bottom: 10px;
        }

        .shopping-page-container .white-bg-box {
            position: relative;
            border: 1px solid #e4e4e4;
            border-radius: 10px;
            background: #ffffff;
            transition: all ease-out 0.4s;
        }

        .shopping-page-container .white-bg-box:hover {
            box-shadow: 0 0 8px 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 0 8px 1px rgba(0, 0, 0, 0.2);
            -webkit-box-shadow: 0 0 8px 1px rgba(0, 0, 0, 0.2);
        }

        .shopping-page-container .border-right {
            border-right: 1px solid #e4e4e4;
        }

        .pro-title {
            font-size: 16px;
            color: #000000;
        }

        .pro-short-desc {
            font-size: 14px;
            color: #333333;
        }

        .pro-price {
            font-size: 1.571em;
            margin-bottom: 0px;
            line-height: 1.2
        }

        .pro-total-price {
            font-size: 1.581em;
        }

        .shop_img {
            overflow: hidden;
            position: relative;
            transition: all 0.2s linear 0s;
            max-width: 184px;
            border-radius: 10px 0px 0px 10px;
            z-index: 2;
            background: #ffffff;
        }

        .shop_img span.img-thumb {
            display: block;
            position: relative;
            overflow: hidden;
            transition: all 0.4s linear 0s;
            -webkit-transition: all 0.4s linear 0s;
            -moz-transition: all 0.4s linear 0s;
        }

        .shop_img .img-thumb {
            height: 150px;
            text-align: center;
        }

        .shop_img .img-thumb img {
            max-width: 100%;
            height: 100%;
            position: absolute;
            left: 50%;
            top: 50%;
            transition: all 0.6s linear 0s;
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .qty_wrapper {
            margin-bottom: 22px;
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .qty_wrapper label {
            font-size: 14px;
            margin-right: 5px;
            letter-spacing: 1px;
            line-height: 20px;
            text-transform: uppercase;
            vertical-align: middle;
            -moz-user-select: none;
            display: inline-block;
            margin-bottom: 0px;
        }

        .qty_wrapper .qty_controles {
            display: inline-block;
            vertical-align: middle;
        }

        .qty_wrapper .qty_controles .item_number {
            background: #f0f0f0;
            color: #a4a4a4;
            border-radius: 50%;
            cursor: pointer;
            text-align: center;
            font-size: 18px;
            height: 20px;
            line-height: 20px;
            width: 20px;
        }

        .qty_wrapper .qty {
            height: 20px;
            width: 50px;
            border: 1px solid #e4e4e4;
            border-radius: 0;
            font-size: 12px;
        }

        .qty_wrapper input.qty[type="number"],
        input.qty[type="text"] {
            text-align: center;
            vertical-align: top;
            width: 3em;
            max-width: 100%;
            padding: 0 8px;
            -moz-appearance: none;
            background: transparent;
        }

        .pad15 {
            padding: 15px;
        }

        .font12 {
            font-size: 12px;
        }
    </style>
@endpush
