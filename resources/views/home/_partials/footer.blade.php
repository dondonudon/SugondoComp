<footer class="footer-area section_gap" id="contactUs">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>About Us</h6>
                    <p class="text-white">
                        {{ $info['contact-us']['info_perusahaan'][0]['data'] }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Contact Us</h6>
                    <p class="text-white">
                        <i class="fas fa-map-marker"></i> Alamat: {{ $info['contact-us']['alamat'][0]['data'] }}
                    </p>
                    <p class="text-white">
                        <i class="fas fa-phone"></i> Telp./Fax.: {{ $info['contact-us']['no_telp'][0]['data'] }}
                    </p>
                    <p class="text-white">
                        <i class="fas fa-envelope"></i> email: {{ $info['contact-us']['email'][0]['data'] }}
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer-text m-0">
                <i class="fa fa-copyright"></i> {{ date('Y') }}
                {{ config('app.app_name') }} - Developed by
                <a href="https://waveitsolution.com" target="_blank">
                    <span style="color: blue">WAVE Solusi Indonesia</span>
                </a>
            </p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
{{--                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>--}}
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </div>
</footer>
