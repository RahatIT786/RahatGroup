<div>
    <main class="cAJbgc" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.rahattravels.com/public/upload/rahattravels/static_pages/195/large/195_1710137071.jpg);">
            <div class="container">
                <h1>{{ $jobOpnings->pagecontent->page_name }}</h1>
            </div>
        </section>
        <section class="content-section">
            <div class="container">
                <div class="contentbox">
                    <p class="iebARE">{!! html_entity_decode($jobOpnings->description) !!}</p>
                </div>
            </div>
        </section>
    </main>
</div>
@push('extra_css')
    <style>
        .content-section {
            padding: 50px 0px;
        }

        .contentbox ol {
            list-style: list;
            padding-left: 15px;
        }

        .contentbox ol li {
            list-style: list;
        }

        .contentbox {
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 25px;
            -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
        }

        .content-section a {
            color: #0059e3;
            cursor: pointer;
        }

        .content-section a:hover {
            color: #0546a7;
            text-decoration: none;
        }
    </style>
@endpush
