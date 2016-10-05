<div id="sb-site">
    <div class="overlay-background"></div>
<div class="container marketing">
    <div class="row featurette">
        <div class="col-md-12">
            <p>Selamat! Pilihan kamu tepat sekali!</p>
            <p class="lead">Isi nama dan alamat email dulu yuk.</p>
            <p class="small"><p class="small">Pesanannya hanya bisa kami tahan 15 menit saja lho.</p></p>
            <form role="form" method="POST" id="checkout-form-email" onSubmit="_kmq.push(['record', 'RIMBA: Clicked lanjut on Personal Info']);">
                <div class="form-group checkout-form">
                    <label>Nama:</label>
                    <input type="text" name="buyer_name" class="form-control checkout-form" placeholder="Masukkan nama kamu" value="">
                </div>
                <div class="form-group checkout-form">
                    <label>Email:</label>
                    <input type="email" name="buyer_email" class="form-control checkout-form" placeholder="Masukkan email kamu" value="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block">Dikirim Ke <span class="glyphicon glyphicon-chevron-right"></span></button>
                    <input type="hidden" name="action" value="submit">
                </div>
            </form>
        </div>
    </div>
</div><!-- /.container -->
</div>