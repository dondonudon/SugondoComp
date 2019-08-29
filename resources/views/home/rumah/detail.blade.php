@extends('home.rumah.layout')

@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{ url('storage/'.$content->gambar) }}');" data-stellar-background-ratio="0.5">
        <div class="overlay" style="background-color: lightgray; opacity: 0.5;"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    {{--                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.html">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog Single <i class="ion-ios-arrow-forward"></i></span>--}}
                    {{--                </p>--}}
                    <h4 class="mb-3 bread">About This Property</h4>
                    <h1>{{ $content->nama_rumah }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">

                <div class="col-md-2"></div>
                <div class="col-md-8 ftco-animate">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card">
                                <img class="card-img-top" width="100%" src="{{ url('storage/'.$content->gambar) }}" alt="{{ $content->nama_rumah }}">
                                <div class="card-body">
                                    <strong class="text-gray-dark">Harga Rumah: Rp {{ number_format($content->harga,2) }}</strong>
                                </div>
                            </div>

                            <h2 class="mt-3 mb-3">{{ $content->nama_rumah }}</h2>
                            <h5 class="mt-3">Info:</h5>
                            <?php echo $content->detail; ?>

                            <h5 class="mt-3">Spesifikasi:</h5>
                            <i class="flaticon-tiles"></i> LT {{ $content->luas_tanah }} || LB {{ $content->luas_bangunan }}
                            <br><i class="flaticon-stairs"></i> {{ $content->lantai }}
                            <br><i class="flaticon-hotel"></i> {{ $content->kamar_tidur }}
                            <br><i class="flaticon-bathtub-with-opened-shower"></i> {{ $content->kamar_mandi }}
                            <br><i class="flaticon-kitchen"></i> {{ $content->dapur_bersih }}
                            <br><i class="flaticon-kitchen"></i> {{ $content->dapur_kotor }}
                            <br><i class="flaticon-herbal-spa-treatment-leaves"></i> {{ $content->taman }}
                            <br><i class="flaticon-compass-with-white-needles"></i> {{ $content->arah_rumah }}
                            <br><i class="flaticon-lightning-in-a-circle"></i> {{ $content->listrik }}
                            <br><i class="flaticon-family-sofa"></i> {{ $content->furniture }}
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>

            </div>
        </div>
    </section>
@endsection
