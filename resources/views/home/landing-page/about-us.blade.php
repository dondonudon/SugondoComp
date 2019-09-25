<section class="exclusive-deal-area" id="aboutUs">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 text-right">
                        <?php echo $info['about-us']['text'][0]['data'] ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 no-padding exclusive-left" style="background-image: url({{ 'storage/'.$info['about-us']['image'][0]['data'] }});">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
