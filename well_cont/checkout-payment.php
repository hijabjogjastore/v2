<div id="sb-site">
    <div class="overlay-background"></div>

    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-12">

                <p class="lead"><strong>Terima Kasih!</strong></p>
                <p>Nomor Pesanan: <strong>927594</strong></p>
                <p>Total Belanja Kamu:
                    <strong>Rp. 116.000</strong>
                </p>
                <p>Salinan pesanan sudah kami email juga ke
                    <strong>edyuty@gmail.com</strong>.</p>
                <!--<br/>-->
                <h2>Pembayaran</h2>
                <form method="POST" id="checkout-form-payment">
                    <label class="lead">Selanjutnya, silakan pilih cara pembayaran berikut ini:</label>
                    <p class="small">CATATAN: Bila pembayaran tidak kami terima dalam <strong>30 menit</strong>, pesanan terpaksa kami batalkan.</p>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <!-- BANK TRANSFER -->
                        <div class="panel panel-default top-panel-default">
                            <div class="panel-heading" role="tab" id="headingTxfer" data-toggle="collapse" data-parent="" href="#collapseTxfer" aria-expanded="false" aria-controls="collapseTxfer">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTxfer"
                                       aria-expanded="false" aria-controls="collapseTxfer">
                                        Bayar Lewat Transfer Bank <span class="glyphicon glyphicon-chevron-down"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTxfer" class="panel-collapse collapse  in" role="tabpanel" aria-labelledby="headingTxfer">
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item radio-container">
                                            <input type="radio" name="payment_method" id="radio2" value="BCA" checked="checked">
                                            <img src="assets/images/icon-bca.jpg" alt="BCA" />
                                        </li>
                                        <li class="list-group-item radio-container">
                                            <input type="radio" name="payment_method" id="radio3" value="MANDIRI">
                                          <img src="assets/images/icon-mandiri.jpg" alt="Mandiri" />
                                        </li>
                                        <li class="list-group-item radio-container">
                                            <input type="radio" name="payment_method" id="radio4" value="BRI">
                                          <img src="assets/images/icon-bri.jpg" alt="BRI" />
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Lanjut ke Pembayaran <span class="glyphicon glyphicon-chevron-right"></span></button>
                        <input type="hidden" name="action" value="submit">
                        <input type="hidden" name="o" value="poloqKZo">
                </form>

                </div>
            </div>
        </div>

    </div>
</div>