<section class="banner-area" style="background: url({{ asset('storage/'.$info['header']['background'][0]['data']) }}) center no-repeat" id="promo">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    <!-- single-slide -->
                    @foreach($info['header']['slider'] as $i)
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-12 col-md-12">
                                <div class="banner-content">
                                    <img class="img-fluid" src="{{ url('storage/'.$i['data']) }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
