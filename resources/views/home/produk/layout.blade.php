<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    @include('home._partials.head')
</head>

<body>

<!-- Start Header Area -->
@include('home._partials.navbar')
<!-- End Header Area -->

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb" style="background: url({{ asset('storage/'.$info['header']['background'][0]['data']) }}) center no-repeat">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1 class="text-danger">Produk Kami</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ url('/') }}" class="text-danger">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a class="text-danger">product-details</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
@yield('content')
<!--================End Single Product Area =================-->



<!-- start footer Area -->
@include('home._partials.footer')
<!-- End footer Area -->

@include('home._partials.footer-script')

</body>

</html>
