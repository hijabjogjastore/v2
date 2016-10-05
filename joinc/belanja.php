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
	echo '<div class="mBox" style="min-height:250px; margin-bottom: 10px;">';
				//slideshow
				echo "<div class='slider-wrapper theme-default' style='margin-bottom:15px;'>
				<div id='slider' class='nivoSlider'>";
				$slides=mysql_query("SELECT * FROM mod_slider ORDER BY id_slider ASC");
				while($s=mysql_fetch_array($slides))
				{
				  echo "<img src='joimg/slides/$s[gambar]' />";
				}
				echo "</div></div>";
	echo '</div>';
?>
<div class="prodW">
<?php
switch($_GET['step']) 
{
	default:	
// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp,produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanja masih kosong!');
        window.location=('index.php')</script>";
    }
	else{  
	  
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
		$disc        = ($r['diskon']/100)*$r['harga'];
		$hargadisc   = number_format(($r['harga']-$disc),0,",",".");
		$subtotal    = ($r['harga']-$disc) * $r['jumlah'];
		$total       = $total + $subtotal;  
		
		$subtotal_rp = format_rupiah($subtotal);
		$total_rp    = format_rupiah($total);
		$harga       = format_rupiah($r['harga']);
		
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
				 <a href='produk-$r[id_produk]-$r[produk_seo].html' title='$p[nama_produk]'>
					$gambar
				 </a>
				</td>
				<td valign='top'>
					<h1 class='prodMeta _capitalize'><b>$r[nama_produk]</b> 
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
		$no++; 
	} 
		echo "<tr class='fBg'>
			<td colspan='3' class='right'><b>Total:</b></td>
			<td class='price right' colspan='5' style='border-left: 1px solid #ddd;'><b>Rp. $total_rp,-</b></td></tr>";
		echo "<tr>
				<td colspan='3'></td>
				<td colspan='5' class='right'>
				<a href='semua-produk-nanaku-hijab-store'>
					<input class='butt' type='button' value='Kembali'></a>
				<a href='cart-step1'>
					<input class='butt' type='button' value='Selesai'></a>
				</td>
			</tr>";
		echo "</tbody></table>";
			  
		echo "<p class='pInfo'>* Total harga di atas belum termasuk ongkos kirim.</p>";
		echo "</form>";             
	}
	break;
		
	case "1":
		echo "<h2 class='hTitle _uppercase _big'>Data Pembeli</h2>";
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
		</table>";
		//data belanjaan
		include "joinc/data_belanja.php";
	break;
	
}//end switch
?>
</div>