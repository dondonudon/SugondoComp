<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    @include('home._partials.head')
</head>
<body>

@include('home._partials.navbar')

@include('home.landing-page.hero-section')
{{--@include('home.landing-page.slider')--}}
@include('home.landing-page.about-us')
@include('home.landing-page.visi-misi')
@include('home.landing-page.product')
{{--@include('home.landing-page.top-marketer')--}}
{{--@include('home.landing-page.favourite-marketer')--}}
{{--@include('home.landing-page.our-team')--}}
{{--@include('home.landing-page.aktivitas-kita')--}}
{{--@include('home.landing-page.rumah-dijual')--}}

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=81901115111&text=Hai" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>

@include('home._partials.footer')

@include('home._partials.footer-script')

</body>
</html>
