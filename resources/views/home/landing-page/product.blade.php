<section class="owl-carousel active-product-area section_gap" id="product">
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Our Products</h1>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- single product -->
                @foreach($info['products'] as $i)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="{{ url('storage/'.$i->gambar) }}" alt="{{ $i->url }}">
                            <div class="product-details">
                                <div class="row">
                                    <div class="col h6 text-truncate text-dark">
                                        {{ $i->judul }}
                                    </div>
                                </div>
                                <div class="prd-bottom">
                                    <a href="{{ url('produk/'.$i->url) }}" class="social-info">
                                        <span class="fas fa-eye"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- single product -->
            </div>
        </div>
    </div>
</section>
