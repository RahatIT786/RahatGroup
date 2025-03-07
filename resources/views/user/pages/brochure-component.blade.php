<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
        <div class="container">
            <h1>Brochure</h1>
        </div>
    </section>

    <div class="innercontarea">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="background-color: black; color: white;">Name</th>
                                <th style="background-color: black; color: white;">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brochures as $brochure)
                                <tr>
                                    <td>{{ $brochure->name }}</td>
                                    <td >
                                        <a href="{{ asset('storage/profile_image/'.$brochure->image) }}" target="_blank">
                                            <i class="fa fa-download"></i> &nbsp;{{ basename($brochure->image) }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@push('extra_css')
<style>
    .table a{color: #337ab7;}
</style>
@endpush