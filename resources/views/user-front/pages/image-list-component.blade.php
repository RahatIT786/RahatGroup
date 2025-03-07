<div>
    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="breadcrumbs mb-4">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="#">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Image</span>
                        </span>
                    </nav>
                </div>
            </div>
            <div class="image-gallery">
                @foreach ($images as $image)
                    @php
                        // Assuming $image->image contains the filename
                        $imagePath = asset('storage/image_gallery/' . $image->image);
                    @endphp
                    <div class="tiler layout cellColumns cellRows cells splitting"
                        style="background-image: url('{{ $imagePath }}'); --0-total: 9; --col-total: 3; --row-total: 3; --cell-total: 9;">
                        <img src="{{ $imagePath }}" alt="Gallery Image">
                        <span class="cell-grid">
                            @for ($i = 0; $i < 9; $i++)
                                <span class="cell"
                                    style="--0-index: {{ $i }}; --col-index: {{ $i % 3 }}; --row-index: {{ intdiv($i, 3) }}; --cell-index: {{ $i }}">
                                    <span class="cell-inner"></span>
                                </span>
                            @endfor
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('extra_js')
    <script>
        $(document).ready(function() {
            Splitting({
                target: '.tiler',
                by: 'cells',
                rows: 3,
                columns: 3,
                image: true
            }); //Image('.tiler-overlay', { rows: 3, cols: 3 });

        });
    </script>
@endpush
