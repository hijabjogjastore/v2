<div id="sb-site">
    <div class="overlay-background"></div>
    <div class="container marketing">
        <div class="row">
            <div class="col-lg-12">
                <h2>Keranjang Belanja</h2>
            </div>
        </div>
    </div>
    <div class="container marketing">
        <style type="text/css">
            .popover.bottom>.arrow {
                top: -11px !important
            }
        </style>
        <style>
            li.media {
                padding-top: 1em;
                border-top: 1px solid #e3e3e3;
            }
            
            li.media:last-child {
                padding-bottom: 1em;
                /* border-bottom: 1px solid #e3e3e3; */
            }
        </style>
        <ul class="media-list" style="background-color: white;">
            <li>Keranjang belanja anda kosong.</li>
        </ul>


        <div class="row">
            <div class="col-sm-12">
                <!--<a href="http://www.pinkemma.com/?f_color=1&f_price_range=130000%3B370000" class="btn btn-link ">&laquo; Saya masih ingin berbelanja</a>-->
                <a href="/" class="btn btn-link ">&laquo; Saya masih ingin berbelanja</a>
            </div>
        </div>

        <hr class="featurette-divider" />

        <div class="row">
            <div class="col-lg-12">
                <h3 class="featurette-heading" style="font-size:18px;text-align:center;">Baru Saja Dipesan Member Lain</h3>
                <h4 class="text-center"><mark><small>Stok Tinggal Sedikit Lho!</small></mark></h4>
            </div>
        <?php
        for($i=0;$i<12;$i++){
        ?>
            <div class="col-xs-4 col-sm-4 col-md-2 col-recently-purchased">
                <div class="thumbnail" style="border: none; min-height: 268px; margin-bottom:0px; padding:0px;">
                    <a href="#" onClick="">
                        <img width="275px" src="assets/images/hijaber3.jpg" border="0" class="img-responsive" />
                    </a>
                    <div class="caption">
                        <a href="" onClick="">
                            <h4 class="product-name text-center small" title="Maranda Plain Top">Maranda Pl...</h4>

                            <h4 class="price text-center">Rp70,000<br><strike class="text-muted"><small>Rp129,000</small></strike></h4>
                        </a>
                    </div>
                </div>
            </div>
            <?php
         }
            ?>

        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="#" class="small" onClick="#">Lihat Semua Baru Dipesan Member Lain &raquo;</a>
            </div>

        </div>

        <hr class="featurette-divider" />

        <div class="row">
            <div class="col-lg-12">
                <h3 class="featurette-heading" style="font-size:18px;text-align:center;">Inspirasi Terbaru</h3>
            </div>
            <?php
            for($i=0;$i<10;$i++){
            ?>
            <div class="col-xs-3 col-sm-3 col-md-3 col-inspiration">
                <div class="thumb-inspiration">
                    <div class="thumbnail thumb-content">
                        <a href="#" onclick="#">
                            <img src="assets/images/hijaber3.jpg" border="0" class="img-responsive" style="object-fit: cover;" />
                        </a>
                    </div>
                </div>
            </div>
            <?php
           }
            ?>



        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <br>
                <p><a href="http://www.pinkemma.com/inspiration" class="small">Lihat Semua Inspirasi Terbaru &raquo;</a></p>
            </div>
        </div>

        <hr class="featurette-divider" />

        <div class="row">
            <div class="col-lg-12">
                <h3 class="featurette-heading" style="font-size:18px;text-align:center;">Paling Digemari</h3>
            </div>

            <?php
            for($i=0;$i<10;$i++){
            ?>
            <div class="col-xs-3 col-sm-3 col-md-3 col-inspiration">
                <div class="thumb-inspiration">
                    <div class="thumbnail thumb-content">
                        <a href="#" onclick="">
                            <img src="assets/images/hijaber3.jpg" border="0" class="img-responsive" style="object-fit: cover;" />
                        </a>

                    </div>
                </div>
            </div>
            <?php
            }
            ?>


        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
  </div>
        </div>

    </div>


    <div class="container pre-footer text-center">
        <p class="lead text-center"><b>Sudah Pesan?</b></p>
        <ul class="nav nav-pills nav-justified">
            <li role="presentation"><a href="konfirmasi.html" role="menuitem">Konfirmasi
                        Pembayaran &raquo;</a></li>
            <li role="presentation"><a href="status_pemesanan.html" role="menuitem">Lacak
                        Pesanan &raquo;</a></li>
        </ul>
    </div>

</div>