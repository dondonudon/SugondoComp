<!DOCTYPE html>
<html lang="en">
<head>
    @include('home._partials.head')
</head>
<body>

@include('home._partials.navbar')

@include('home.landing-page.hero-section')
@include('home.landing-page.slider')
@include('home.landing-page.about-us')
@include('home.landing-page.quote-of-the-day')
@include('home.landing-page.top-lister')
@include('home.landing-page.top-marketer')
@include('home.landing-page.favourite-marketer')
@include('home.landing-page.our-team')
@include('home.landing-page.aktivitas-kita')
@include('home.landing-page.rumah-dijual')

@include('home._partials.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"></circle>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"></circle>
    </svg>
</div>

@include('home._partials.footer-script')

</body>
</html>
