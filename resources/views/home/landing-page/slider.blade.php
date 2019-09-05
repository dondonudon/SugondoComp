<section class="ftco-section ftco-agent goto-here mt-5" id="promo">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">PROMO</span>
                <h2 class="mb-4">Ray White Promo</h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md">
                <div id="slider_section">
                    @foreach($info['image-slider'] as $i)
                        <div><img src="{{ url('storage/'.$i->filename) }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
