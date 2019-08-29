<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 text-white"><b>{{ config('app.app_name') }}</b></h2>
                    <p class="text-white">Far far away, behind the word mountains, far from the countries.</p>
{{--                    <ul class="ftco-footer-social list-unstyled mt-5">--}}
{{--                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>--}}
{{--                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>--}}
{{--                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>--}}
{{--                    </ul>--}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 text-white">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li>
                                <span class="icon fas fa-map-marked-alt" style="color: white;"></span>
                                <span class="text-white"> {{ $info['contact-us']['alamat'] }}</span>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon fas fa-phone" style="color: white;"></span>
                                    <span class="text-white">{{ $info['contact-us']['no_telp'] }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon fas fa-envelope" style="color: white;"></span>
                                    <span class="text-white">{{ $info['contact-us']['email'] }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p style="color: white;">
                    <i class="fa fa-copyright"></i> {{ date('Y') }}
                    {{ config('app.app_name') }}
                </p>
                <p style="color: white;">
                    Developed by
                    <a href="https://waveitsolution.com" target="_blank">
                        <span style="color: blue">WAVE Solusi Indonesia</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
