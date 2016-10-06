    <div id="sb-site">
        <div class="overlay-background"></div>

        <style type="text/css">
            @media (max-width: 767px) {
                .time h2 {
                    font-size: 18px;
                }
                .time h5 {
                    font-size: 14px;
                }
            }
            
            .col-xs-3 {
                padding-left: 6px;
                padding-right: 6px;
            }
            
            .col-xs-3:first-child {
                padding-left: 15px;
            }
            
            .col-xs-3:last-child {
                padding-right: 15px;
            }
        </style>

        <h2 class="text-center">Cara Pemesanan </h2>
<!--         <h4 class="text-center">Limited Time, Limited Stock.</h4> -->
        <hr>

        <div class="row-fluid">
            <div class="col-md-12 no-pd" style="padding-left: 0px; padding-right: 0px;">
                <div class="thumbnail" style="border: none; padding-left: 0px; padding-right: 0px;">
                    <img src="assets/images/cara-pemesanan.jpg" class="img-responsive" width="100%">
                </div>
            </div>
            <div class="col-md-12 no-pd">
                <h3 class="featurette-heading">
<!--             <a href="#" onclick="ga('send', 'event' ,'Flash_Sale', 'Semua serba 70 Ribu, Last Stock!','click',1);"> -->
Semua serba Mudah, Simple & Ngangenin :)
        </h3>
                <!-- <h4><small><b>19</b> produk</small></h4> -->
                <!--
        <p>
            Semua blouse lengan panjang + maxi skirt SALEserba 70 ribu!        </p>
-->
                <!-- <div class="time row" data-endtime="1473958799000">
                    <div class="days col-xs-3 col-timer">
                        <div class="well well-sm text-center">
                            <h2>1</h2>
                            <h5>Hari</h5>
                        </div>
                    </div>
                    <div class="hours col-xs-3 col-timer">
                        <div class="well well-sm text-center">
                            <h2>2</h2>
                            <h5>Jam</h5>
                        </div>
                    </div>
                    <div class="minutes col-xs-3 col-timer">
                        <div class="well well-sm text-center">
                            <h2>0</h2>
                            <h5>Menit</h5>
                        </div>
                    </div>
                    <div class="seconds col-xs-3 col-timer">
                        <div class="well well-sm text-center">
                            <h2>1</h2>
                            <h5>Detik</h5>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-md-12 no-pd">
                <a href="product.html" onclick="" class="btn btn-warning btn-lg btn-block">Saya Ingin Berbelanja &raquo;</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <br>
        <hr>

        <script src="http://www.pinkemma.com/assets/rimba/js/countdown.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                runTimer();
            }); // end document ready

            function runTimer() {
                $('.time').each(function(index, el) {
                    var endtime = $(this).attr('data-endtime');
                    timerFlashsale(endtime, $(this))
                });
            }

            function timerFlashsale(timestampIn, target) {
                // timer
                var enddate = new Date(parseInt(timestampIn));
                var timerId = countdown(function(ts) {

                    var textDay = "" + ts.days;
                    var textHour = "" + ts.hours;
                    var textMinute = "" + ts.minutes;
                    var textSecond = "" + ts.seconds;

                    if (ts.value <= 0) {
                        textDay = textHour = textMinute = textSecond = ts.seconds = 0;
                    }

                    $(target).find('.days h2').text(textDay);
                    $(target).find('.hours h2').text(textHour);
                    $(target).find('.minutes h2').text(textMinute);
                    $(target).find('.seconds h2').text(textSecond);

                    // stop da timer
                    if (ts.value <= 0) {
                        window.clearInterval(timerId);
                    }

                }, enddate, countdown.DAYS | countdown.HOURS | countdown.MINUTES | countdown.SECONDS);
                // end timer
            }
        </script>
    </div>