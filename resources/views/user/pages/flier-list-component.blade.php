<main class="cAJbgc" style="margin-top: 0;">

    <section class="bhHkoO" style="overflow: hidden; grid-template-rows: 1fr auto auto;">
        <div class="kFGewH">
            <div style="opacity: 1;">
                <span
                    style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                    <img sizes="100vw" src="/assets/user/images/about_banner.jpeg"
                        style="inset: 0px; box-sizing: border-box; padding: 0px; border: medium; margin: auto; display: block; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                </span>
            </div>
        </div>
        <div class="exQQDF container"
            style="translate: none; rotate: none; scale: none; transform: translate(0px); opacity: 1; visibility: inherit;">
            <article style="color: rgb(245, 245, 245);">
                <h1 font-size="4rem" class="iqCkem">Flier</h1>
            </article>
        </div>
        <div class="heqWvM">
            <!-- <div id="icon-container"></div> -->
            <img src="/assets/user/images/waveline.png" style="width:100%;height: 25vh;" class="wave" />
        </div>
    </section>

    <div class="container">
        <div class="row">
            @foreach ($fliers as $flier)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="awardsflierbox mb-0">
                        <div class="awardsflierboximg">
                            @if ($flier->image)
                                <img class="img" src="{{ asset('/storage/fliers/' . $flier->image) }}"
                                    alt="Flier image {{ $flier->id }}">
                            @endif
                        </div>
                        <div class="awardsfliercont">
                            <h4>{{ $flier->service_name }}</h4>

                            <div class="scroll-container">
                                <p class="description-text" style="line-height: 1.4rem;">
                                    {!! $flier->comments !!}
                                </p>
                            </div>
                            <div class="infolinks topmargin10">
                                <!-- Optional content here if needed -->
                            </div>
                        </div>
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

        .awardsflierbox {
            margin-bottom: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 8px;
            -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
        }

        .awardsflierboximg {
            width: 100%;
            height: 200px;
            border-radius: 8px;
        }

        .awardsflierboximg img {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
            object-position: 50% 50%;
        }

        .awardsfliercont {
            padding: 20px 10px;
        }

        .awardsfliercont h4 {
            font-size: 18px;
            color: #1e1e1e;
            line-height: 22px;
            font-weight: 600;
            min-height: 45px;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .awardsfliercont h4 a {
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

        .scroll-container {
            -moz-box-orient: vertical;
            overflow-y: auto;
            height: 180px;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: #B49164 #f8f8f8;
        }
    </style>
@endpush
