<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-8">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 "><b>{{ config('app.app_name') }}</b></h2>
                    <p>Far far away, behind the word mountains, far from the countries.</p>
{{--                    <ul class="ftco-footer-social list-unstyled mt-5">--}}
{{--                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>--}}
{{--                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>--}}
{{--                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>--}}
{{--                    </ul>--}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 ">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li>
                                <span class="fas fa-map-marked-alt"></span>
                                <span> {{ $info['contact-us']['alamat'] }}</span>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fas fa-phone"></span>
                                    <span>{{ $info['contact-us']['no_telp'] }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fas fa-envelope"></span>
                                    <span>{{ $info['contact-us']['email'] }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>
                    <i class="fa fa-copyright"></i> {{ date('Y') }}
                    {{ config('app.app_name') }}
                </p>
                <p>
                    Developed by
                    <a href="https://waveitsolution.com" target="_blank">
                        <span style="color: blue">WAVE Solusi Indonesia</span>
                    </a>
                </p>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</footer>
