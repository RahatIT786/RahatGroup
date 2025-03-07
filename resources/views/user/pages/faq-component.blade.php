<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>FAQ</h1>
        </div>
    </section>
    <section class="klzXdu">
        <h1 class="cIhsBF container">F.A.Q</h1>
        <div class="dHuQhi container">
            @forelse($QsFaq as $RsFaq)
                <div class="bPqodi" data-toggle="collapse" data-target="#faq{{ $RsFaq->id }}"
                    aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">{!! $RsFaq->question !!}</p>
                            <button class="arrow-up">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                    stroke-linecap="round" stroke-linejoin="round" height="25" width="25"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg>
                            </button>
                            <button class="arrow-down">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                    stroke-linecap="round" stroke-linejoin="round" height="25" width="25"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                        </div>
                        <div class="hKhJTI collapse" id="faq{!! $RsFaq->id !!}">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>{!! $RsFaq->answer !!}</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <p>No Data Found!</p>
            @endforelse
        </div>
    </section>
</main>