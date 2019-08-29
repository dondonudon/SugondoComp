@extends('home.blog.layout')

@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-color: lightgray;');" data-stellar-background-ratio="0.5">
        <div class="overlay" style="background-color: lightgray; opacity: 0.5;"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    {{--                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.html">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog Single <i class="ion-ios-arrow-forward"></i></span>--}}
                    {{--                </p>--}}
                    <h1 class="mb-3 bread">Our Activity</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt">
        <div class="container mt-5">
            <div class="row d-flex justify-content-md-center">
                @foreach($aktivitas_kita as $a)
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="blog-entry justify-content-end">
                            <div class="text">
                                <h3 class="heading"><a href="{{ url('aktivitas-kita/'.$a->id) }}">{{ $a->judul }}</a></h3>
                                <div class="meta mb-3">
                                    <div>
                                        <a href="{{ url('aktivitas-kita/'.$a->id) }}">{{ $a->created_at }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ url('aktivitas-kita/'.$a->id) }}">{{ $a->username }}</a>
                                    </div>
                                </div>
                                <a href="{{ url('aktivitas-kita/'.$a->id) }}" class="block-20 img" style="background-image: url('{{ url('storage/'.$a->image) }}');">
                                </a>
                                <p>{{ $a->short_desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
