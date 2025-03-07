<div>
    <div>
        <div class="bannercls">
            <picture>
                <source media="(min-width:980px)" src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
                <source media="(min-width:400px)" src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
                <img src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
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
                                <span class="breadcrumb-text">About Us</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="cFsWLv">
            <div class="container">
                <div class="kwTvyr">
                    <div style="position: relative;">
                        <div class="bvlNDR" id="ihram1">
                            <div class="ekbRzC">
                                <div class="wiW">
                                    <div class="cAPVAn">
                                        <article class="hrmAU">
                                            <div class="kexixH">
                                                <div>
                                                    <p class="sc-2fe98234-7 iebARE">{!! $QsHajj->description !!}</p>

                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            @push('extra_css')
                <style>
                    .animate-box {
                        padding: 20px 0 !important;
                    }

                    .bannercls .box {
                        background: rgba(0, 0, 0, .5) !important;
                    }

                    .bannercls .box {
                        position: absolute;
                        z-index: 999;
                        bottom: 0;
                        display: block;
                        color: #ffffff;
                        padding: 0;
                        width: 100%;
                    }


                    .about-section {
                        padding: 50px 0;
                        background-color: #f8f8f8;
                    }

                    .fAWLEZ,
                    .cAJbgc {
                        position: relative;
                        z-index: unset;
                    }


                    .ivzPfq {
                        padding: 0px;
                        display: flex;
                        -moz-box-pack: justify;
                        justify-content: center;
                        overflow-x: auto;
                        -moz-box-align: stretch;
                        align-items: stretch;
                        gap: 1rem 0.25rem;
                        max-width: 100vw;
                        text-align: center;
                        position: sticky;
                        top: 115px;
                        z-index: 29;
                    }

                    .ivzPfq ul {
                        gap: 0.5rem 1rem;
                        list-style: none;
                        display: flex;
                        -moz-box-pack: justify;
                        justify-content: space-between;
                        text-align: center;
                    }

                    @media (min-width: 550px) {
                        .ivzPfq ul {
                            display: flex;
                            -moz-box-pack: center;
                            justify-content: center;
                        }
                    }

                    .ivzPfq ul li {
                        max-width: 200px;
                        word-break: keep-all;
                        list-style: none;
                    }

                    .ivzPfq ul li>a {
                        padding: 1rem;
                        min-height: 100px;
                    }

                    .ivzPfq ul li>a>h6 {
                        display: none;
                        font-size: 0.8rem;
                        margin-bottom: 0px;
                    }

                    .ivzPfq ul li>a div {
                        display: flex;
                        margin: auto;
                        margin-bottom: auto;
                    }

                    .ivzPfq .image-container {
                        height: 30px;
                        width: 30px;
                        position: relative;
                        justify-self: center;
                        margin-bottom: 0.5rem;
                    }

                    @media (min-width: 550px) {
                        .ivzPfq ul li>a>h6 {
                            display: block;
                        }

                        .ivzPfq .image-container {
                            height: 30px;
                            width: 30px;
                        }
                    }

                    p {
                        overflow-wrap: break-word;
                    }

                    .gAMdHF {
                        display: block;
                        position: relative;
                        height: 100%;
                    }

                    .cFsWLv {
                        background-color: rgb(247, 247, 247);
                        padding: 3.125rem;
                        max-width: 100vw;
                        display: flex;
                        flex-direction: column;
                        gap: 1rem;
                    }

                    .kwTvyr {
                        display: grid;
                        gap: 1.5rem;
                        background-color: rgb(230, 230, 230);
                        border-radius: 0.8rem;
                        padding: 1rem 2rem;
                        margin-bottom: 1rem;
                    }

                    .fIgWtB {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        width: 100%;
                        cursor: pointer;
                    }

                    .arrow-up,
                    .arrow-down {

                        background: transparent;
                        border: 0px;
                    }

                    .fIgWtB[aria-expanded="true"] .arrow-up {
                        display: block;
                    }


                    .bvlNDR {
                        cursor: default;
                        margin-top: 1rem;
                    }

                    .ekbRzC {
                        display: flex;
                        gap: 2rem;
                        flex-direction: column;
                    }

                    .wiW {
                        display: flex;
                        gap: 3.125rem;
                        align-items: start;
                    }

                    .cAPVAn {
                        gap: 2rem;
                        display: flex;
                        flex-direction: column;
                        width: 100%;
                    }

                    .ldpEfj {
                        min-height: 14.5rem;
                        position: relative;
                        overflow: hidden;
                        min-width: 26.5rem;
                        width: 100%;
                        height: auto;
                        border-radius: 16px;
                    }

                    .ldpEfj img {
                        object-fit: cover;
                        position: absolute;
                        left: 0px;
                        top: 0px;
                        max-width: 100%;
                    }

                    .giwbVk {
                        display: flex;
                        gap: 1.5rem;
                        align-items: center;
                        flex-wrap: wrap;
                    }

                    .fIgWtB[aria-expanded="true"] .arrow-down,
                    .fIgWtB[aria-expanded="false"] .arrow-up {
                        display: none;
                    }

                    .ffChlS {
                        font-size: 1.2rem;
                        font-weight: 600;
                        line-height: 135%;
                        font-style: normal;
                        margin: 0;
                    }
                </style>
            @endpush

            @push('extra_js')
                <script>
                    var $videoSrc;
                    $('.video-btn').click(function() {
                        $videoSrc = $(this).data("src");
                    });
                    console.log($videoSrc);
                    $('#videoModal').on('shown.bs.modal', function(e) {
                        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"); //
                    })
                    $('#videoModal').on('hide.bs.modal', function(e) {
                        $("#video").attr('src', '');
                    });
                </script>
            @endpush
