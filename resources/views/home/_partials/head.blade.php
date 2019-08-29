<title>
    {{ config('app.app_name') }}
    {{
    (isset(Illuminate\Support\Facades\Request::segments()[1]))
    ? ' - '.Illuminate\Support\Facades\Request::segments()[0]
    : ''
    }}
</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('home/css/open-iconic-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('home/css/animate.css') }}">

<link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('home/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css') }}">

<link rel="stylesheet" href="{{ asset('home/css/aos.css') }}">

<link rel="stylesheet" href="{{ asset('home/css/ionicons.min.css') }}">

<link rel="stylesheet" href="{{ asset('home/css/bootstrap-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('home/css/jquery.timepicker.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('home/home-icon/flaticon.css') }}">
{{--<link rel="stylesheet" href="{{ asset('home/css/flaticon.css') }}">--}}
<link rel="stylesheet" href="{{ asset('home/css/icomoon.css') }}">
<link rel="stylesheet" href="{{ asset('home/css/style.css') }}">

{{-- GLIDE JS --}}
<link rel="stylesheet" href="{{ asset('vendor/glide/dist/css/glide.core.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/glide/dist/css/glide.theme.css') }}">
