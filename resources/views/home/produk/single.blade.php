@extends('home.produk.layout')

@section('content')
    <div class="product_image_area section_gap_bottom">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ url('storage/'.$prod->gambar) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $prod->judul }}</h3>
                        <?php echo $prod->content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
