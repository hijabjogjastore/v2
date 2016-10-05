<script>
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.jasa.value == 0){
    alert("Anda belum memilih jasa pengiriman barang.");
    form.jasa.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  return (true);
}

function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}
</script>
<?php
switch($_GET['step']) 
{
	default:	
// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
   // echo $sid; exit;
	$sql = mysql_query("SELECT * FROM orders_temp,product WHERE id_session='$sid' AND orders_temp.product_id=product.product_id");
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanja masih kosong!');
        window.location=('index.php')</script>";
    }
	else{  
		?>
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
        <?php
        $no=1;
        while($r=mysql_fetch_array($sql))
        {
            $disc        = ($r['product_discount']/100)*$r['product_price'];
            $hargadisc   = number_format(($r['product_price']-$disc),0,",",".");
            //echo $hargadisc; exit;
            $subtotal    = ($r['product_price']-$disc) * $r['jumlah'];
            //echo $subtotal; exit;
            $total       = $total + $subtotal;  
            
            $subtotal_rp = format_rupiah($subtotal);
            $total_rp    = format_rupiah($total);
            $harga       = format_rupiah($r['product_price']);
        //for($i=0;$i<3;$i++){
        ?>
        <ul class="media-list" style="background-color: white;">
            <li class="media">
                <a class="pull-left" href="#">
                    <img style="margin-left: 10px" class="media-object" src="assets/images/product/s_<?php echo $r['product_images']; ?>" alt="">
                </a>
                <div class="media-body">
                    <div style="display:inline-block;width:60%; vertical-align: top;">
                        <strong class="media-heading"><?php echo $r['product_name']; ?></strong>
                        <br><small><?php echo $r['product_color']; ?><br><?php echo $r['product_size']; ?></small>
                        <p>
                            <!-- price -->
                            <br/>
                            <strong class="text-danger">Rp. <?php echo $hargadisc; ?></strong>

                            <span class="text-muted">

          
                                    <br/>
                                    <s title="Diskon 33%">
                                    Rp. <?php echo $harga; ?>   
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
                        <!-- <button class="btn btn-link pecart-remove" data-sku="PI10000090002"> -->
                            <a href="cart.php?mod=basket&act=del&id=<?php echo $r[id_orders_temp] ?>">
                            (hapus)</a><!-- </button> -->
                    </div>
                </div>
            </li>
        </ul>
        <?php
    	}
        ?>
        <p><b>Jumlah Pesanan</b></p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-right"><?php echo $ketemu; ?> Potong</td>
                    <td class="text-right">Rp. <?php echo $total_rp; ?></td>
                </tr>
                <tr>
                    <td class="text-right">Ongkos Kirim</td>
                    <td class="text-right">Rp. 0</td>
                </tr>
                <tr>
                    <td class="text-right lead"><strong>TOTAL</strong></td>
                    <td class="text-right lead"><strong>Rp. <?php echo $total_rp; ?></strong></td>
                </tr>

            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12">
                <a href="cart-step1" class="btn btn-warning btn-lg btn-block pull-right">Lanjut <span class="glyphicon glyphicon-chevron-right"></span></a>
                <p>&nbsp;</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!--<a href="http://www.pinkemma.com/" class="btn btn-link ">&laquo; Saya masih ingin berbelanja</a>-->
                <a href="product.html" class="btn btn-link ">&laquo; Saya masih ingin berbelanja</a>
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
		<?php
	/*  
		echo "<h2 class='hTitle _capitalize'>Keranjang Belanja</h2>
			  <form method=post action='cart.php?mod=basket&act=update'>";
		
		echo "<table  class='prodCart' width='100%'>";
			echo "<tr><thead>
					<td class='center'>No.</td>
					<td colspan='2'>Produk</td>
					<td>Jumlah</td>
					<td>Harga</td>
					<td colspan='2'>Sub Total</td>
					</thead>
				</tr><tbody>";
	$no=1;
	while($r=mysql_fetch_array($sql))
	{
		$disc        = ($r['product_discount']/100)*$r['product_price'];
		$hargadisc   = number_format(($r['product_price']-$disc),0,",",".");
		$subtotal    = ($r['product_price']-$disc) * $r['product_jumlah'];
		$total       = $total + $subtotal;  
		
		$subtotal_rp = format_rupiah($subtotal);
		$total_rp    = format_rupiah($total);
		$harga       = format_rupiah($r['product_price']);
		
		//get atribut
		if($r['id_atribut']!=0)
		{
			$opsi   = mysql_query("SELECT * FROM produk_to_opsi WHERE id_produk='$r[id_produk]' AND id_atribut='$r[id_atribut]'");
			$op     = mysql_fetch_array($opsi);
			$gambar = "<img width='50' height='75' src='joimg/produk/opsi/s_$op[pic]'  />";
				
			$opsiwarna = mysql_query("SELECT * FROM produk_atribut WHERE id_atribut='$r[id_atribut]'");
			$opsi_w    = mysql_fetch_array($opsiwarna);
			$atribut   = '- Opsi Warna: '.$opsi_w['nama_atribut'];
		}
		else { $atribut = ""; $gambar = "<img width='50px' height='75px'  src='joimg/produk/s_$r[gambar]'  />"; }
		echo "<tr>
				<td class='vtop center'><b>$no.</b></td>
					<input type=hidden name=id[$no] value=$r[id_orders_temp]>
				<td class='vtop center'>
				 <a href='produk-$r[product_id]-$r[product_seo].html' title='$p[product_name]'>
					$gambar
				 </a>
				</td>
				<td valign='top'>
					<h1 class='prodMeta _capitalize'><b>$r[product_name]</b> 
					$atribut
					</h1>
				</td>
				<td valign='top'> <input type='text' id='angka' maxlength=2 name='jml[$no]' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\" style='outline: 1px dotted;'> </td>
				<td valign='top'>$hargadisc</td>
				<td valign='top'>$subtotal_rp</td>
				<td valign='top' class='right'><a href='cart.php?mod=basket&act=del&id=$r[id_orders_temp]'>
					<img src=jolibs/images/kali.png border=0 title=Hapus></a>
				</td>
			  </tr>
			  <tr><td class='border-bottom' colspan='7'></td></tr>";
		$no++; */
	//} 
		/*echo "<tr class='fBg'>
			<td colspan='3' class='right'><b>Total:</b></td>
			<td class='price right' colspan='5' style='border-left: 1px solid #ddd;'><b>Rp. $total_rp,-</b></td></tr>";
		echo "<tr>
				<td colspan='3'></td>
				<td colspan='5' class='right'>
				<a href='product.html'>
					<input class='butt' type='button' value='Kembali'></a>
				<a href='cart-step1'>
					<input class='butt' type='button' value='Selesai'></a>
				</td>
			</tr>";
		echo "</tbody></table>";
			  
		echo "<p class='pInfo'>* Total harga di atas belum termasuk ongkos kirim.</p>";
		echo "</form>";   */          
	}
	break;
		
	case "1":
?>
    <div id="sb-site">
    <div class="overlay-background"></div>
    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-12">
                <p class="lead">Kami kirim ke mana Pesanannya?</p>
                <form role="form" method="POST" action="prosesCart" id="checkout-address">
          <!--           <div class="form-group checkout-form">
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
                    </div> -->
                    <div class="form-group checkout-form">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control checkout-form" value="">
                    </div>
                    <div class="form-group checkout-form">
                        <label>Nomor HP</label>
                        <input type="text" name="telpon" class="form-control checkout-form" value="">
                    </div>
                     <div class="form-group checkout-form">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control checkout-form" value="">
                    </div>
                    <div class="form-group checkout-form">
                        <label>Kota/Kabupaten</label>

                        <select type="text" name="kota" class="form-control checkout-form">
                        <?php
                        $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota ASC");
                        while($r=mysql_fetch_array($tampil))
                        {
                            echo "<option value='$r[id_kota]'>$r[nama_kota]</option>";
                        }
                        ?>
                        </select>
                    </div>
                   <!--  <div class="form-group checkout-form">
                        <label>Kecamatan</label>
                        <select type="text" name="buyer_region_id" class="form-control checkout-form">
                        </select>
                    </div> -->
                    <div class="form-group checkout-form">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control checkout-form" rows="4"></textarea>
                    </div>
                    
                    <!-- <p>Punya voucher? <a href="#" data-toggle="voucher-field">Klik di sini</a></p> -->
                  <!--   <div class="form-group hide" id="voucher-field">
                        <label>Kode Voucher</label>
                        <input type="text" name="coupon_code" class="form-control" value="">
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Lanjut <span class="glyphicon glyphicon-chevron-right"></span></button>
                        <input type="hidden" name="action" value="submit">
                    </div>
                </form>
                <p>
                    <br>
                    <a href="#">&laquo; Ganti nama &amp; email</a>
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
<?php
		/*echo "<h2 class='hTitle _uppercase _big'>Data Pembeli</h2>";
		echo "<p class=' _capitalize'>pastikan anda mengisi data berikut dengan benar.</p>";
		//form data pembeli
		echo "<form name=form action='prosesCart' method='POST' onSubmit=\"return validasi(this)\">
		<table width=550>
		  <tr>
			<td>Nama Lengkap </td>
			<td><input type=text name='nama' size='35' /></td>
		  </tr>
		  <tr>
			<td valign='top'>Alamat Lengkap </td>
			<td><textarea name='alamat' style='width: 235px; height: 80px;resize:vertical;'></textarea></td>
		  </tr>
		  <tr>
			<td>Telpon/HP</td>
			<td>  <input type='text' name='telpon' size='35' maxlength=12 id='angka' /></td>
		  </tr>
		  <tr>
			<td> Email</td>
			<td>  <input type='text' name='email' size='35' /></td>
		  </tr>
		  <tr>
			<td>Tujuan</td>
			<td><select name='kota'>
			<option value='0' selected>- Pilih Kota -</option>";
         	$tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota ASC");
          	while($r=mysql_fetch_array($tampil))
          	{
             	echo "<option value='$r[id_kota]'>$r[nama_kota]</option>";
          	}
			echo "</select></td>
			</tr>
			<tr><td></td>
			<td>
			<input class='butt' type='submit' value='proses'></td></tr>
		</table>";*/
		//data belanjaan
		//include "well_cont/proses/data_belanja.php";
	break;
	
}//end switch
?>
</div>