<script src="{{ asset('home/js/jquery.min.js') }}"></script>
<script src="{{ asset('home/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('home/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('home/js/aos.js') }}"></script>
<script src="{{ asset('home/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('home/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('home/js/scrollax.min.js') }}"></script>
<script src="{{ asset('home/js/main.js') }}"></script>

{{--<script src="{{ asset('vendor/glide/dist/glide.min.js') }}"></script>--}}
<script src="{{ asset('vendor/slick-1.8.1/slick/slick.min.js') }}"></script>
<script>
    // new Glide('.glide', {
    //     type: 'carousel',
    //     startAt: 0,
    //     perView: 1,
    //     autoplay: 2000,
    // }).mount()
    function goToSection(id) {
        document.getElementById(id).scrollIntoView({
            behavior: "smooth"
        });
    }

    $(document).ready(function(){
        $('#slider_section').slick({
            dots: true,
            autoplay: true,
            centerMode: true,
            variableWidth: true,
        });
    });
</script>
