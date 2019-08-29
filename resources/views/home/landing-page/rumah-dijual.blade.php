<section class="ftco-section goto-here">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">What we offer</span>
                <h2 class="mb-2">Exclusive Offer For You</h2>
            </div>
        </div>
        <div class="row">
            @foreach($info['rumah-dijual'] as $i)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ url('storage/'.$i->gambar) }}" class="card-img-top" alt="{{ $i->nama_rumah }}" style="height: 15rem; width: auto;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col text-truncate">
                                    <strong>{{ $i->nama_rumah }}</strong>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item" style="background-color: yellow">
                            <strong class="text-gray-dark">Rp {{ number_format($i->harga,2) }}</strong>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-tiles"></i> LT {{ $i->luas_tanah }} || LB {{ $i->luas_bangunan }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-stairs"></i> {{ $i->lantai }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-hotel"></i> {{ $i->kamar_tidur }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-bathtub-with-opened-shower"></i> {{ $i->kamar_mandi }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-kitchen"></i> {{ $i->dapur_bersih }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-kitchen"></i> {{ $i->dapur_kotor }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-herbal-spa-treatment-leaves"></i> {{ $i->taman }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-compass-with-white-needles"></i> {{ $i->arah_rumah }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-lightning-in-a-circle"></i> {{ $i->listrik }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-truncate">
                                        <i class="flaticon-family-sofa"></i> {{ $i->furniture }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('rumah-dijual/detail/'.$i->id) }}" class="btn btn-primary btn-block">
                            <span class="text-dark">Detail</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
