<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Publication</h1>
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

            @forelse ($publications as $key => $publication)
                <div class="shop-pro-row">
                    <div class="white-bg-box">
                        <div class="row mx-0">
                            <div class="col-md-2 px-0">
                                <div class="shop_img">
                                    <span class="img-thumb">
                                        <img alt="cheap umrah packages"
                                            src="{{ asset('/storage/publication_image/' . $publication->image) }}">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 px-0 border-right">
                                <div class="pad15">
                                    <h5 class="h5 pro-title mb-0">{{ $publication->name }}</h5>
                                    <div class="pro-short-desc mb-2 mt-2">
                                        <span id="text-{{ $id }}"style="display:inline-block;">
                                            {!! \App\Helpers\Helper::limitTextReadMore($publication->description, 120) !!}
                                        </span>
                                        <a href="javascript:void(0)" id="read-more-{{ $id }}"
                                            onclick="toggleText('{{ $id }}')">Read More</a>
                                        <a href="javascript:void(0)" id="read-less-{{ $id }}"
                                            style="display:none;" onclick="toggleText('{{ $id }}')">Read
                                            Less</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 px-0 border-right">
                                <div class="pad15">
                                    <p class="pro-price"><small class="font12"><strong>Price</strong></small><span
                                            class="d-block font-weight-bold">{{ number_format($publication_details[$key]['price'], 2) }}</span>
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
                                                    class="item_number minus" id="minus-{{ $publication->id }}"
                                                    width="20px" height="20px"
                                                    wire:click="qtySubstract('{{ $key }}')">
                                                <input name="item_{{ $publication->id }}"
                                                    id="item_{{ $publication->id }}" type="text"
                                                    onblur="get_shop_price({{ $publication->price }}, 0, '{{ $publication->id }}')"
                                                    value="0" class="qty"
                                                    wire:model ="publication_details.{{ $key }}.{{ 'qty' }}">
                                                <img src="{{ asset('assets/user-front/images/add_icon.png') }}"
                                                    class="item_number add" id="add-{{ $publication->id }}"
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
                                            <span>{{ number_format($publication_details[$key]['tot_price'], 2) }}</span></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: red;">No Data Found!</p>
            @endforelse
            <div class="shop-pro-row">
                <div class="white-bg-box">
                    <div class="row mx-0">
                        <div class="col-md-12 px-0">
                            <div class="pad15 text-right">
                                <span class="pro-total-price font-weight-bold text-success">Total Amount ₹ <span
                                        id="tot_shop_price">{{ number_format($grand_total, 2) }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0">
                <div class="col-md-12 px-0">
                    <div class="text-right" id="book_btn">
                        <button type="submit" href="javascript:void(0);" font-size="smallest" data-toggle="modal"
                            data-target="#publicationModal" class="btn default-btn " name="btn_kit_enquiry">Enquiry
                            Now</button>
                        {{-- <button type="submit" class="btn secondary-btn" name="btn_kit_submit">Book Now</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateQuantity(id, change) {
            const qtyInput = document.getElementById('item_' + id);
            let currentValue = parseInt(qtyInput.value) || 0;
            currentValue += change;
            qtyInput.value = currentValue;

        }

        function toggleText(id) {
            let textDiv = document.getElementById('text-' + id);
            let readMore = document.getElementById('read-more-' + id);
            let readLess = document.getElementById('read-less-' + id);

            if (readMore.style.display !== 'none') {
                // Load the full text


                textDiv.innerHTML = `{!! isset($publication) ? \App\Helpers\Helper::limitTextReadMore($publication->description, 120, '...', false) : '' !!}`;
                readMore.style.display = 'none';
                readLess.style.display = 'inline';
            } else {
                // Load the truncated text
                textDiv.innerHTML = `{!! isset($publication) ? \App\Helpers\Helper::limitTextReadMore($publication->description, 120, '...', false) : '' !!}`;
                readMore.style.display = 'inline';
                readLess.style.display = 'none';
            }
        }
    </script>
</main>

@push('extra_css')
    <style>
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

@push('extra_js')
@endpush
