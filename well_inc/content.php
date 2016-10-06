<?php
if($_GET['mod']=='home'){
	include("well_cont/product.php");
}elseif ($_GET['mod']=='product') {
	include("well_cont/product.php");
}elseif ($_GET['mod']=='product-detail') {
	include("well_cont/product-detail.php");
}elseif ($_GET['mod']=='cart') {
	include("well_cont/cart.php");
}elseif ($_GET['mod']=='login') {
	include("well_cont/login.php");
}elseif ($_GET['mod']=='checkout-address') {
	include("well_cont/checkout-address.php");
}elseif ($_GET['mod']=='checkout-payment') {
	include("well_cont/checkout-payment.php");
}elseif ($_GET['mod']=='checkout-tanks') {
	include("well_cont/checkout-tanks.php");
}
// statistik page start
elseif ($_GET['mod']=='cara-pemesanan') {
	include("well_cont/page/cara-pemesanan.php");
}
elseif ($_GET['mod']=='persyaratan-dan-ketentuan') {
	include("well_cont/page/persyaratan-dan-ketentuan.php");
}
elseif ($_GET['mod']=='kebijakan-privasi') {
	include("well_cont/page/kebijakan-privasi.php");
}
elseif ($_GET['mod']=='tentang-kami') {
	include("well_cont/page/tentang-kami.php");
}
elseif ($_GET['mod']=='contact-kami') {
	include("well_cont/page/contact-kami.php");
}
//statistik end
//aksi cart
elseif ($_GET['mod']=='keranjangbelanja') {
	include("well_cont/proses/keranjangbelanja.php");
}
//asi pembayaran 
elseif ($_GET['mod']=='konfirmasi') {
	include("well_cont/konfirmasi.php");
}
//check-status-pesanan
elseif ($_GET['mod']=='lacak-pesanan') {
	include("well_cont/form-lacak-pesanan.php");
}

elseif ($_GET['mod']=='show-lacakpesanan') {
	include("well_cont/hasil-lacak-pesanan.php");
}
elseif ($_GET['mod']=='checkout-tanks') {
	include("well_cont/checkout-tanks.php");
}


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
		  mysql_query("INSERT INTO orders_detail(id_orders, product_id, id_atribut, jumlah) 
		  VALUES('$id_orders',{$isikeranjang[$i]['product_id']},{$isikeranjang[$i]['id_atribut']}, {$isikeranjang[$i]['jumlah']})");
		}
		  
		// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
		for ($i = 0; $i < $jml; $i++) {
		  mysql_query("DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
		}
		//get nama kota
		$kota = mysql_fetch_array(mysql_query("SELECT nama_kota FROM kota WHERE id_kota='$idkota'"));
/*		echo "<h1 class='hTitle _uppercase _big'>Proses Transaksi Selesai</h1>
      <p>Data pemesan beserta ordernya adalah sebagai berikut: </p>
      <table class='prodCart' width='100%'>
      <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
      <tr><td>E-mail         </td><td> : $_POST[email] </td></tr>";*/
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format"; 
		}
		?>
      <?php
/*	  echo "<tr><td>Kota Tujuan    </td><td> : $kota[nama_kota] </td></tr>
      </table>
      <p>Nomor Order: <b>$id_orders</b></p><br />";*/
      
		$daftarproduk=mysql_query("SELECT * FROM orders_detail,product
                                 WHERE orders_detail.product_id=product.product_id 
                                 AND id_orders='$id_orders'");
                                 
/*		echo "<table class='prodCart' width='100%' border='0'>
				<tr align=left height=23>
					<th>No.</th>
					<th>Nama Produk</th>
					<th>Qty</th>
					<th>Harga</th>
					<th>Sub Total</th>
				</tr>";*/
		  
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
		   $subtotal    = $d['product_price'] * $d['jumlah'];
		   $total       = $total + $subtotal;
		 
		   $subtotal_rp = format_rupiah($subtotal);    
		   $total_rp    = format_rupiah($total);    
		   $harga       = format_rupiah($d['product_price']);
		   
		   //get opsi atribut
		   if($d['id_atribut']>0)
		   {
		   		$atrib = mysql_fetch_array(mysql_query("SELECT * FROM produk_atribut WHERE id_atribut='$d[id_atribut]'"));
		   		$atribut = " - opsi warna: $atrib[nama_atribut]";
		   } else { $atribut = ""; }
		   
			//get ongkos kirim
			$ongkir = mysql_query("SELECT * FROM orders,kota WHERE orders.id_orders='$d[id_orders]' AND kota.id_kota=orders.id_kota");
			$o = mysql_fetch_array($ongkir);
/*	  	   
		   echo "<tr>
			<td class='center'>$no.</td>
			<td>$d[nama_produk] $atribut</td>
			<td class='center'>$d[jumlah]</td>
			<td>Rp. $harga,-</td><td align='right'>Rp. $subtotal_rp,-</td></tr>";*/
			
			$pesan.="<tr>
			<td class='center'>$no.</td>
			<td>$d[product_name] $atribut</td>
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

		$subjek="Pemesanan Online Hijab Jogja Store (hijabjogjastore.com)";
		// Kirim email dalam format HTML
		$dari = "From: hijabjogjastore@gmail.com \n";
		$dari .= "Content-type: text/html \r\n";

		// Kirim email ke customer
		mail($_POST['email'],$subjek,$pesan,$dari);
		// Kirim email ke pengelola toko online
		mail("hijabjogjastore@gmail.com",$subjek,$pesan,$dari);
		
/*		echo "<tr>
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
		- Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />      "; */
		?>
<div id="sb-site">
    <div class="overlay-background"></div>
    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-12">
                <h1>Terima Kasih!</h1>
                <p>Nomor Pesanan: <strong><?php echo $id_orders ?></strong></p>
                <p>Silakan lakukan pembayaran dengan mentransfer (pemindahan dana) sejumlah
                    <strong>Rp. <?php echo $subtotal_rp; ?></strong> ke rekening kami sebagai berikut:</p>

                <p class="text-center">
                    <p class="text-center">Bank BCA</p>
                    <p class="text-center">
                        <img class="text-center" src="assets/images/icon-bca.jpg" alt="Bank BCA" />
                    </p>
                    <br>
                    <p class="text-center">Nomor Rekening: </p>
                    <h3 class="text-center">123400191991</h3>
                    <br>
                    <p class="text-center">Atas Nama</p>
                    <h3 class="text-center">Developer cde</h3>
                </p>
                <br/>
                <br/>
                <br/>
                <br/>
                <a href="#" class="btn btn-warning">
                &lt;&lt; Pilih Pembayaran Lain</a>
            </div>
        </div>
    </div>
</div>
		<?php
	}
}
?>