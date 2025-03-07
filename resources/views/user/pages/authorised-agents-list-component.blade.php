{{-- <div>
    <main class="cAJbgc" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
            <div class="container">
                <h1>{{ $QsAgent->pagecontent->page_name }}</h1>
            </div>
        </section>
        <div class="container py-4">
            <p class="sc-2fe98234-7 iebARE">{!! html_entity_decode($QsAgent->description) !!}</p>
        </div>
    </main>
</div> --}}

<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.rahattravels.com/public/upload/rahattravels/static_pages/223/large/223_1710578627.jpg);">
        <div class="container">
            <h1>{{$QsAgent->pagecontent->page_name}}</h1>
        </div>
    </section>
    <section class="content-section">
        <div class="container">
            <div class="contentbox">
                <p class="iebARE">{!! html_entity_decode($QsAgent->description) !!}</p>
            </div>
        </div>
    </section>
</main>

@push('extra_css')
<style>
.content-section {
  padding: 50px 0px;
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
.content-section a{
  color: #0059e3;
  cursor: pointer;
}
.content-section a:hover {
  color: #0546a7;
  text-decoration: none;
}
</style>
@endpush