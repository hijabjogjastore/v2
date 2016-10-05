 <div id="sb-site">
        <div class="overlay-background"></div>
        <div id="content">
            <div class="container marketing">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Sudah membayar via Transfer?</h3>
                        <p class="lead">Konfirmasi di sini.</p>
                        <form id="form-konfirmasi" action="proses-konfirmasi.html" method="post">
                            <div id="form-response">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="order_id" placeholder="Order ID" value="">
                            </div>
                            <div class="form-group">

                                <select class="form-control" id="bank-transferred" name="nama_bank">
                                    <option value="">Pilih Bank Tujuan</option>
                                    <?php
                                    $sql_bank="select * from mod_bank";
                                    //echo $sql_bank; exit;
                                    $result_bank=mysql_query($sql_bank);
                                    while($data_bank=mysql_fetch_array($result_bank)){
                                    ?>
                                    <option value="<?php echo $data_bank['id_bank'] ?>"><?php echo $data_bank['nama_bank']." - ".$data_bank['no_rekening']." - a/n ".$data_bank['pemilik'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    <!-- <option value="MANDIRI">MANDIRI - 144-00-1588-8354 - a/n Naniek Sumiati</option>
                                    <option value="BCA">BCA - 5055061880 - a/n Naniek Sumiati</option>
                                    <option value="BRI">BRI - 0551-01-000345-56-0 - a/n PT Naniek Sumiati</option> -->
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim" value="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama_bank_pengirim" placeholder="Bank Asal Transfer. (Contoh: BCA,BRI,MANDIRI atau yg lainnya)" value="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="jumlah" placeholder="Nominal" value="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control datepicker" id="tanggal-bayar" name="tgl_bayar" placeholder="Tanggal bayar" value="">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="submit">
                                <button type="submit" class="btn btn-warning btn-block btn-lg">Kirim Konfirmasi &raquo;</button>
                            </div>
                        </form>
                        <br>
                        <p><a href="product.html">&laquo; Kembali berbelanja</a></p>
                    </div>
                </div>

            </div>

        </div>
        <!-- Datepicker -->
        <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('.datepicker').datetimepicker({
                    format: 'yyyy-mm-dd hh:ii',
                    autoclose: true,
                    todayHighlight: true,
                    startView: 'day',
                });
                // confirmation form
                if ($('#form-konfirmasi').length) {
                    $('#form-konfirmasi').validate({
                        rules: {
                            order_id: {
                                required: true
                            },
                            nama_bank: {
                                required: true
                            },
                            nama_pengirim: {
                                required: true
                            },
                            nama_bank_pengirim: {
                                required: true
                            },
                            nomor_rekening: {
                                required: true
                            },
                            jumlah: {
                                required: true
                            },
                            tgl_bayar: {
                                required: true
                            }
                        },
                        messages: {
                            order_id: {
                                required: 'Mohon isi order id',
                            },
                            nama_bank: {
                                required: 'Mohon isi nama bank',
                            },
                            nama_pengirim: {
                                required: 'Mohon isi nama pengirim',
                            },
                            nama_bank_pengirim: {
                                required: 'Mohon isi nama bank pemilik rekening',
                            },
                            nomor_rekening: {
                                required: 'Mohon isi nomor rekening',
                            },
                            jumlah: {
                                required: 'Mohon isi jumlah transfer',
                            },
                            tgl_bayar: {
                                required: 'Mohon isi tanggal bayar',
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