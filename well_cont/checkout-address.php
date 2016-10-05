<div id="sb-site">
    <div class="overlay-background"></div>
    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-12">
                <p class="lead">Kami kirim ke mana Pesanannya?</p>
                <form role="form" method="POST" id="checkout-address">
                    <div class="form-group checkout-form">
                        <label>Negara</label>
                        <select type="text" name="country" class="form-control checkout-form">
                            <option value="ID">Indonesia</option>
                        </select>
                    </div>
                    <div class="form-group checkout-form">
                        <label>Propinsi</label>
                        <select name="province" class="form-control checkout-form">
                            <option value="" selected="selected">-- Pilih Propinsi --</option>

                            <option value="5">D.I. YOGYAKARTA</option>
                            <option value="6">DKI JAKARTA</option>
   
                        </select>
                    </div>
                    <div class="form-group checkout-form">
                        <label>Kota/Kabupaten</label>
                        <select type="text" name="city" class="form-control checkout-form">
                        </select>
                    </div>
                    <div class="form-group checkout-form">
                        <label>Kecamatan</label>
                        <select type="text" name="buyer_region_id" class="form-control checkout-form">
                        </select>
                    </div>
                    <div class="form-group checkout-form">
                        <label>Alamat</label>
                        <textarea name="buyer_address" class="form-control checkout-form" rows="4"></textarea>
                    </div>
                    <div class="form-group checkout-form">
                        <label>Nomor HP</label>
                        <input type="text" name="buyer_phone" class="form-control checkout-form" value="">
                    </div>
                    <p>Punya voucher? <a href="#" data-toggle="voucher-field">Klik di sini</a></p>
                    <div class="form-group hide" id="voucher-field">
                        <label>Kode Voucher</label>
                        <input type="text" name="coupon_code" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Lanjut <span class="glyphicon glyphicon-chevron-right"></span></button>
                        <input type="hidden" name="action" value="submit">
                    </div>
                </form>
                <p>
                    <br>
                    <a href="http://www.pinkemma.com/checkout2/info">&laquo; Ganti nama &amp; email</a>
                </p>
            </div>
        </div>
        <div class="row featurette">
            <p>&nbsp;</p>
        </div>
    </div>
<script type="text/javascript">
            $(function() {
        /*        $('.datepicker').datetimepicker({
                    format: 'yyyy-mm-dd hh:ii',
                    autoclose: true,
                    todayHighlight: true,
                    startView: 'day',
                });*/
                // confirmation form
                if ($('#checkout-address').length) {
                    $('#checkout-address').validate({
                        rules: {
                            country: {
                                required: !0
                            },
                            province: {
                                required: !0
                            },
                            city: {
                                required: !0
                            },
                            buyer_region_id: {
                                required: !0
                            },
                            buyer_address: {
                                required: !0
                            },
                            buyer_phone: {
                                required: !0
                            }
                        },
                        messages: {
                            country: {
                                required: "Mohon pilih negara kamu"
                            },
                            province: {
                                required: "Mohon pilih provinsi kamu"
                            },
                            city: {
                                required: "Mohon pilih kota/kabupaten kamu"
                            },
                            buyer_region_id: {
                                required: "Mohon pilih kecamatan kamu"
                            },
                            buyer_address: {
                                required: "Mohon isi alamat kamu"
                            },
                            buyer_phone: {
                                required: "Mohon isi nomor hp kamu"
                            }
                        },
                        errorClass: "help-block",
                        errorElement: "span",
                        errorPlacement: function(error, element) {
                            if (element.parent('.input-group').length) {
                                error.insertAfter(element.parent());
                            } else {
                                error.insertAfter(element);
                            }
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).closest('.form-group').addClass('has-error');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).closest('.form-group').removeClass('has-error');
                        },
                        submitHandler: function(form) {
                            showBusy($(form).find('*[type="submit"]'));
                            form.submit();
                        }
                    });
                }
            });
        </script>
</div>