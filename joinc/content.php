<?php 
if($_GET['mod']=='home') 
{
	include "joinc/home.php"; 
}

//mod page
elseif($_GET['mod']=='page')
{
//slideshow
		echo "<div class='slider-wrapper theme-default' style='margin-bottom:15px;'>
		<div id='slider' class='nivoSlider'>";
		$slides=mysql_query("SELECT * FROM mod_slider ORDER BY id_slider ASC");
		while($s=mysql_fetch_array($slides))
		{
		  echo "<img src='joimg/slides/$s[gambar]' />";
		}
		echo "</div></div>";
echo "<div class='mBox'>";
	$id = $_GET['id'];
	$sql=mysql_query("SELECT * FROM mod_page WHERE id_page!='1' AND id_page='$id' ");
	$s=mysql_fetch_array($sql);		
	if($s['id_page']==$id AND $s['statis']=='Y') 
	{ 
		echo '<h2 class="hTitle _uppercase _big">'.$s['judul'].'</h2>';
		if($s['id_page']=="5")
		{ 
			//echo 'include googlemap';
			
		}
		echo $s['isi'];
		echo "<div class='g-map'> $s[extra] </div>"; 
	}
	else { echo "Maaf, halaman tidak tersedia."; }
echo "</div>";
}

//mod promo
elseif($_GET['mod']=='promo')
{
	echo "<div class='mBox'>";
	include "joinc/promo.php";
	echo "</div>";
}

//mod subscibe
elseif($_GET['mod']=='subcribe')
{
	echo "<div class='mBox'>";
	include "joinc/subcribe.php";
	echo "</div>";
}

//mod produk all
elseif($_GET['mod']=='allProduk')
{
	echo "<div class='mBox'>";
	include "joinc/produk_all.php";
	echo "</div>";
}

//mod detail produk
elseif($_GET['mod']=='detailProduk')
{
	echo "<div style='padding: 0 0px; line-height:18px;'>";
		include "joinc/produk_detail.php";
	echo "</div>";
}

//mod kategori, produk by kategori
elseif($_GET['mod']=='detailKategori')
{
	echo "<div class='mBox'>";
			include "joinc/produk_byKategori.php";
	echo "</div>";
}

//mod subkategori, produk by kategori
elseif($_GET['mod']=='detailsubKategori')
{
	echo "<div class='mBox'>";
			include "joinc/produk_bysubKategori.php";
	echo "</div>";
}

//mod kategori, produk by kategori
elseif($_GET['mod']=='category')
{
	echo "<div class='mBox'>";
			include "joinc/kategori.php";
	echo "</div>";
}

//mod album
elseif($_GET['mod']=='semuaalbum')
{
	echo "<div class='mBox'>";
			include "joinc/album.php";
	echo "</div>";
}
elseif($_GET['mod']=='galeri')
{
	echo "<div class='mBox'>";
			include "joinc/galeri.php";
	echo "</div>";
}
//mod keranjang belanja
elseif($_GET['mod']=='keranjangBelanja')
{
	echo "<div class='mBox'>";
		include "joinc/belanja.php";
	echo "</div>";
}

//proses form keranjang belanja
elseif($_GET['mod']=='form_transaksi')
{
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");

	if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['telpon']) || empty($_POST['email'])){
	  echo "<script>window.alert('Data yang Anda isikan belum lengkap. Ulangi Lagi');
			window.location(history.back(-1))</script>";
	}
	elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
		echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol. Ulangi Lagi');
			window.location(history.back(-1))</script>";
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		echo "<script>window.alert('Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @. Ulangi Lagi');
			window.location(history.back(-1))</script>";
	}
	elseif(empty($_POST['kota']) || $_POST['kota']=="0")
	{
		echo "<script>window.alert('Pilih kota tujuan sesuai data yang disediakan. Ulangi Lagi');
		window.location(history.back(-1))</script>";
	}
	else
	{
		$idkota = cleanInput($_POST['kota']);

		// fungsi untuk mendapatkan isi keranjang belanja
		function isi_keranjang()
		{
			$isikeranjang = array();
			$sid = session_id();
			$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
			while ($r=mysql_fetch_array($sql)) 
			{
				$isikeranjang[] = $r;
			}
			return $isikeranjang;
		}

		$tgl_skrg = date("Ymd");
		$jam_skrg = date("H:i:s");
		
		// simpan data pemesanan 
		mysql_query("INSERT INTO orders(nama_kustomer, alamat, id_kota,telpon, email, tgl_order, jam_order) 
					 VALUES('$_POST[nama]','$_POST[alamat]','$idkota', '$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg')");
		  
		// mendapatkan nomor orders
		$id_orders=mysql_insert_id();

		// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
		$isikeranjang = isi_keranjang();
		$jml          = count($isikeranjang);

		// simpan data detail pemesanan  
		for ($i = 0; $i < $jml; $i++)
		{
		  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, id_atribut, jumlah) 
		  VALUES('$id_orders',{$isikeranjang[$i]['id_produk']},{$isikeranjang[$i]['id_atribut']}, {$isikeranjang[$i]['jumlah']})");
		}
		  
		// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
		for ($i = 0; $i < $jml; $i++) {
		  mysql_query("DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
		}
		//get nama kota
		$kota = mysql_fetch_array(mysql_query("SELECT nama_kota FROM kota WHERE id_kota='$idkota'"));
		echo "<h1 class='hTitle _uppercase _big'>Proses Transaksi Selesai</h1>
      <p>Data pemesan beserta ordernya adalah sebagai berikut: </p>
      <table class='prodCart' width='100%'>
      <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
      <tr><td>E-mail         </td><td> : $_POST[email] </td></tr>";
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format"; 
		}
		?>
      <?php
	  echo "<tr><td>Kota Tujuan    </td><td> : $kota[nama_kota] </td></tr>
      </table>
      <p>Nomor Order: <b>$id_orders</b></p><br />";
      
		$daftarproduk=mysql_query("SELECT * FROM orders_detail,produk
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");
                                 
		echo "<table class='prodCart' width='100%' border='0'>
				<tr align=left height=23>
					<th>No.</th>
					<th>Nama Produk</th>
					<th>Qty</th>
					<th>Harga</th>
					<th>Sub Total</th>
				</tr>";
		  
		$pesan="Terimakasih telah melakukan pemesanan online di toko kami<br /><br />  
				Nama: $_POST[nama] <br />
				Alamat: $_POST[alamat] <br/>
				Telpon: $_POST[telpon] <br /><hr />
				
				Nomor Order: $id_orders <br />
				Data order Anda adalah sebagai berikut: <br />
				
				<table class='prodCart' width='100%' border='0' >
				<tr align=left height=23>
					<th>No.</th>
					<th>Nama Produk</th>
					<th>Qty</th>
					<th>Harga</th>
			                <th align=center>Sub Total</th>
				</tr>";
		$no=1;
		while ($d=mysql_fetch_array($daftarproduk))
		{
		   $subtotal    = $d['harga'] * $d['jumlah'];
		   $total       = $total + $subtotal;
		 
		   $subtotal_rp = format_rupiah($subtotal);    
		   $total_rp    = format_rupiah($total);    
		   $harga       = format_rupiah($d['harga']);
		   
		   //get opsi atribut
		   if($d['id_atribut']>0)
		   {
		   		$atrib = mysql_fetch_array(mysql_query("SELECT * FROM produk_atribut WHERE id_atribut='$d[id_atribut]'"));
		   		$atribut = " - opsi warna: $atrib[nama_atribut]";
		   } else { $atribut = ""; }
		   
			//get ongkos kirim
			$ongkir = mysql_query("SELECT * FROM orders,kota WHERE orders.id_orders='$d[id_orders]' AND kota.id_kota=orders.id_kota");
			$o = mysql_fetch_array($ongkir);
	  	   
		   echo "<tr>
			<td class='center'>$no.</td>
			<td>$d[nama_produk] $atribut</td>
			<td class='center'>$d[jumlah]</td>
			<td>Rp. $harga,-</td><td align='right'>Rp. $subtotal_rp,-</td></tr>";
			
			$pesan.="<tr>
			<td class='center'>$no.</td>
			<td>$d[nama_produk] $atribut</td>
			<td class='center'>$d[jumlah]</td>
			<td>Rp. $harga,-</td><td align='right'>Rp. $subtotal_rp,-</td></tr>";
		   //$pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
		   $no++;
		}
		
		$grandtotal    = $total + $o['ongkos_kirim']; 
		$grandtotal_rp  = format_rupiah($grandtotal);  
		$ongkos_rp = format_rupiah($o['ongkos_kirim']);
		$pesan.="<tr>
				<td colspan=5 align=right>Total : Rp. </td>
				<td align=right><b>$total_rp</b></td></tr> 
				<tr>
				<td colspan='5' align='right'>Ongkos kirim : Rp. </td>
				<td align=right><b>$ongkos_rp</b></td>
				</tr>  
			  <tr>
				<td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
			  </table><br /><hr />";
		$pesan.= "<p>Email ini dikirim  sebagai tanda transaksi yang telah dilakukan melalui nanakuhijabstore.com 
		dengan menggunakan email <b>$_POST[email]</b>, jika anda merasa tidak pernah melakukan transaksi harap abaikan email ini. </p>";

		$subjek="Pemesanan Online Hijab (nanakuhijabstore.com)";
		// Kirim email dalam format HTML
		$dari = "From: na2_doll@yahoo.co.id \n";
		$dari .= "Content-type: text/html \r\n";

		// Kirim email ke customer
		mail($_POST['email'],$subjek,$pesan,$dari);
		// Kirim email ke pengelola toko online
		mail("na2_doll@yahoo.co.id",$subjek,$pesan,$dari);
		
		echo "<tr>
				<td colspan=5 align=right>Total : Rp. </td>
				<td align=right><b>$total_rp</b></td></tr>   
			  <tr>
			  <tr>
				<td colspan='5' align='right'>Ongkos kirim : Rp. </td>
				<td align=right><b>$ongkos_rp</b></td>
				</tr>  
				<td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
			  </table>";
		echo "<br /><p>- Data order sudah terkirim ke email Anda ($_POST[email]). <br />
		- Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />      "; 
	}
}

//mod semua testimoni
elseif($_GET['mod']=='allTestimoni')
{
	echo "<div class='mBox'>";
			include "joinc/testimoni.php";
	echo "</div>";
}

//mod semua berita
elseif($_GET['mod']=='allNews')
{
	echo "<div class='mBox'>";
			include "joinc/berita.php";
	echo "</div>";
}

//mod detail berita
elseif($_GET['mod']=='detailNews')
{
	echo "<div class='mBox'>";
			include "joinc/detailberita.php";
	echo "</div>";
}

//proses form cari
elseif($_GET['mod']=='form_cari'){

	echo "<div class='mBox'>";
			include "joinc/search.php";
	echo "</div>";


}
