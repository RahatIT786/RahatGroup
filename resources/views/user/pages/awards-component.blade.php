<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Awards</h1>
        </div>
    </section>
    <section class="innercontarea">
        <div class="container">
            <div class="row">
                @foreach ($awards as $award)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="awardsagmbox mb-0" style="height: 100%;">
                            <div class="awardsagmboximg">
                                @if ($award->awardimage)
                                    <a href="{{ route('awards-details', ['id' => $award->id]) }}">
                                        <img class="img"
                                            src="{{ asset('/storage/award/' . $award->awardimage->image) }}"
                                            alt="image {{ $award->awardimage->id }}">
                                    </a>
                                @endif
                            </div>
                            <div class="awardsagmcont">
                                <h4>
                                    <a
                                        href="{{ route('awards-details', ['id' => $award->id]) }}">{{ $award->title }}</a>
                                </h4>
                                {{-- <p>{{ $award->sub_title }}</p> --}}
                                <p>
                                    {!! Helper::limitText($award->description) !!}
                                </p>
                                <div class="infolinks
                                      topmargin10">
                                    <a href="{{ route('awards-details', ['id' => $award->id]) }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@push('extra_css')
    <style>
        .innercontarea {
            padding: 30px 0px;
        }

        .awardsagmbox {
            margin-bottom: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 8px;
            -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
        }

        .awardsagmboximg {
            width: 100%;
            height: 200px;
            border-radius: 8px;
        }

        .awardsagmboximg img {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
            object-position: 50% 50%;
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
