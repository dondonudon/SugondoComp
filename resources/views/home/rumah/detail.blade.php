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

    <section class="ftco-section ftco-property-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="property-details">
                        <div class="img" style="background-image: url({{ url('storage/'.$content->gambar) }});"></div>
                        <div class="text text-center">
                            <h1>{{ $content->nama_rumah }}</h1>
                            <h4>Rp {{ number_format($content->harga,2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pills">
                    <div class="bd-example bd-example-tabs">
                        <div class="d-flex justify-content-center">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="features">
                                            <li class="check">
                                                <span class="flaticon-tiles"></span>Bangunan: LT {{ $content->luas_tanah }} || LB {{ $content->luas_bangunan }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-stairs"></span>Lantai: {{ $content->lantai }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-hotel"></span>Kamar Tidur: {{ $content->kamar_tidur }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-bathtub-with-opened-shower"></span>Kamar Mandi: {{ $content->kamar_mandi }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-kitchen"></span>Dapur Bersih: {{ $content->dapur_bersih }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="features">
                                            <li class="check">
                                                <span class="flaticon-kitchen"></span>Dapur Kotor: {{ $content->dapur_kotor }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-herbal-spa-treatment-leaves"></span>Taman: {{ $content->taman }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-compass-with-white-needles"></span>Arah Rumah: {{ $content->arah_rumah }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-lightning-in-a-circle"></span>Listrik: {{ $content->listrik }}
                                            </li>
                                            <li class="check">
                                                <span class="flaticon-family-sofa"></span>Furniture: {{ $content->furniture }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                                <?php echo $content->detail; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
