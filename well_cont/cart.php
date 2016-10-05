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
        <div class="row">
            <div class="col-lg-12">
                <p class="small text-muted">Harga sewaktu-waktu dapat berubah.
                    <br>Silakan periksa dan Lanjut.
                </p>
            </div>
        </div>

        <div class="text-center" style="display: inline-block;width: 50%"><b>Produk</b></div>
        <div class="text-right" style="display: inline-block;width: 40%"><b>Jumlah</b></div>
        <div style="height:10px;"></div>

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
            <li class="media">
                <a class="pull-left" href="#">
                    <img style="margin-left: 10px" class="media-object" src="assets/images/cart.jpg" alt="">
                </a>
                <div class="media-body">
                    <div style="display:inline-block;width:60%; vertical-align: top;">
                        <strong class="media-heading">Spring Floral Maxi</strong>
                        <br><small>Pink<br>All Size</small>
                        <p>
                            <!-- price -->
                            <br/>
                            <strong class="text-danger">Rp. 100.000</strong>

                            <span class="text-muted">

          
                                    <br/>
                                    <s title="Diskon 33%">
                                    Rp. 149.000   
                                    </s>

                                                        </span>
                        </p>
                    </div>
                    <div style="display:inline-block; vertical-align: top; width: 30%; text-align:right;">
                        <select name="qty" class="form-control pecart-update" data-sku="PI10000090002">
                            <option value="1" selected="selected">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <br/>
                        <button class="btn btn-link pecart-remove" data-sku="PI10000090002">(hapus)</button>
                    </div>
                </div>
            </li>
        </ul>
        <p><b>Jumlah Pesanan</b></p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-right">1 Potong</td>
                    <td class="text-right">Rp. 100.000</td>
                </tr>
                <tr>
                    <td class="text-right">Ongkos Kirim</td>
                    <td class="text-right">Rp. 0</td>
                </tr>
                <tr>
                    <td class="text-right lead"><strong>TOTAL</strong></td>
                    <td class="text-right lead"><strong>Rp. 100.000</strong></td>
                </tr>

            </tbody>
        </table>
        <script type="text/javascript">
          /*  $(function() {
                $('[data-toggle="popover"]').popover();

                $(document).on('click', function(e) {
                    var isPopover = $(e.target).attr('data-toggle') || false;
                    if (isPopover === false) {
                        $('[data-toggle="popover"]').popover('hide');
                    }
                });
            })*/
        </script>

        <div class="row">
            <div class="col-sm-12">
                <a href="http://www.pinkemma.com/checkout2" class="btn btn-warning btn-lg btn-block pull-right">Lanjut <span class="glyphicon glyphicon-chevron-right"></span></a>
                <p>&nbsp;</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!--<a href="http://www.pinkemma.com/" class="btn btn-link ">&laquo; Saya masih ingin berbelanja</a>-->
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
                        <a href="#" onClick="#">
                            <h4 class="product-name text-center small" title="Aisya Pashmina">Aisya Pash...</h4>

                            <h4 class="price text-center">Rp69,000<br><small>&nbsp;</small></h4>
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
                <a href="#" class="small" onClick="">Lihat Semua Baru Dipesan Member Lain &raquo;</a>
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