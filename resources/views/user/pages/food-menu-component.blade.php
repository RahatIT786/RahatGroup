
<main class="cAJbgc" style="margin-top: 0px;">

    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
        <div class="container">
            <h1>Food Menu</h1>
        </div>
    </section>
    <div class="container pt-5">
        <div class="row">
            @foreach ($Foods as $food)
                {{-- @php
                   dd($food);

                @endphp --}}
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="awardsagmbox">
                        <a href="{{ route('foodMenu-details', ['id' => $food->id]) }}">
                            <div class="awardsagmboximg">
                                @if ($food->foodimage)
                                    <img class="img"
                                        src="{{ asset('/storage/food_image/' . $food->foodimage->image) }}"
                                        alt="image {{ $food->foodimage->id }}">
                                @endif
                            </div>
                            <div class="awardsagmcont">
                                <h4>
                                    {{ $food->food_type ?? '' }} <strong>-&#xFDFC;</strong> {{ $food->price }}
                                    @if($food->food_pdf !='')
                                        <a style="float:right;" href="{{ asset('storage/food_pdf/' . $food->food_pdf) }}"
                                        target="_blank"> &nbsp;
                                        <i class="fa fa-file-pdf-o"
                                            style="font-size: 30px; color: red;">
                                        </i>
                                    @endif
                                </a>
                                </h4>
                                <p>
                                    {!! Helper::limitText($food->description) !!}

                                </p>

                                <p>
                                    {!! Helper::limitText($food->lunch) !!}
                                </p>

                                <p>
                                    {!! Helper::limitText($food->dinner) !!}
                                </p>
                                {{-- <div class="infolinks
                                        topmargin10">
                                    <a href="{{ route('foodMenu-details', ['id' => $food->id]) }}"></a>
                                </div> --}}
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
