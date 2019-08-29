<!DOCTYPE html>
<html lang="en">
<head>
    @include('home._partials.head')
</head>
<body>

@include('home._partials.navbar')
<!-- END nav -->

@yield('content')

@include('home._partials.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

@include('home._partials.footer-script')

</body>
</html>
