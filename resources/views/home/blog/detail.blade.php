@extends('home.blog.layout')

@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{ url('storage/'.$head['header-section-image']->filename) }}');" data-stellar-background-ratio="0.5">
        <div class="overlay" style="background-color: lightgray; opacity: 0.5;"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    {{--                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.html">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog Single <i class="ion-ios-arrow-forward"></i></span>--}}
                    {{--                </p>--}}
                    <h4 class="mb-3 bread">Our Activity</h4>
                    <h1><strong>{{ $content->judul }}</strong></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <img class="img-fluid" src="{{ url('storage/'.$head['header-section-image']->filename) }}" alt="gambar rumah">
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row mt-5">

                <div class="col-md-2"></div>
                <div class="col-md-8 ftco-animate">
                <span class="h2">
                    <strong>"{{ $content->judul }}"</strong>
                </span>
                    <div class="mt-5"></div>
                    <span class="h4">
                    <?php echo $content->content; ?>
                </span>
                </div>
                <div class="col-md-2"></div>

            </div>
        </div>
    </section>
@endsection
