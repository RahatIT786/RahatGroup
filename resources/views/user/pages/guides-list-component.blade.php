<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.rahattravels.com/public/upload/rahattravels/static_pages/224/large/224_1710578333.jpg);">
        <div class="container">
            <h1>{{$guides->pagecontent->page_name}}</h1>
        </div>
    </section>
    <section class="content-section">
        <div class="container">
            <div class="contentbox">
                <p class="iebARE">{!! html_entity_decode($guides->description) !!}</p>
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


