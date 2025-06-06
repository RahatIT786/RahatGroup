<main class="cAJbgc" style="margin-top: 0px;">

    <div class="bannercls">
        <picture>
            <source media="(min-width:980px)"
                src="{{ asset('/assets/user-front/images/Banner_Medina_071_8764ebb5df.jpeg') }}">
            <source media="(min-width:400px)"
                src="{{ asset('/assets/user-front/images/Banner_Medina_071_8764ebb5df.jpeg') }}">
            <img src="{{ asset('/assets/user-front/images/Banner_Medina_071_8764ebb5df.jpeg') }}">
        </picture>
        <div class="box">
            <div class="container">
                <div class="animate-box">
                    <nav class="breadcrumbs">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="#">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Food Menu</span>
                        </span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row">
            @foreach ($Foods as $food)
                {{-- @php
                   dd($food);

                @endphp --}}
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="awardsagmbox">
                        <a href="{{ route('customer.foodMenu-details', ['id' => $food->id]) }}">
                            <div class="awardsagmboximg">
                                @if ($food->foodimage)
                                    @php
                                        $imagePath = public_path('storage/food_image/' . $food->foodimage->image);
                                        $fileExtension = pathinfo($food->foodimage->image, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                        <!-- Display Image -->
                                        <img class="img"
                                            src="{{ asset('/storage/food_image/' . $food->foodimage->image) }}"
                                            alt="image {{ $food->foodimage->id }}">
                                    @elseif (strtolower($fileExtension) == 'pdf')
                                        <!-- Display PDF -->
                                        <object data="{{ asset('/storage/food_image/' . $food->foodimage->image) }}"
                                            type="application/pdf" width="100%" height="300px">
                                            <p>Your browser does not support PDFs.
                                                <a href="{{ asset('/storage/food_image/' . $food->foodimage->image) }}">Download
                                                    the PDF</a>.
                                            </p>
                                        </object>
                                    @endif
                                @endif
                            </div>
                            <div class="awardsagmcont">
                                <h4>
                                    {{ $food->food_type ?? '' }} <strong>-&#xFDFC;</strong> {{ $food->price }}
                                    @if($food->food_pdf !='')
                                        <a class="float-right" href="{{ asset('storage/food_pdf/' . $food->food_pdf) }}"
                                        target="_blank"> &nbsp;
                                        <i class="fa fa-file-pdf-o"
                                            style="font-size: 30px; color: red;">
                                        </i>
                                    @endif
                                </a>
                                </h4>
                                <p>{!! Helper::limitText($food->description) !!}</p>
                                <p>{!! Helper::limitText($food->lunch) !!}</p>
                                <p>{!! Helper::limitText($food->dinner) !!}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@push('extra_css')
    <style>
        .innercontarea {
            padding: 30px 0px;
        }

        .awardsagmbox {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 8px;
            -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .awardsagmbox a:hover {
            color: unset;
            text-decoration: none;
        }

        .awardsagmboximg {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
        }

        .awardsagmboximg img {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
            object-position: 50% 50%;
            transition: all ease-in-out 0.4s;
        }

        .awardsagmbox:hover .awardsagmboximg img {
            transform: scale(1.2);
        }

        .awardsagmcont {
            padding: 20px 10px;
        }

        .awardsagmcont h4 {
            font-size: 18px;
            color: #1e1e1e;
            line-height: 22px;
            font-weight: 600;
            min-height: 45px;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .awardsagmcont h4 a {
            color: #1e1e1e;
            text-decoration: none;
        }

        .awardsagmtext {
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 4em;
            min-height: 75px;
        }

        .infolinks {
            color: #0059e3;
            font-size: 13px;
            line-height: 16px;
            cursor: pointer;
        }

        .infolinks a {
            color: #0059e3;
            text-decoration: none;
        }
    </style>
@endpush
